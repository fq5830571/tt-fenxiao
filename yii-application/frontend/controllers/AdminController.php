<?php

namespace frontend\controllers;

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

    public function actionOrderView()
    {
        $page = Yii::$app->request->get('page');
        $limit = Yii::$app->request->get('limit') ? Yii::$app->request->get('limit') : self::DEFAULT_SIZE;
        $offset = ($page - 1) * $limit;

        $orderQuery = (new Query())->from('order')
            ->select('order.*,user.name')
            ->leftJoin('user','user.id = order.user_id')
            ->orderBy('created_time desc');
        $pages = new Pagination(['totalCount' => $orderQuery->count(), 'pageSize' => self::DEFAULT_SIZE]);
        $orderList = $orderQuery->offset($offset)->limit($limit)->all();

        foreach ($orderList as &$order){
            $order['created_time'] = date('Y-m-d H:i:s',$order['created_time']);
        }
        return $this->render('order_list',['orderList'=>$orderList,'pages'=>$pages]);
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
            $order = (new Query())->from('order')->where(['id'=>$id])->one();
            if (empty($order)) {
                throw new \Exception("查无此订单");
            }
            $parentId = $order['p_id'];
            if($parentId){

            }
            $transaction->commit();
            $this->asJson(['success' => 1, 'code' => 200, 'msg' => '删除成功']);
        } catch (\Exception $e) {
            $transaction->rollBack();
            $this->asJson(['success' => 0, 'code' => 2001, 'msg' => $e->getMessage()]);
        }
    }


}
