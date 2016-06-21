<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "access".
 *
 * @property integer $acc_id
 * @property string $acc_token
 * @property integer $acc_addtime
 * @property integer $pub_id
 */
class Access extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{access}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['acc_addtime', 'pub_id'], 'integer'],
            [['acc_token'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'acc_id' => 'Acc ID',
            'acc_token' => 'Acc Token',
            'acc_addtime' => 'Acc Addtime',
            'pub_id' => 'Pub ID',
        ];
    }
}
