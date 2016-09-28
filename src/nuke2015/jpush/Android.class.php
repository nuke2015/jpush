<?php
namespace nuke2015\jpush;

/**
 * 极光通知调用客户端
使用前必须定义APP_KEY和MASTER_SECRET
 * @author nuke.zou <nuke.zou@corp.to8to.com>
 * 2014年12月24日 16:09:43
 */

use JPush\JPushLog;
use JPush\Model as M;
use Monolog\Handler\StreamHandler;

//记录日志;
JPushLog::setLogHandlers(array(new StreamHandler(MONOLOG_LOGFILE, MONOLOG_LEVEL)));

/**
 * Android设备通知;
 */
class Android extends Notification
{

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * android全部发送
    $Android= new Jpush\Android();
    list($status,$data)=$Android->sendByAll('hello feng!');
    var_dump($status);
    var_dump($data);
     */
    public function sendByAll($title)
    {
        $this->setPlatform     = M\platform('android');
        $this->setAudience     = M\all;
        $this->setNotification = M\notification($title);
        return $this->send();
    }

    /**
     * android,按id识别发送;
     * @param $title string 消息内容
     * @param $registration_ids array 设备id列表;
     */
    public function sendByIds($title, $registration_ids)
    {
        $this->setPlatform     = M\platform('android');
        $this->setAudience     = M\registration_id($registration_ids);
        $this->setNotification = M\notification($title);
        return $this->send();
    }

    /**
     * android标签发送;
     * @param $title string 消息内容
     * @param $tag array 标签数组
     */
    public function sendByTag($title, $tag)
    {
        $this->setPlatform     = M\platform('android');
        $this->setAudience     = M\tag($tag);
        $this->setNotification = M\notification($title);
        return $this->send();
    }

    /**
     * android别名发送
     * @param $title string 消息内容
     * @param $alias array 别名数组
     */
    public function sendByAlias($title, $alias)
    {
        $this->setPlatform     = M\platform('android');
        $this->setAudience     = M\alias($alias);
        $this->setNotification = M\notification($title);
        return $this->send();
    }
}
