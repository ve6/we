<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "public_number".
 *
 * @property integer $pub_id
 * @property integer $u_id
 * @property string $pub_name
 * @property integer $pub_type
 * @property string $pub_appid
 * @property string $pub_token
 * @property string $pub_appsecret
 * @property string $pub_num
 * @property string $pub_code
 */
class PublicNumber extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{public_number}}';
    }
}
