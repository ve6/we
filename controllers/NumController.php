<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\models\PublicNumber;
use app\models\Access;
use app\models\Menu;
use yii\data\Pagination;

class NumController extends Controller{
	public $layout='mainNav.php';
	public $enableCsrfValidation=false;
    public function init(){
        parent::init();
		if(!file_exists('install.zjw')){
			$this->redirect('index.php?r=install/one');
		}
        isset($_COOKIE['name'])?$cook=$_COOKIE['name']:$cook="";
        if($cook=="")
        {
            echo "<script>alert('未登录，请先登录');location.href='index.php?r=login/index'</script>";
            //$this->redirect('index.php?r=login/index');

        }
    }
	public function actionShow(){
		$query = PublicNumber::find();
		$session = Yii::$app->session;
    	$session->open();
    	$id=$session->get("id",0);
		$countQuery = clone $query;
		$pages = new Pagination(['totalCount' => $countQuery->count()]);
		$models = $query->offset($pages->offset)
			->limit($pages->limit)
			->all();
		// print_r($models);die;
		return $this->render('show', [
			 'models' => $models,
			 'pages' => $pages,
		]);
	}
    public function actionInsert(){
        return $this->render('insert',['model'=>[]]);
    }
	public function actionEdit(){
		//echo Yii::$app->homeUrl;
        $request=Yii::$app->request;
		
		$id=$request->get('id');
		$query = PublicNumber::find()->where(['pub_id'=>$id])->one();
		$url=$request->hostinfo.substr($request->baseUrl,0,strrpos($request->baseUrl,'/'));
        return $this->render('insert',['model'=>$query,'url'=>$url]);
    }
	public function actionDelete(){
        $request=Yii::$app->request;
		$id=$request->get('id');
		$query = PublicNumber::deleteAll('pub_id='.$id);
		$querys = Access::deleteAll('pub_id='.$id);
		$queryss = Menu::deleteAll('pub_id='.$id);
		$this->redirect('index.php?r=num/show');
    }
    //切换
    public function actionCut(){
    	$id=$_GET['id'];
    	$session = Yii::$app->session;
    	$session->open();
    	$session->set('id',$id);
    	if($session->get("id")==$id){
    		$this->redirect('index.php?r=num/show');
    	}else{
    		$this->redirect('index.php?r=num/show');
    	}
    }
    public function actionAdd(){
		$pub = new PublicNumber;
		$request=Yii::$app->request;
		$data=$request->post();
		$data['pub_type']=4;
		$data['pub_token']=$this->random(32,'all');
		$data['pub_code']=$this->random(6,'all');
		$data['u_id']=1;
		foreach($data as $k=>$v){
			$pub->$k=$v;
		}
		$access_token=$this->getAccessToken($data['pub_appid'],$data['pub_appsecret']);
		if($access_token==null){
			echo "<script>alert('appid或appsecret错误');history.go(-1)</script>";
		}else{
			if($pub->save()>0){
				$access = new Access();
				$arr=array(
					'acc_addtime'=>time(),
					'pub_id'=>$pub->pub_id,
					'acc_token'=>$access_token
				);
				$access->attributes=$arr;
				if($access->save()>0){ 
					$menus=$this->getMenu($pub->pub_id,$pub->pub_appid,$pub->pub_appsecret);
                    $menu_arr=json_decode($menus);
                    $menus=isset($menu_arr->errcode)?null:$menus;
					$menu=new Menu();
					$menu->pub_id=$pub->pub_id;
					$menu->m_name=$menus;
					$menu->save();
					/*公众号id存session*/    	
					$session = Yii::$app->session;
					$session->set('id',$pub->pub_id);
					$this->redirect('index.php?r=num/edit&id='.$pub->pub_id);
				}else{
					echo 01;
				}
			}else{
				echo 0;
			}
			
		}
		
	
    }
	public function actionUpdate(){
		$pub = new PublicNumber;
		$request=Yii::$app->request;
		$data=$request->post();
		$data['u_id']=1;
		$id=$data['pub_id'];
		unset($data['pub_id']);
		// print_r($data);die;
		$count = $pub->updateAll($data,['pub_id'=>$id]);
		if($count>0){
			echo "<script>alert('更新公众号成功');location.href='index.php?r=num/edit&id=$id'</script>";
		}else{
			$this->redirect('index.php?r=num/edit&id='.$id);
		}
    }
	/* 
	*@param1:微信公众号的appid
	*@param2:微信公众号的appsecrept
	*@return:生成access_token,有效期为2小时
	*/
	private function getAccessToken($appid,$appsecret){
		$url="https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=$appid&secret=$appsecret";
		$json=file_get_contents($url);
		$arr=json_decode($json,true);
		return isset($arr['access_token'])?$arr['access_token']:null;
	}
	
	private function AccessToken($id,$appid,$appsecret)
	{
		$access = new Access();
		$arr=$access->find()->where(['pub_id' => $id])->one();
		if(time()-$arr['acc_addtime']>7180){
			$access_token=$this->getAccessToken($appid,$appsecret);
			$access->acc_token = $access_token;
			$access->save();  // 等同于 $customer->update();
		}else{
			$access_token=$arr['acc_token'];
		}
		return $access_token;
		
	}
	/* 
	*@return:公众号的自定义菜单
	*/
	private function getMenu($id,$appid,$appsecret)
	{
		$url="https://api.weixin.qq.com/cgi-bin/menu/get?access_token=".$this->AccessToken($id,$appid,$appsecret);
		return file_get_contents($url);
		
	}
	/* 
	*@param1:返回随机字符串的长度
	*@param2:返回随机字符串的类型
	*@param3:返回随机字符串的大小写
	*@return:符合条件的随机字符串
	*/
	private function random($length=6, $type='string', $convert=0){
	 
		$config = array(
			'number'=>'1234567890',
			'letter'=>'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ',
			'string'=>'abcdefghjkmnpqrstuvwxyzABCDEFGHJKMNPQRSTUVWXYZ23456789',
			'all'=>'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890'
		);
		if(!isset($config[$type])) $type = 'string';
		$string = $config[$type];
		$code = '';
		$strlen = strlen($string) -1;
		for($i = 0; $i < $length; $i++){
			$code .= $string{mt_rand(0, $strlen)};
		}
		if(!empty($convert)){
			$code = ($convert > 0)? strtoupper($code) : strtolower($code);
		}
		return $code;
	}
}