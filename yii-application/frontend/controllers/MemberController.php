<?php

namespace frontend\controllers;

use common\models\BonusRecord;
use common\models\Order;
use common\models\User;
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
        $link = $_SERVER['HTTP_HOST'] . '/index.php?r=member/register&pid=' . $id;
        return $this->render('qrcode', ['link' => $link]);
    }

    public function actionRegister()
    {
        if (Yii::$app->request->isPost){
            try {
                $username = Yii::$app->request->post('username');
                $password = Yii::$app->request->post('password');
                $phone = Yii::$app->request->post('phone');
                $pid = isset($_GET['p_id'])?$_GET['p_id']:0;
                if (empty($username) || empty($password) || empty($phone)) {
                    throw new \Exception("请填写完整");
                }
                $user = (new Query())->from('user')->where(['username'=>$username])->one();
                if($user){
                    throw new \Exception("该用户名已经被注册");
                }
                $user = new User();
                $userData = [
                    'username'=>$username,
                     'password'=>md5($password),
                     'phone'=>$phone,
                     'created_time'=>time(),
                     'p_id'=>intval($pid)
                ];
                $user->setAttributes($userData,false);
                $result = $user->save();
                if(empty($result)){
                    throw new \Exception("注册失败");
                }
                Yii::$app->session->set('user_id',$user['id']);
                $this->redirect('/index.php?r=site/index');
                //登录
            } catch (\Exception $e) {
                return $this->render('register',['msg'=>$e->getMessage()]);
            }

        }else{
            return $this->render('register');
        }
    }

    public function actionLogout(){
        Yii::$app->session->remove('user_id');
        return $this->render('login');
    }

    public function actionLogin(){
        if (Yii::$app->request->isPost){
            try {
                $username = Yii::$app->request->post('username');
                $password = Yii::$app->request->post('password');
                if (empty($username)) {
                    throw new \Exception("请输入用户名");
                }
                if (empty($password)) {
                    throw new \Exception("请输入密码                                                                                                     ");

                }
                $user = (new Query())->from('user')->where(['username'=>$username,'password'=>md5($password)])->one();
                if(empty($user)){
                    throw new \Exception("用户名或者密码错误");
                }
                Yii::$app->session->set('user_id',$user['id']);
                $this->redirect('/index.php?r=site/index');
                //登录
            } catch (\Exception $e) {
                return $this->render('login',['msg'=>$e->getMessage()]);
            }
        }else{
            return $this->render('login');
        }


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
