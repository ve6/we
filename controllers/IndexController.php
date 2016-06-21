<?php

namespace app\controllers;

use yii\web\Controller;

class IndexController extends Controller{
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
	public function actionIndex(){
        return  $this->render("index");
	}
    public function actionFrom(){
        return $this->render('from');
    }
    public function actionFroms(){
        return $this->render('from2');
    }
    public function actionFromss(){
        return $this->render('from3');
    }
    public function actionFromsss(){
        return $this->render('from3');
    }
}