<?php

namespace common\models;

use Yii;
use yii\base\NotSupportedException;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\db\Query;
use yii\web\IdentityInterface;

class BonusRecord extends ActiveRecord
{

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%bonus_record}}';
    }

    public static function addRecord($orderId,$type=1){
            $order = (new Query())->from('order')->where(['id'=>intval($orderId)])->one();
            if(empty($order)){
                    return false;
            }
          $bonusRecord = new BonusRecord();
          $bonusRecordData = [
                'user_id'=>,
              'order_id'=>,
              'bonus_amount'=>,
              'order_amount'=>,
              'old_balance'=>,
              'new_balance'=>,
              'created_time'=>,
              'from_id'=>,
              'type'=>,
          ];
    }


}
