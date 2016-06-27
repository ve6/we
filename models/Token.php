<?php

namespace app\models;

use Yii;
use yii\base\Model;
use app\models\Access;

class Token extends Model
{
	/* 
	*@param1:微信公众号的appid
	*@param2:微信公众号的appsecrept
	*@return:生成access_token,有效期为2小时
	*/
	public function getAccessToken($appid,$appsecret){
		$url="https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=$appid&secret=$appsecret";
		$json=file_get_contents($url);
		$arr=json_decode($json,true);
		return isset($arr['access_token'])?$arr['access_token']:null;
	}
	
	public function AccessToken($id,$appid,$appsecret)
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
	public function getMenu($id,$appid,$appsecret)
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
	public function random($length=6, $type='string', $convert=0){
	 
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
