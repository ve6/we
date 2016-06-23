<?php

namespace app\controllers;

use yii\web\Controller;
use app\models\Menu;

class MenuController extends Controller{
	public $layout='nav.php';
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
		
	   $session = \Yii::$app->session;
       $session->open();
       $id=isset($session["id"])?$session["id"]:null;
	   $menu = Menu::find()
		->where(['pub_id' => $id])
		->one();
		//echo gettype($menu['m_name']);die;
		$menus=json_decode($menu['m_name'],true);
		//var_dump($menus);die;
        return  $this->render("show",array('pub_id'=>$id,'menu'=>$menus));
	}
	
	/*
	 * 自定义菜单处理
	 * @wei
	 * 2016.6.21
	 */
	 public function actionList()
	 {
		 header("content-type:text/html;charset=utf-8");
		 $connection=\Yii::$app->db;
		 $session = \Yii::$app->session;
		 $pub_id=$session->get("id");
		 //echo $pub_id;die;
		 
		 
		 $sql1 = "select id,name from menu where pub_id=$pub_id and parent_id=0"; 
		 $command = $connection->createCommand($sql1);
		 $arr1 = $command->queryAll();
		 foreach($arr1 as $k=>$v){
			 $s[$k] = $v['name'];
			 $id[$k] = $v['id'];
			 //echo $id[$k];
			 $sql = "select type,name,url from menu where pub_id=$pub_id and parent_id!=0 and parent_id=".$v['id'];
			  $command = $connection->createCommand($sql);
				$arr = $command->queryAll();
		 }
		 print_r($arr);
		 die;

		
		 $arr2 = array('name'=>$s,'sub_button'=>$arr);
		 $new_arr = array('button'=>$arr2);
		 print_r($new_arr);
		 
		 // $json = json_encode($arr);
		 // echo $json;
	 }
}