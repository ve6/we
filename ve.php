<?php
/**
  * wechat php test
  */
$db=include 'config/db.php';
define("DSN", $db['dsn']);
define("username", $db['username']);
define("password", $db['password']);
$code=$_GET['code'];
$pdo=new PDO(DSN,username,password);
$rs=$pdo->query("select `pub_id`,`pub_appid`,`pub_token`,`pub_appsecret` from public_number where pub_code='$code'");
$result_arr = $rs->fetchAll(PDO::FETCH_ASSOC);
$arr=$result_arr[0];
define("TOKEN", $arr['pub_token']);
define("PUBID", $arr['pub_id']);
define("APPID", $arr['pub_appid']);
define("APPSECRET", $arr['pub_appsecret']);
$wechatObj = new wechatCallbackapiTest();
$wechatObj->valid();

class wechatCallbackapiTest
{
    public function valid()
    {
        $echoStr = $_GET["echostr"];
        
        //valid signature , option
        if($this->checkSignature()){
            echo $echoStr;
			// print_r($this->getMediaId());die;
			//echo $this->createmenu();
            $this->responseMsg();
			
            exit;
        }
    }
    
    public function responseMsg()
    {
        //get post data, May be due to the different environments
        $postStr = $GLOBALS["HTTP_RAW_POST_DATA"];
        //extract post data
        if (!empty($postStr)){
            /* libxml_disable_entity_loader is to prevent XML eXternal Entity Injection,the best way is to check the validity of xml by yourself */
            libxml_disable_entity_loader(true);
            $postObj = simplexml_load_string($postStr, 'SimpleXMLElement', LIBXML_NOCDATA);
            $fromUsername = $postObj->FromUserName;
            $toUsername = $postObj->ToUserName;
            $keyword = trim($postObj->Content);
			
            $time = time();
			// $picTpl="<xml>
					// <ToUserName><![CDATA[%s]]></ToUserName>
					// <FromUserName><![CDATA[%s]]></FromUserName>
					// <CreateTime>%s</CreateTime>
					// <MsgType><![CDATA[%s]]></MsgType>
					// <Image>
					// <MediaId><![CDATA[%s]]></MediaId>
					// </Image>
					// </xml>";
            $textTpl = "<xml>
                        <ToUserName><![CDATA[%s]]></ToUserName>
                        <FromUserName><![CDATA[%s]]></FromUserName>
                        <CreateTime>%s</CreateTime>
                        <MsgType><![CDATA[%s]]></MsgType>
                        <Content><![CDATA[%s]]></Content>
                        <FuncFlag>0</FuncFlag>
                        </xml>";             
            if(!empty( $keyword ))
            {
				
				$pdo=$this->pdo();
                $re= $pdo->query("select `p_content` from info_reply where p_keysword='".$keyword."' and pub_id=".PUBID);
                $p_content=$re->fetchColumn();
                if($p_content){ 
                    $msgType = "text";
					$contentStr = $p_content;
                    //$contentStr = $this->getMediaId();
                    $resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType, $contentStr);
					// $msgType = "image";
                    // $contentStr = $this->getMediaId();
                    // $resultStr = sprintf($picTpl, $fromUsername, $toUsername, $time, $msgType, $contentStr);
                    echo $resultStr;
                }else{
                    $msgType = "text";
                    $contentStr = '有时候阳光很好，有时候阳光很暗，这就是生活!';
                    $resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType, $contentStr);
                    echo $resultStr;
                }
            }else{
                $msgType = "text";
                $contentStr = '欢迎关注';
                $resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType, $contentStr);
                echo $resultStr;
            }
            
        }else {
            echo "";
            exit;
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
	
	private function AccessToken()
	{
		$pdo=$this->pdo();
		// echo 'select acc_token from access where pub_id='.PUBID;die;
		$re=$pdo->query('select acc_token,acc_addtime from access where pub_id='.PUBID);
		$arr=$re->fetchAll(PDO::FETCH_ASSOC);
		if(time()-$arr['acc_addtime']>7180){
			$access_token=$this->getAccessToken(APPID,APPSECRET);
			$pdo->exec("update access set acc_token='$access_token',acc_addtime=".time().'where pub_id='.PUBID);
		}else{
			$access_token=$arr['acc_token'];
		}
		return $access_token;
		
	}
	
	public function getMediaId(){
		$access_token = $this->AccessToken();
		
		// $url="https://api.weixin.qq.com/cgi-bin/material/batchget_material?access_token=".$access_token;
		$url="https://api.weixin.qq.com/cgi-bin/media/upload?access_token=$access_token&type=image";
		// $url='http://1.wqing7.applinzi.com/we/phpinfo.php';
		$json=$this->curl($url,['file'=>'@images/a.jpg']);
		$arr=json_decode($json,true);
		return isset($arr['media_id'])?$arr['media_id']:null;
	}
	
	private function curl($url,$data){
		$ch = curl_init();   //1.初始化  
		curl_setopt($ch, CURLOPT_URL, $url); //2.请求地址  
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');//3.请求方式  
		//4.参数如下  
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);//https  
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);  
		curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (compatible; MSIE 5.01; Windows NT 5.0)');//模拟浏览器  
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);  
		curl_setopt($ch, CURLOPT_AUTOREFERER, 1);  
		curl_setopt($ch, CURLOPT_HTTPHEADER,array('Accept-Encoding: gzip, deflate'));//gzip解压内容  
		curl_setopt($ch, CURLOPT_ENCODING, 'gzip,deflate');  

		curl_setopt($ch, CURLOPT_POSTFIELDS, $data);  
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);  
		$tmpInfo = curl_exec($ch);//6.执行  
	  
		if (curl_errno($ch)) {//7.如果出错  
			return curl_error($ch);  
		}  
		curl_close($ch);//8.关闭  
		return $tmpInfo; 
	}
	
	private function pdo(){
		return new PDO(DSN,username,password);
	}
            
    private function checkSignature()
    {
        // you must define TOKEN by yourself
        if (!defined("TOKEN")) {
            throw new Exception('TOKEN is not defined!');
        }
        
        $signature = $_GET["signature"];
        $timestamp = $_GET["timestamp"];
        $nonce = $_GET["nonce"];
        
        $token = TOKEN;
        $tmpArr = array($token, $timestamp, $nonce);
        // use SORT_STRING rule
        sort($tmpArr, SORT_STRING);
        $tmpStr = implode( $tmpArr );
        $tmpStr = sha1( $tmpStr );
        return true;
        if( $tmpStr == $signature ){
            return true;
        }else{
            return false;
        }
    }
	
	/*
     * @自定义菜单
	 * @2016.6.21
	 * @wei
	 */
	 public function createmenu()
	 {
		 $access_token = $this->AccessToken();
		 $url = "https://api.weixin.qq.com/cgi-bin/menu/create?access_token=".$access_token;
		 $data = ' {
			 "button":[
			 {	
				  "type":"click",
				  "name":"推荐歌曲",
				  "key":"V1001_TODAY_MUSIC"
			  },
			  {
				   "name":"菜单",
				   "sub_button":[
				   {	
					   "type":"view",
					   "name":"搜索",
					   "url":"https://www.baidu.com/"
					},
					{
					    "type":"view",
					    "name":"视频",
					    "url":"http://v.qq.com/"
					},
					{
					   "type":"click",
					   "name":"赞一下我们",
					   "key":"V1001_GOOD"
					}]
			   }]
		 }';
		 $this->weixinpost($url,$data,"POST");
	 }
	 /*CURL 模拟post请求*/
	 private function weixinpost($url,$data,$method){
		$ch = curl_init();   //1.初始化  
		curl_setopt($ch, CURLOPT_URL, $url); //2.请求地址  
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $method);//3.请求方式  
		//4.参数如下  
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);//https  
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);  
		curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (compatible; MSIE 5.01; Windows NT 5.0)');//模拟浏览器  
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);  
		curl_setopt($ch, CURLOPT_AUTOREFERER, 1);  
		if($method=="POST"){//5.post方式的时候添加数据  
			curl_setopt($ch, CURLOPT_POSTFIELDS, $data);  
		}  
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);  
		$tmpInfo = curl_exec($ch);//6.执行  
	  
		if (curl_errno($ch)) {//7.如果出错  
			return curl_error($ch);  
		}  
		curl_close($ch);//8.关闭  
		return $tmpInfo;  
	}
}
?>
