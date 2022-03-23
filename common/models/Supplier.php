<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2022/3/23
 * Time: 14:31
 */

namespace common\models;

use Yii;
use yii\db\ActiveRecord;

class Supplier extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%supplier}}';
    }
}