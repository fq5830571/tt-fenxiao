<?php
namespace common\components;

class RFTServerAPI{
    private  $agentUser;
    private  $agentKey;
    const AGENT_USER = 'YLJT';
    const AGENT_KEY = '00017674071';
    const   SERVER_API_URL = 'http://api.fango360.cn/api/v1.0';    //请求服务地址

    public function __construct($format = 'json'){
        $this->agentUser = self::AGENT_USER;
        $this->agentKey = self::AGENT_KEY;
    }

    /**
     * 获取大类签名
     * @return string
     */
    public function getCategorySign(){
        return md5("agentUser=$this->agentUser&agentKey=$this->agentKey");
    }

    /**
     * 获取商品签名
     * @return string
     */
    public function getGoodsDetailSign($goodsId){
        return md5("agentUser=$this->agentUser&goodsId=$goodsId&agentKey=$this->agentKey");
    }

    /**
     * @param $cityId
     * @param $districtId
     * @param $mobile
     * @param $provinceId
     * @param $timestamp
     * @param $townId
     * @param $tradeNo
     * @return string
     * 获取预订单签名
     */
    public function getSubmitOrderSign($cityId, $districtId, $mobile, $provinceId, $timestamp, $townId, $tradeNo){
        return md5("agentKey=$this->agentKey&agentUser=$this->agentUser&cityId=$cityId&districtId=$districtId&mobile=$mobile&provinceId=$provinceId&timestamp=$timestamp&townId=$townId&tradeNo=$tradeNo");
    }

    public function getConfirmOrderSign($rftNo,$timestamp,$tradeNo ){
        return md5("agentUser=$this->agentUser&rftNo=$rftNo&timestamp=$timestamp&tradeNo=$tradeNo&agentKey=$this->agentKey");
    }

    public function getAddressSign($provinceId){
        return md5("agentUser=$this->agentUser&provinceId=$provinceId&agentKey=$this->agentKey");
    }

    /**
     * 获取商品池签名
     * @return string
     */
    public function getGoodsPoolOmniSign($condition){
        $num = "";
        if(empty($condition)){
            return ;
        }
        foreach ($condition as $value){
            $num.= $value;
        }
        return md5("agentUser=$this->agentUser&condition=$num&agentKey=$this->agentKey");
    }

    /**
     * 获取大类
     * @return mixed
     */
    public function getCategory() {
        try{
            $sign = $this->getCategorySign();
            $ret = $this->curl('/goods/category',["sign"=>$sign, "agentUser"=>$this->agentUser]);
            if(empty($ret))
                throw new Exception('请求失败');
            return $ret;
        }catch (Exception $e) {
            print_r($e->getMessage());
        }
    }

    /**
     * 获取商品池
     * @return mixed
     */
    public function getGoodsPoolOmni($condition) {
        try{
            $sign = $this->getGoodsPoolOmniSign($condition);
            $ret = $this->curl('/goods/goods_poolOmni',[ "agentUser"=>$this->agentUser,"sign"=>$sign,"condition"=>$this->array2object($condition)]);
            if(empty($ret))
                throw new Exception('请求失败');
            return $ret;
        }catch (Exception $e) {
            print_r($e->getMessage());
        }
    }
    function array2object($array) {

        if (is_array($array)) {
            $obj = new \stdClass();

            foreach ($array as $key => $val){
                $obj->$key = $val;
            }
        }
        else { $obj = $array; }

        return $obj;
    }

    /**
     * 获取商品详情
     * @return mixed
     */
    public function getGoodsDetail($goodsId) {
        try{
            $sign = $this->getGoodsDetailSign($goodsId);
            $ret = $this->curl('/goods/goods_detail',["sign"=>$sign, "agentUser"=>$this->agentUser,"goodsId"=>$goodsId]);
            if(empty($ret))
                throw new Exception('请求失败');
            return $ret;
        }catch (Exception $e) {
            print_r($e->getMessage());
        }
    }

    public function getAddress($provinceId){
        try{
            $sign = $this->getAddressSign($provinceId);
            $ret = $this->curl('/address/getAddress',["sign"=>$sign, "agentUser"=>$this->agentUser,"provinceId"=>$provinceId]);
            if(empty($ret))
                throw new Exception('请求失败');
            return $ret;
        }catch (Exception $e) {
            print_r($e->getMessage());
        }
    }

    public function getSubmitOrder(){
        try{
            $cityId = 27076;
            $districtId = 27077;
            $mobile = 18358585858;
            $provinceId = 27062;
            $timestamp = time();
            $townId = 45496;
            $tradeNo = $this->agentUser.'7105371523418165';
            $sign = $this->getSubmitOrderSign($cityId, $districtId, $mobile, $provinceId, $timestamp, $townId, $tradeNo);
            $ret = $this->curl('/order/submitOrder',
                [   "sign"=>$sign,
                    "agentUser"=>$this->agentUser,
                    "tradeNo"=>$tradeNo,
                    "sku"=>[["goodsId"=>1442210,"goodsNum"=>1,"tradePrice"=>169]],
                    "name"=>"小七",
                    "provinceId"=>$provinceId,
                    "cityId"=>$cityId,
                    "districtId"=>$districtId,
                    "townId"=>$townId,
                    "address"=>"南苑312",
                    "phone"=>"0556-5830571",
                    "mobile"=>$mobile,
                    "email"=>"871007617@qq.com",
                    "timestamp"=>$timestamp,
                ]
            );
            if(empty($ret))
                throw new Exception('请求失败');
            return $ret;
        }catch (Exception $e) {
            print_r($e->getMessage());
        }
    }

    public function getConfirmOrder($rftNo,$timestamp,$tradeNo ){
        try{
            $timestamp = time();
            $rftNo = 172;
            $tradeNo = "YLJT7105371523418165";
            $sign = $this->getConfirmOrderSign($rftNo,$timestamp,$tradeNo);
            $ret = $this->curl('/order/confirmOrder',
                [
                    "sign"=>$sign,
                    "agentUser"=>$this->agentUser,
                    "rftNo"=>$rftNo,
                    "tradeNo"=>$tradeNo,
                    "timestamp"=>$timestamp,
                ]
            );
            if(empty($ret))
                throw new Exception('请求失败');
            return $ret;
        }catch (Exception $e) {
            print_r($e->getMessage());
        }
    }


    
    /**
     * 创建http header参数
     * @param array $data
     * @return bool
     */
    private function createHttpHeader() {
        $nonce = mt_rand();
        $timeStamp = time();
        $sign = sha1($this->appSecret.$nonce.$timeStamp);
        return array(
            'RC-App-Key:'.$this->appKey,
            'RC-Nonce:'.$nonce,
            'RC-Timestamp:'.$timeStamp,
            'RC-Signature:'.$sign,
        );
    }

    /**
     * 重写实现 http_build_query 提交实现(同名key)key=val1&key=val2
     * @param array $formData 数据数组
     * @param string $numericPrefix 数字索引时附加的Key前缀
     * @param string $argSeparator 参数分隔符(默认为&)
     * @param string $prefixKey Key 数组参数，实现同名方式调用接口
     * @return string
     */
    private function build_query($formData, $numericPrefix = '', $argSeparator = '&', $prefixKey = '') {
        $str = '';
        foreach ($formData as $key => $val) {
            if (!is_array($val)) {
                $str .= $argSeparator;
                if ($prefixKey === '') {
                    if (is_int($key)) {
                        $str .= $numericPrefix;
                    }
                    $str .= urlencode($key) . '=' . urlencode($val);
                } else {
                    $str .= urlencode($prefixKey) . '=' . urlencode($val);
                }
            } else {
                if ($prefixKey == '') {
                    $prefixKey .= $key;
                }
                if (is_array($val[0])) {
                    $arr = array();
                    $arr[$key] = $val[0];
                    $str .= $argSeparator . http_build_query($arr);
                } else {
                    $str .= $argSeparator . $this->build_query($val, $numericPrefix, $argSeparator, $prefixKey);
                }
                $prefixKey = '';
            }
        }
        return substr($str, strlen($argSeparator));
    }

    /**
     * 发起 server 请求
     * @param $action
     * @param $params
     * @param $httpHeader
     * @return mixed
     */
    public function curl($action, $params, $contentType='urlencoded') {
        $action = self::SERVER_API_URL.$action;

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $action);
        curl_setopt($ch, CURLOPT_POST, 1);

        /*if ($contentType=='json') {
            $httpHeader[] = 'Content-Type:Application/json';
            curl_setopt($ch, CURLOPT_POSTFIELDS, $params );
        }*/
        if ($contentType=='urlencoded') {
           // $httpHeader[] = 'Content-Type:application/x-www-form-urlencoded';

        }
        $header = array("Content-type: application/json");// 注意header头，格式k:v

        curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($params));
        curl_setopt($ch, CURLOPT_ENCODING, 'gzip,deflate');
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER,false); //处理http证书问题
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_TIMEOUT, 30);
        curl_setopt($ch, CURLOPT_DNS_USE_GLOBAL_CACHE, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $ret = curl_exec($ch);
        if (false === $ret) {
            $ret =  curl_errno($ch);
        }
        curl_close($ch);

        return $ret;
    }
}
