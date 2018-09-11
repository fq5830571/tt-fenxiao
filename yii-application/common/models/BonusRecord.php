<?php

namespace common\models;

use Yii;
use yii\base\NotSupportedException;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\db\Exception;
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

    public static function addRecord($orderId)
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
            $parentScale = 0;
            $ownScale = 0.1;
            $result = self::record($orderId,$order['user_id'],$order['amount'],$ownScale);
            if(empty($result)){
                throw new \Exception("标记失败1");
            }
            if ($user['p_id']) {
                $parentScale = 0.02;
                $result =  self::record($orderId,$user['p_id'],$order['amount'],$parentScale);
                if(empty($result)){
                    throw new \Exception("标记失败2");
                }
            }
            $companyScale = 1-$parentScale-$ownScale;
            $result =  self::record($orderId,99999,$order['amount'],$companyScale);
            if(empty($result)){
                throw new \Exception("标记失败3");
            }
            $transaction->commit();
            return [true, '成功'];
        } catch (\Exception $e) {
            $transaction->rollBack();
            return [false, $e->getMessage()];
        }

    }

    private function record($orderId,$userId,$amount,$scale){
        try{
            $result = (new Query())->from(self::tableName())->where(['order_id' => $orderId, 'user_id' => $userId])->one();
            if ($result) {
                throw new \Exception("已经结算过佣金，请勿重复结算");
            }
            $user = (new Query())->from('user')->where(['id' => intval($userId)])->one();
            $bonusAmount = $amount * $scale;
            $bonusRecord = new BonusRecord();
            $bonusRecordData = [
                'user_id' => $userId,
                'order_id' => $orderId,
                'bonus_amount' => $bonusAmount,
                'order_amount' => $amount,
                'old_balance' => $user['balance'],
                'new_balance' => ($user['balance'] + $bonusAmount),
                'created_time' => time(),
                'type' => 1,
            ];
            $bonusRecord->setAttributes($bonusRecordData, false);
            $result = $bonusRecord->save();

            if (empty($result)) {
                throw new \Exception("插入记录表失败");
            }
            $result = User::updateAll(['balance' => new Expression('balance+' . $bonusAmount)], ['id' => $userId]);
            if (empty($result)) {
                throw new \Exception("返佣金失败");
            }
            return true;
        }catch (Exception $e){
            return false;
        }

    }


}
