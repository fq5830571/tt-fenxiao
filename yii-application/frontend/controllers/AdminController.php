<?php

namespace frontend\controllers;

use common\models\BonusRecord;
use common\models\Message;
use common\models\Order;
use common\models\User;
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
        $todayEndTime = strtotime(date('Ymd 23:59:59', time()));
        $todayStartTime = $todayEndTime - 86400;
        $userCount = (new Query())->from('user')->where('created_time >=' . $todayStartTime)->andWhere('created_time <=' . $todayEndTime)->count();
        $currentOrderCount = (new Query())->from('order')->where('created_time >=' . $todayStartTime)->andWhere('created_time <=' . $todayEndTime)->count();
        $currentBonusAmount = (new Query())->from('bonus_record')->where('created_time >=' . $todayStartTime)->andWhere('created_time <=' . $todayEndTime)->sum('bonus_amount');
        return $this->render('home', ['userCount' => $userCount, 'currentOrderCount' => $currentOrderCount, 'currentBonusAmount' => $currentBonusAmount]);
    }

    public function actionOrderView()
    {
        $page = Yii::$app->request->get('page');
        $limit = Yii::$app->request->get('limit') ? Yii::$app->request->get('limit') : self::DEFAULT_SIZE;
        $offset = ($page - 1) * $limit;

        $orderQuery = (new Query())->from('order')
            ->select('order.*,user.name,proof.image,proof.content,user.username,user.shequ_name')
            ->leftJoin('user', 'user.id = order.user_id')
            ->leftJoin('proof', 'proof.order_id = order.id')
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
            ->select('bonus_record.*,user.name,user.balance,order.order_sn,user.username')
            ->where('user_id <> 99999')
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

    public function actionUserView()
    {
        $page = Yii::$app->request->get('page');
        $limit = Yii::$app->request->get('limit') ? Yii::$app->request->get('limit') : self::DEFAULT_SIZE;
        $offset = ($page - 1) * $limit;

        $userQuery = (new Query())->from('user')
            ->select('user.*,pu.name as parent_name')
            ->leftJoin('user pu', 'pu.id = user.p_id')
            ->orderBy('created_time desc');
        $pages = new Pagination(['totalCount' => $userQuery->count(), 'pageSize' => self::DEFAULT_SIZE]);
        $userList = $userQuery->offset($offset)->limit($limit)->all();

        foreach ($userList as &$user) {
            $order['created_time'] = date('Y-m-d H:i:s', $user['created_time']);
            $user['level_name'] = User::getLevel($user['level']);
        }
        return $this->render('user_list', ['userList' => $userList, 'pages' => $pages]);
    }

    public function actionSetLevel()
    {
        $id = Yii::$app->request->get('id');
        $levelList = [
            1 => '一级',
            2 => '二级',
            3 => '三级',
            4 => '四级',
            5 => '五级',
        ];
        if (Yii::$app->request->isAjax) {
            $id = Yii::$app->request->post('id');
            $level = Yii::$app->request->post('level');
            $result = User::updateAll(['level' => $level], ['id' => $id]);
            if (empty($result)) {
                $this->asJson(['success' => 1, 'code' => 500, 'msg' => '修改失败']);
            } else {
                $this->asJson(['success' => 1, 'code' => 200, 'msg' => '修改成功']);
            }
        } else {
            return $this->render('set_level', ['levelList' => $levelList, 'id' => $id]);
        }

    }

    public function actionMessageView()
    {
        $page = Yii::$app->request->get('page');
        $limit = Yii::$app->request->get('limit') ? Yii::$app->request->get('limit') : self::DEFAULT_SIZE;
        $offset = ($page - 1) * $limit;

        $messageQuery = (new Query())->from('message')
            ->orderBy('created_time desc');
        $pages = new Pagination(['totalCount' => $messageQuery->count(), 'pageSize' => self::DEFAULT_SIZE]);
        $messageList = $messageQuery->offset($offset)->limit($limit)->all();

        foreach ($messageList as &$message) {
            $message['created_time'] = date('Y-m-d H:i:s', $message['created_time']);
        }
        return $this->render('message', ['messageList' => $messageList, 'pages' => $pages]);
    }

    public function actionAddMessage()
    {
        if (Yii::$app->request->isAjax) {
            $content = Yii::$app->request->post('content');
            $id = Yii::$app->request->post('id');

            if (empty($content)) {
                $this->asJson(['success' => 1, 'code' => 500, 'msg' => '请填写消息内容']);
            }
            if (empty($id)) {
                $message = new Message();
                $message->setAttributes(['content' => $content, 'created_time' => time()], false);
                $result = $message->save();
            } else {
                $result = Message::updateAll(['content' => $content], ['id' => $id]);
            }


            if (empty($result)) {
                $this->asJson(['success' => 1, 'code' => 500, 'msg' => '失败']);
            } else {
                $this->asJson(['success' => 1, 'code' => 200, 'msg' => '成功']);
            }
        } else {
            $id = Yii::$app->request->get('id');
            $message = [];
            if ($id) {
                $message = (new Query())->from('message')->where(['id' => $id])->one();
            }
            return $this->render('add_message', ['message' => $message]);
        }

    }

    public function actionEditMessage()
    {
        if (Yii::$app->request->isAjax) {
            $id = Yii::$app->request->post('id');
            $status = Yii::$app->request->post('status');
            $status = $status == 0 ? 1 : 0;
            if ($status == 1) {
                Message::updateAll(['status' => 0], 'id >0');
            }
            $result = Message::updateAll(['status' => $status], ['id' => $id]);
            if (empty($result)) {
                $this->asJson(['success' => 1, 'code' => 500, 'msg' => '修改失败']);
            } else {
                $this->asJson(['success' => 1, 'code' => 200, 'msg' => '修改成功']);
            }
        } else {
            return $this->render('add_message');
        }

    }

    public function actionUserChart(){
        /*$data = [
            'name'=>'总裁',
            'title'=>'',
        ];
        $user_1List = (new Query())->from('user')->where(['p_id'=>0])->all();
        $user1 = [];
        foreach ($user_1List as $key=>$user){
            $user1[$key]['name'] =  $user['name'];
            $user1[$key]['title'] =  $user['phone'];
            $user_2List = (new Query())->from('user')->where(['p_id'=>$user['id']])->all();
            foreach ($user_2List as $k2=>$user2){
                $user1[$key]['children'][$k2]['name'] = $user2['name'];
                $user1[$key]['children'][$k2]['title'] = $user2['phone'];
            }
        }
        $data['children'] = $user1;
        echo json_encode($data);die;
        $this->asJson($data);*/
        if (Yii::$app->request->isAjax) {
            {
                $data = [
                    'name'=>'总裁',
                    'title'=>'',
                ];
                $user_1List = (new Query())->from('user')->where(['p_id'=>0])->all();
                $users = $this->array_recursion($user_1List);

                /*foreach ($user_1List as $key=>$user){
                    $user1[$key]['name'] =  $user['name'];
                    $user1[$key]['title'] =  $user['phone'];
                    $user_2List = (new Query())->from('user')->where(['p_id'=>$user['id']])->all();
                    foreach ($user_2List as $k2=>$user2){
                        $user1[$key]['children'][$k2]['name'] = $user2['name'];
                        $user1[$key]['children'][$k2]['title'] = $user2['phone'];
                    }
                }*/
                $data['children'] = $users;
                $this->asJson($data);
            }
        } else {
            return $this->render('user_chart');
        }
    }

    private function array_recursion($user_1List){
        $data = [];
        foreach ($user_1List as $key=>$user){
            $data[$key]['name'] =  $user['username'];
            $data[$key]['title'] =  $user['phone'];
            $user_2List = (new Query())->from('user')->where(['p_id'=>$user['id']])->all();
            if($user_2List){
                $data[$key]['children'] = $this->array_recursion($user_2List);
            }
            /*foreach ($user_2List as $k2=>$user2){
                $user1[$key]['children'][$k2]['name'] = $user2['name'];
                $user1[$key]['children'][$k2]['title'] = $user2['phone'];
            }*/
        }
        return $data;
    }

    public function actionCheckProof(){
        $order_id = Yii::$app->request->get('id');
        $proof = (new Query())->from('proof')->where(['order_id'=>$order_id])->one();
        return $this->render('upload',['proof'=>$proof]);
    }


}
