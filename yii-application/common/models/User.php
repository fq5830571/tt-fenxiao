<?php
namespace common\models;

use Yii;
use yii\base\NotSupportedException;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\db\Query;
use yii\web\IdentityInterface;

/**
 * User model
 *
 * @property integer $id
 * @property string $username
 * @property string $password_hash
 * @property string $password_reset_token
 * @property string $email
 * @property string $auth_key
 * @property integer $status
 * @property integer $created_at
 * @property integer $updated_at
 * @property string $password write-only password
 */
class User extends ActiveRecord
{
    const STATUS_DELETED = 0;
    const STATUS_ACTIVE = 10;


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%user}}';
    }

    public static function getLevel($level){
        $levelList = [
            1=>'一级',
            2=>'二级',
            3=>'三级',
            4=>'四级',
            5=>'五级',
        ];
        return $levelList[$level]?$levelList[$level]:'未知等级';
    }

    public static function getCode(){
        $res = false;
        while ($res == false) {
            $code = substr(base_convert(md5(uniqid(md5(microtime(true)),true)), 16, 10), 0, 6);
            $count = (new Query())->from('user')->where(['code'=>$code])->count();
            if ($count == 0) {
                $res = true;
            }
        }
        return  $code;
    }

}
