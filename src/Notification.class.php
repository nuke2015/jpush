<?php
namespace nuke2015\jpush;

/**
 * 极光通知调用客户端
 使用前必须定义APP_KEY和MASTER_SECRET
 * @author nuke.zou <nuke.zou@corp.to8to.com>
 * 2014年12月24日 16:09:43
 */

use JPush\Model as M;
use JPush\JPushClient;
use JPush\JPushLog;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;

use JPush\Exception\APIConnectionException;
use JPush\Exception\APIRequestException;

//记录日志;
JPushLog::setLogHandlers(array(new StreamHandler(MONOLOG_LOGFILE,MONOLOG_LEVEL)));

class Notification
{
    
    //极光客户端
    protected $client;
    
    //平台
    protected $setPlatform;
    
    //发送方式
    protected $setAudience;
    
    //内容
    protected $setNotification;
    
    //初始化;
    public function __construct() {
        $this->client = new JPushClient(APP_KEY, MASTER_SECRET);
    }
    
    /**
     * 全平台简易发送
     测试用例:list($status,$data)=$Notification->easy('hello feng!');
     */
    public function easy($title) {
        $this->setPlatform = M\all;
        $this->setAudience = M\all;
        $this->setNotification = M\notification($title);
        return $this->send();
    }
    
    /**
     * 信息发送;
     */
    protected function send() {
        if (!$this->setPlatform || !$this->setAudience || !$this->setNotification) return array(false, array());
        try {
            $result = $this->client->push()->setPlatform($this->setPlatform)->setAudience($this->setAudience)->setNotification($this->setNotification)->send();
            return array(true, $result);
        }
        catch(APIRequestException $e) {
            $info = $this->APIRequestException($e);
            return array(false, $info);
        }
        catch(APIConnectionException $e) {
            $info = $this->APIConnectionException($e);
            return array(false, $info);
        }
    }
    
    /**
     * api调用出错;
     */
    private function APIRequestException($e) {
        $info = array();
        $info['Http Code'] = $e->httpCode;
        $info['code'] = $e->code;
        $info['Error Message'] = $e->message;
        $info['Response JSON'] = $e->json;
        $info['rateLimitLimit'] = $e->rateLimitLimit;
        $info['rateLimitRemaining'] = $e->rateLimitRemaining;
        $info['rateLimitReset'] = $e->rateLimitReset;
        $info['Exception'] = 'APIRequestException';
        return $info;
    }
    
    /**
     * 网络连接错误
     */
    private function APIConnectionException($e) {
        $info = array();
        $info['Error Message'] = $e->getMessage();
        $info['IsResponseTimeout'] = $e->isResponseTimeout;
        $info['Exception'] = 'APIConnectionException';
        return $info;
    }
}
