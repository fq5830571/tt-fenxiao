<?php
namespace common\components;



use yii\web\UrlRuleInterface;
use yii;

class urlManager extends yii\web\urlManager implements UrlRuleInterface
{

    public function createUrl($manager, $route, $params)
    {
        /*if ($route === 'car/index') {
            if (isset($params['manufacturer'], $params['model'])) {
                return $params['manufacturer'] . '/' . $params['model'];
            } elseif (isset($params['manufacturer'])) {
                return $params['manufacturer'];
            }
        }*/
        return false;  // this rule does not apply
    }

    public function parseRequest($manager, $request)
    {
        $this->enablePrettyUrl = true;
        $route = trim($request->get($this->routeParam));
        $enablePrettyUrl = $this->enablePrettyUrl;
        if( $route != '' ) $this->enablePrettyUrl = false;
        $result = parent::parseRequest($request);
        if( $route != '' ) $this->enablePrettyUrl = $enablePrettyUrl;
        return $result;
    }
}