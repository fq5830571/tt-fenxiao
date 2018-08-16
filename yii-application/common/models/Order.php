<?php

namespace common\models;

use Yii;
use yii\base\NotSupportedException;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;

class Order extends ActiveRecord
{

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%order}}';
    }

    /**
     * 生成订单编号
     * @return string
     */
    public static function generateOrderNum()
    {
        $res = false;
        while ($res == false) {
            $orderSn = rand(100000, 999999) . time();
            $result = (new Query())->from('order')->where('order_sn=' . $orderSn)->limit(1)->one();
            if (empty($result)) {
                $res = true;
            }
        }
        return $orderSn;
    }


}
