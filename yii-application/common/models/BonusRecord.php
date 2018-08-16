<?php

namespace common\models;

use Yii;
use yii\base\NotSupportedException;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\db\Expression;
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

    public static function addRecord($orderId, $type = 1)
    {
        $transaction = Yii::$app->db->beginTransaction();
        try {
            $order = (new Query())->from('order')->where(['id' => intval($orderId)])->one();
            if (empty($order)) {
                throw new \Exception("查无此订单");
            }
            $user = (new Query())->from('user')->where(['id' => intval($order['user_id'])])->one();
            if (empty($user)) {
                throw new \Exception("查无此用户");
            }
            $bonusAmount = $order['amount'] * Yii::$app->params['bonus_scale'];
            if ($user['p_id']) {
                $result = (new Query())->from(self::tableName())->where(['order_id' => $orderId, 'user_id' => $user['p_id']])->one();
                if ($result) {
                    throw new \Exception("已经结算过佣金，请勿重复结算");
                }
                $bonusRecord = new BonusRecord();
                $bonusRecordData = [
                    'user_id' => $user['p_id'],
                    'order_id' => $orderId,
                    'bonus_amount' => $bonusAmount,
                    'order_amount' => $order['amount'],
                    'old_balance' => $user['balance'],
                    'new_balance' => ($user['balance'] + $bonusAmount),
                    'created_time' => time(),
                    'from_id' => $user['id'],
                    'type' => $type,
                ];
                $bonusRecord->setAttributes($bonusRecordData, false);
                $result = $bonusRecord->save();
                if (empty($result)) {
                    throw new \Exception("插入记录表失败");
                }
                $result = User::updateAll(['balance' => new Expression('balance+' . $bonusAmount)], ['id' => $user['p_id']]);
                if (empty($result)) {
                    throw new \Exception("返佣金失败");
                }
            }
            $transaction->commit();
            return [true, '成功'];
        } catch (\Exception $e) {
            $transaction->rollBack();
            return [false, $e->getMessage()];
        }

    }


}
