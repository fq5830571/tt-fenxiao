<?php

namespace frontend\controllers;

use common\models\BonusRecord;
use common\models\Order;
use common\models\Proof;
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

    public function init()
    {
        parent::init(); // TODO: Change the autogenerated stub
        Yii::$app->view->params['user_id'] = Yii::$app->session->get('user_id');
    }

    public function actionInfo()
    {
        $id = Yii::$app->view->params['user_id'];
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
        $id = Yii::$app->view->params['user_id'];
        $link = "http://".$_SERVER['HTTP_HOST'] . '/index.php?r=member/register&p_id=' . $id;
        return $this->render('qrcode', ['link' => $link]);
    }

    public function actionRegister()
    {
        $pid = isset($_GET['p_id'])?$_GET['p_id']:0;
        if (Yii::$app->request->isPost){
            try {
                $code = isset($_GET['code'])?$_GET['code']:0;
                $username = Yii::$app->request->post('username');
                $password = Yii::$app->request->post('password');
                $phone = Yii::$app->request->post('phone');
                $pid = Yii::$app->request->post('p_id');
                if (empty($username) || empty($password) || empty($phone)) {
                    throw new \Exception("请填写完整");
                }
                if(empty($pid) && $code!='AUTH'){
                    throw new \Exception("请通过合法地址进行注册");
                }
                $user = (new Query())->from('user')->where(['username'=>$username])->one();
                if($user){
                    throw new \Exception("该用户名已经被注册");
                }
                $shequ_name = '';
                if($pid){
                    $puser = (new Query())->from('user')->where(['id'=>$pid])->one();
                    $shequ_name = $puser['shequ_name'];
                }
                $user = new User();
                $userData = [
                    'username'=>$username,
                     'password'=>md5($password),
                     'phone'=>$phone,
                     'created_time'=>time(),
                     'p_id'=>intval($pid),
                     'shequ_name'=>$shequ_name,
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

            $puser = (new Query())->from('user')->where(['id'=>$pid])->one();
            return $this->render('register',['puser'=>$puser]);
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

    public function actionEditMember(){
        $id = Yii::$app->view->params['user_id'];
        $user = (new Query())->from('user')->where(['id'=>$id])->one();
        $model = new User();
        if (Yii::$app->request->isPost){
            try {
                $nickname = Yii::$app->request->post('nickname');
                $card = Yii::$app->request->post('card');
                $shequ_name = Yii::$app->request->post('shequ_name');
                if (empty($nickname)) {
                    throw new \Exception("请输入修改的昵称");
                }
                $userModel = User::findOne($id);
                $userModel->load( Yii::$app->request->post());
                $rootPath = "/uploads/";

                $file = yii\web\UploadedFile::getInstance($userModel,'image');
                if($file){
                    //调用模型中的属性  返回上传文件的名称
                    $name = $file->name;
                    //定义上传文件的二级目录
                    $path = date('Y-m-d',time());
                    //拼装上传文件的路径
                    $rootPath = $rootPath . $path . "/".time()."/";
                    if (!file_exists($rootPath)) {
                        mkdir($_SERVER['DOCUMENT_ROOT'].$rootPath,true,true);
                        chmod($_SERVER['DOCUMENT_ROOT'].$rootPath,0777);
                    }
                    //调用模型类中的方法 保存图片到该路径
                    $file->saveAs($_SERVER['DOCUMENT_ROOT'].$rootPath . $name);
                    //为模型中的logo属性赋值
                    $userModel->image = $rootPath . $name;
                }


                $userModel->name = $nickname;
                $userModel->card = $card;
                $userModel->shequ_name = $shequ_name;
                $result = $userModel->save();
                if(empty($result)){
                    throw new \Exception("修改失败");
                }
                $this->redirect('/index.php?r=site/index');
                //登录
            } catch (\Exception $e) {
                return $this->render('edit_member',['user'=>$user,'msg'=>$e->getMessage(),'model'=>$model]);
            }
        }else{
            return $this->render('edit_member',['user'=>$user,'model'=>$model]);
        }

    }

    public function actionOrder(){
        $id = Yii::$app->view->params['user_id'];
        $orderList = (new Query())->from('order')->where(['user_id'=>$id])->all();
        return $this->render('order',['orderList'=>$orderList]);
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

    public function actionUpload(){
        if(Yii::$app->request->isPost){
            try {
                $image = Yii::$app->request->post('image');
                $content = Yii::$app->request->post('content');
                $orderId = Yii::$app->request->post('order_id');
                if (empty($image)) {
                    throw new \Exception("请上传凭证");
                }
                $result = (new Query())->from('proof')->where(['order_id'=>$orderId])->one();
                if($result){
                    throw new \Exception("您已经上传过凭证");
                }
                $proof = new Proof();
                $proof->setAttributes(['image'=>$image,'content'=>$content,'order_id'=>$orderId],false);
                $proof->save();
                $this->asJson(['status'=>1,'msg'=>'上传成功']);
                //登录
            } catch (\Exception $e) {
                $this->asJson(['status'=>0,'msg'=>$e->getMessage()]);
            }
        }else{
            $order_id = Yii::$app->request->get('id');
            return $this->render('upload',['order_id'=>$order_id]);
        }

    }






}
