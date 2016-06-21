<?php

namespace app\models;

use yii\base\Model;
use yii\db\ActiveRecord;

class Users extends ActiveRecord
{
	/**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{users}}';
    }
}