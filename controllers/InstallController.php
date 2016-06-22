<?php

namespace app\controllers;

use yii\web\Controller;
use app\models\Users;

class InstallController extends Controller{
	public $layout=false;
	public $enableCsrfValidation=false;
    public function init(){
        parent::init();
        if(file_exists('install.zjw')){
			$this->redirect('index.php?r=login/index');
		}else{
			@session_destroy();
			setcookie('name','');
		}
    }
	public function actionOne(){
        return  $this->render("one");
	}
    public function actionTwo(){
		$os=php_uname();
        return $this->render('two',['OS'=>$os]);
    }
    public function actionThree(){
        return $this->render('three');
    }
	public function actionCheck(){
		$post=\Yii::$app->request->post();
		@$link=mysql_connect($post['db_server'].':'.$post['db_port'],$post['db_username'],$post['db_password']);
		
		if(empty($link)){
			echo 0;
		}else{
			$db_selected = mysql_select_db($post['db_name'], $link);
			if($db_selected){
				$sql="drop database ".$post['db_name'];
				mysql_query($sql);
			}
			$sql="create database ".$post['db_name'];
			mysql_query($sql);
			$file=file_get_contents('we.sql');
			$arr=explode(';',trim($file,"\n"));
			array_pop($arr);
			$db_selected = mysql_select_db($post['db_name'], $link);
			for($i=0;$i<count($arr);$i++){
				mysql_query($arr[$i]);
			}
			$str="<?php
					return [
						'class' => 'yii\db\Connection',
						'dsn' => 'mysql:host=".$post['db_server'].";port=".$post['db_port'].";dbname=".$post['db_name']."',
						'username' => '".$post['db_username']."',
						'password' => '".$post['db_password']."',
						'charset' => 'utf8',						
					];";
			file_put_contents('../config/db.php',$str);

			$sql="insert into users set u_name='".$post['user_username']."' , u_pwd='".$post['user_password']."'";
			$re=mysql_query($sql);
			if($re){
				echo 123;
			}
			file_put_contents('install.zjw','123');
		}
    }
}