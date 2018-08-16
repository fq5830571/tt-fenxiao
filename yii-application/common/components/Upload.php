<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/11/7
 * Time: 13:44
 */

namespace common\components;

use yii;
use yii\base\Object;
use yii\web\UploadedFile;

class Upload extends Object
{
    /**
     * [UploadPhoto description]
     * @param [type]  $model      [实例化模型]
     * @param [type]  $path       [图片存储路径]
     * @param [type]  $originName [图片源名称]
     * @param boolean $isthumb    [是否要缩略图]
     */
    public function UploadPhoto(){
        $target="http://106.14.5.115:8080/uploadSourceVideo.php";

# http://php.net/manual/en/curlfile.construct.php
        $files = UploadedFile::getInstanceByName('files');
// Create a CURLFile object / procedural method
        $cfile = curl_file_create($files->tempName,$files->type,$files->name); // try adding

// Create a CURLFile object / oop method
#$cfile = new CURLFile('resource/test.png','image/png','testpic'); // uncomment and use if the upper procedural method is not working.

// Assign POST data
        $imgdata = array('video' => $cfile);
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $target);
        curl_setopt($curl, CURLOPT_USERAGENT,'Opera/9.80 (Windows NT 6.2; Win64; x64) Presto/2.12.388 Version/12.15');
        curl_setopt($curl, CURLOPT_HTTPHEADER,array('User-Agent: Opera/9.80 (Windows NT 6.2; Win64; x64) Presto/2.12.388 Version/12.15','Referer: http://someaddress.tld','Content-Type: multipart/form-data'));
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false); // stop verifying certificate
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_POST, true); // enable posting
        curl_setopt($curl, CURLOPT_POSTFIELDS, $imgdata); // post images
        curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true); // if any redirection after upload
        $r = curl_exec($curl);
        curl_close($curl);
        return   $r;

        $root = 'http://106.14.5.115:8080/'.'/'.$path;
        //返回一个实例化对象
        $files = UploadedFile::getInstance($model,$originName);
        $folder = date('Ymd')."/";
        $pre = rand(999,9999).time();
        if($files && ($files->type == "image/jpeg" || $files->type == "image/pjpeg" || $files->type == "image/png" || $files->type == "image/x-png" || $files->type == "image/gif"))
        {
            $newName = $pre.'.'.$files->getExtension();
        }else{
            die($files->type);
        }
        if($files->size > 2000000){
            die("上传的文件太大");
        }
        echo $root.$folder;
        if(!is_dir($root.$folder))
        {
            if(!mkdir($root.$folder, 0777, true)){
                die('创建目录失败...');
            }else{
                //	chmod($root.$folder,0777);
            }
        }
        //echo $root.$folder.$newName;exit;
        if($files->saveAs($root.$folder.$newName))
        {
            if($isthumb){
                $this->thumbphoto($files,$path.$folder.$newName,$path.$folder.'thumb'.$newName);
                return $path.$folder.$newName.'#'.$path.$folder.'thumb'.$newName;
            }else{
                return $path.$folder.$newName;
            }

        }
    }
}