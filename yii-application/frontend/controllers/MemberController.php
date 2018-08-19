<?php

namespace frontend\controllers;

use common\models\BonusRecord;
use common\models\Order;
use yii;
use yii\data\Pagination;
use yii\db\Query;
use yii\web\Controller;

class MemberController extends Controller
{
    public $enableCsrfValidation = false;
    public $layout = false;
    const DEFAULT_SIZE = 10;

    public function actionInfo()
    {
        $id = 10000;
        $page = Yii::$app->request->get('page');
        $limit = Yii::$app->request->get('limit') ? Yii::$app->request->get('limit') : self::DEFAULT_SIZE;
        $offset = ($page - 1) * $limit;
        $user = (new Query())->from('user')->where(['id' => $id])->one();
        $memberQuery = (new Query())->from('user')->where(['p_id' => $id])->orderBy('created_time desc');
        $pages = new Pagination(['totalCount' => $memberQuery->count(), 'pageSize' => self::DEFAULT_SIZE]);
        $memberList = $memberQuery->offset($offset)->limit($limit)->all();
        return $this->render('info', ['user' => $user, 'memberList' => $memberList, 'pages' => $pages]);
    }

    public function actionQrcode()
    {
        $id = 10000;
        $link = $_SERVER['HTTP_HOST'].'/index.php?r=member/register&id='.$id;
        return $this->render('qrcode',['link'=>$link] );
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


}
