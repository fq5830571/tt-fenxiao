<?php

namespace frontend\controllers;

use common\models\BonusRecord;
use common\models\Order;
use yii;
use yii\data\Pagination;
use yii\db\Query;
use yii\web\Controller;

class AdminController extends Controller
{
    public $enableCsrfValidation = false;
    public $layout = false;
    const DEFAULT_SIZE = 10;

    public function actionIndex()
    {
        return $this->render('index');
    }
    public function actionHome()
    {
        $todayEndTime  = strtotime(date('Ymd 23:59:59',time()));
        $todayStartTime = $todayEndTime - 86400;
        $userCount = (new Query())->from('user')->where('created_time >='.$todayStartTime)->andWhere('created_time <='.$todayEndTime)->count();
        $currentOrderCount = (new Query())->from('order')->where('created_time >='.$todayStartTime)->andWhere('created_time <='.$todayEndTime)->count();
        $currentBonusAmount = (new Query())->from('bonus_record')->where('created_time >='.$todayStartTime)->andWhere('created_time <='.$todayEndTime)->sum('bonus_amount');
        return $this->render('home',['userCount'=>$userCount,'currentOrderCount'=>$currentOrderCount,'currentBonusAmount'=>$currentBonusAmount]);
    }

    public function actionOrderView()
    {
        $page = Yii::$app->request->get('page');
        $limit = Yii::$app->request->get('limit') ? Yii::$app->request->get('limit') : self::DEFAULT_SIZE;
        $offset = ($page - 1) * $limit;

        $orderQuery = (new Query())->from('order')
            ->select('order.*,user.name')
            ->leftJoin('user', 'user.id = order.user_id')
            ->orderBy('created_time desc');
        $pages = new Pagination(['totalCount' => $orderQuery->count(), 'pageSize' => self::DEFAULT_SIZE]);
        $orderList = $orderQuery->offset($offset)->limit($limit)->all();

        foreach ($orderList as &$order) {
            $order['created_time'] = date('Y-m-d H:i:s', $order['created_time']);
        }
        return $this->render('order_list', ['orderList' => $orderList, 'pages' => $pages]);
    }

    public function actionBonusView()
    {
        $page = Yii::$app->request->get('page');
        $limit = Yii::$app->request->get('limit') ? Yii::$app->request->get('limit') : self::DEFAULT_SIZE;
        $offset = ($page - 1) * $limit;
        $name = Yii::$app->request->post('name');
        $bonusQuery = (new Query())->from('bonus_record')
            ->select('bonus_record.*,user.name,user.balance,order.order_sn')
            ->leftJoin('user', 'user.id = bonus_record.user_id')
            ->leftJoin('order', 'order.id = bonus_record.order_id')
            ->orderBy('bonus_record.created_time desc');
        if ($name) {
            $bonusQuery->andwhere([
                'or',
                ['like', 'user.name', $name],
            ]);
        }
        $pages = new Pagination(['totalCount' => $bonusQuery->count(), 'pageSize' => self::DEFAULT_SIZE]);
        $bonusList = $bonusQuery->offset($offset)->limit($limit)->all();

        foreach ($bonusList as &$bonus) {
            $bonus['created_time'] = date('Y-m-d H:i:s', $bonus['created_time']);
        }
        return $this->render('bonus', ['bonusList' => $bonusList, 'pages' => $pages]);
    }

    /**
     * 标记支付
     */
    public function actionPayOrder()
    {
        $transaction = Yii::$app->db->beginTransaction();
        try {
            $id = Yii::$app->request->post('id');
            if (empty($id)) {
                throw new \Exception("请选择订单");
            }
            $order = (new Query())->from('order')->where(['id' => $id])->one();
            if (empty($order)) {
                throw new \Exception("查无此订单");
            }
            if ($order['status'] == 1) {
                throw new \Exception("已经标记过，无需在标记");
            }
            list($result, $msg) = BonusRecord::addRecord($id);
            if ($result === false) {
                throw new \Exception($msg);
            }
            $result = Order::updateAll(['status' => 1], ['id' => $id]);
            if (empty($result)) {
                throw new \Exception('标记失败');
            }
            $transaction->commit();
            $this->asJson(['success' => 1, 'code' => 200, 'msg' => '标记成功']);
        } catch (\Exception $e) {
            $transaction->rollBack();
            $this->asJson(['success' => 0, 'code' => 2001, 'msg' => $e->getMessage()]);
        }
    }


}
