<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "info_reply".
 *
 * @property integer $p_id
 * @property integer $pub_id
 * @property string $p_title
 * @property string $p_keysword
 * @property string $p_content
 */
class InfoReply extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{info_reply}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['pub_id'], 'integer'],
            [['p_title', 'p_keysword'], 'string', 'max' => 100],
            [['p_content'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'p_id' => 'P ID',
            'pub_id' => 'Pub ID',
            'p_title' => 'P Title',
            'p_keysword' => 'P Keysword',
            'p_content' => 'P Content',
        ];
    }
}
