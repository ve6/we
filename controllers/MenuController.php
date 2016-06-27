<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\models\Menu;
use app\models\Token;
use app\models\PublicNumber;

class MenuController extends Controller{
	public $layout=false;
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
	/*
	 * 渲染自定义菜单添加页面
	 * @wei
	 * 2016.6.17	
	 */
	public function actionIndex(){
		
	   header("content-type:text/html;charset=utf-8");
	   $session = \Yii::$app->session;
       $session->open();
       $id=isset($session["id"])?$session["id"]:null;
	   $menu = Menu::find()
		->where(['pub_id' => $id])
		->one();
		//print_r($menu['m_name']) ;die;
		$menus=json_decode($menu['m_name'],true);
		//print_r($menus);die;
		foreach($menus as $key=>$val){
			foreach($val as $ke=>$va){
				
			}			
		}
		//print_r($val);die;
		return  $this->render('menu',array('pub_id'=>$id,'menu'=>$va));
	}
	
		/*
	 * 自定义菜单入库处理
	 * @wei
	 * 2016.6.21
	 */
	 public function actionInsert()
	 {		 
		 $menu='{"button":'.$_POST['menu'].'}';
		 $session = \Yii::$app->session;
		 $pub = new PublicNumber;
		 $apps=$pub->find()->where('pub_id='.$session['id'])->one();
		 $token=new Token();
		 $token=$token->AccessToken($session['id'],$apps['pub_appid'],$apps['pub_appsecret']);
		 $url="https://api.weixin.qq.com/cgi-bin/menu/create?access_token=".$token;
		 $json=$this->weixinpost($url,$menu);
		 $arr=json_decode($json,true);		 
		 if($arr['errcode']==0){
		 $connection = Yii::$app->db;
		 $menus = '{"menu":'.$menu.'}';
		 $connection->createCommand()->update('menu', ['m_name' => $menus], 'pub_id='.$session['id'])->execute();
		 
		 echo '设置自定义菜单成功啦！！';
		 }else{
			 echo '设置自定义菜单失败';			 
		 }
	 }
	  /*CURL 模拟post请求*/
	 private function weixinpost($url,$data){
		$ch = curl_init();   //1.初始化  
		curl_setopt($ch, CURLOPT_URL, $url); //2.请求地址  
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');//3.请求方式  
		//4.参数如下  
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);//https  
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);  
		curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (compatible; MSIE 5.01; Windows NT 5.0)');//模拟浏览器  
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);  
		curl_setopt($ch, CURLOPT_AUTOREFERER, 1);  
		curl_setopt($ch, CURLOPT_POSTFIELDS, $data);  
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);  
		$tmpInfo = curl_exec($ch);//6.执行  
	  
		if (curl_errno($ch)) {//7.如果出错  
			return curl_error($ch);  
		}  
		curl_close($ch);//8.关闭  
		return $tmpInfo;  
	}
}