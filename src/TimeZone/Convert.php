<?php


namespace Linjincan;

use DateTime;
use DateTimeZone;

class Convert
{

    protected $time_format = '';//返回的时间格式
    protected $local_time_zone = '';//本地时区
    protected $goal_time_zone = '';//转换对象时区


    public function __construct($time_format = 'Y-m-d H:i:s', $local_time_zone = 'Asia/Shanghai', $goal_time_zone = 'Pacific/Chatham')
    {
        $this->time_format = $time_format;
        $this->local_time_zone = $local_time_zone;
        $this->goal_time_zone = $goal_time_zone;

    }


    public function desc($time)
    {
        $date_time = date('Y-m-d H:i:s', $time);
        $date = new DateTime($date_time, new DateTimeZone($this->local_time_zone));
        $date->setTimezone(new DateTimeZone($this->goal_time_zone));
        $rst = $date->format('Y-m-d H:i:s');
        if ($rst) {
            return $date->format('Y-m-d H:i:s');
        } else {
            return false;
        }
    }

    public static function getZone()
    {

        return include __DIR__ . '/../../data/timeZoneList.php';
    }


}