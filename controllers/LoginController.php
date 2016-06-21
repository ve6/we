<?php

namespace app\controllers;

use yii\web\Controller;
use app\models\Users;

class LoginController extends Controller{
	// public $layout=false;
	public function init(){
        parent::init();
		if(!file_exists('install.zjw')){
			$this->redirect('index.php?r=install/one');
		}
    }
	public function actionIndex()
    {

        isset($_COOKIE['name'])?$cook=$_COOKIE['name']:$cook="";
        if($cook=="")
        {
            return $this->renderAjax('index');

        }else
        {
           return  $this->redirect("index.php?r=index/index");
        }

	}
    public $enableCsrfValidation = false;
    //注册
    public function actionRegister(){
        return $this->render('register');
    }
    public  function  actionLogin()
    {
        $con=\Yii::$app->request;
        $name=$con->post('u_name');
        $pwd=$con->post('u_pwd');

        $info = Users::findAll(array('u_name'=>$name));
        if($info){
            if(Users::findAll(array('u_pwd'=>$pwd)))
            {
              $qt=$con->post('qt');
			  // echo gettype($qt);die;
              if($qt=='1')
              {
                  setcookie('name',$name,time()+3600*24*7);
                  $this->redirect("index.php?r=index/index");
              }else{
				  setcookie('name',$name);
                  $this->redirect("index.php?r=index/index");
              }

            }else{
                echo "<script>alert('密码错误');location.href='index.php?r=login/index'</script>";
            }

        }else{
            echo "<script>alert('没有此账号');location.href='index.php?r=login/index'</script>";
        }
    }
    public  function actionAdd()
    {
        $con=\Yii::$app->request;
        $arr=new Users;
        $arr->u_name=$con->post("u_name");
        $arr->u_phone=$con->post("u_phone");
        $arr->u_email=$con->post("u_email");
        $arr->u_pwd=$con->post("u_pwd");
      if($arr->save()>0)
      {
          echo "<script>alert('注册成功,前往登陆');location.href='index.php?r=login/index'</script>";
      }else
        {
            echo "BUG";
        }


    }

    public function actionFrom(){

        return $this->renderAjax('from');
    }
	/*用户退出*/
	public function actionClea()
	{
		setcookie('name',null);
		$this->redirect("index.php?r=login/index");
		//echo 11;
	}

}