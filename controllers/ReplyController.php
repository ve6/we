<?php

namespace app\controllers;

use yii\web\Controller;

class ReplyController extends Controller{
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
	public function actionIndex()
	{
       $session = \Yii::$app->session;
       $session->open();
       $id=isset($session["id"])?$session["id"]:null;
       return  $this->render("show",array('id'=>$id));
	}
	
	/* 消息回复 添加入库*/
	public $enableCsrfValidation=false;
	function actionAdd(){
		$post=\Yii::$app->request;
		$title=$post->post("p_title");
		$key=$post->post('p_keysword');
		$content=$post->post('p_content');
		$pub_id=$post->post('pub_id');
		$con=\Yii::$app->db;
		$a=$con->createCommand()->insert("info_reply",[
			'pub_id'=>"$pub_id",
			'p_title'=>"$title",
			'p_keysword'=>"$key",
			'p_content'=>"$content",
		])->execute();
		if($a){
			$this->redirect("index.php?r=reply/list");
		}
	}
    ///列表
    public function actionList(){
        $con=\Yii::$app->db;
        $session = \Yii::$app->session;
        $session->open();
        $id=$session->get("id");
        $arr=$con->createCommand("select * from info_reply where pub_id=$id")->queryAll();
        return $this->render("list",array("arr"=>$arr));
    }
    //修改规则
    public function actionSave(){
        $post=\Yii::$app->request;
        $id=$post->get("id");
        $con=\Yii::$app->db;
        $result=$con->createCommand("select * from info_reply where p_id=$id")->queryOne();
        return $this->render("insert",array("ar"=>$result));
    }
    public function actionUpd(){
        $post=\Yii::$app->request;
        $id=$post->post("id");
        $title=$post->post("p_title");
        $key=$post->post("p_keysword");
        $content=$post->post("p_content");
        $con=\Yii::$app->db;
        $ar=$con->createCommand()->update("info_reply",['p_title'=>$title,'p_keysword'=>$key,'p_content'=>$content],"p_id=$id")->execute();
        if($ar){
            $this->redirect("index.php?r=reply/list");
        }
    }
    public function actionDel(){
        $post=\Yii::$app->request;
        $id=$post->get("id");
        $con=\Yii::$app->db;
        $a=$con->createCommand()->delete("info_reply","p_id=$id")->execute();
        if($a){
            $this->redirect("index.php?r=reply/list");
        }
    }

}