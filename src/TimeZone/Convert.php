<?php


namespace Linjincan;

use DateTime;
use DateTimeZone;

class Convert
{

    protected $time_format = '';//返回的时间格式


    public function __construct($time_format = 'Y-m-d H:i:s')
    {
        $this->time_format = $time_format;

    }


    public function convert($time, $local_time_zone = 'Asia/Shanghai', $goal_time_zone = 'Pacific/Chatham')
    {
        $result = ['code' => 0, 'msg' => 'error', 'data' => ''];
        if ($this->is_timestamp($time)) {//判断是否时间戳
            $date_time = date('Y-m-d H:i:s', $time);
        } else if ($this->is_date($time)) {
            $date_time = $time;
        } else {
            $result['msg'] = '时间格式有误';
            return $result;
        }

        $time_zone_list = $this->getZone();

        if (!in_array($local_time_zone, $time_zone_list)) {//判断本地时区是否合法
            $result['msg'] = '本地时区非法';
            return $result;
        }
        if (!in_array($goal_time_zone, $time_zone_list)) {//判断目标时区是否合法
            $result['msg'] = '目标时区非法';
            return $result;
        }


        try {//开始转换时区
            $date = new DateTime($date_time, new DateTimeZone($local_time_zone));
            $date->setTimezone(new DateTimeZone($goal_time_zone));
            $result['data'] = $date->format($this->time_format);
            $result['code'] = 1;
            $result['msg'] = $goal_time_zone . ' is ok';

        } catch (\Exception $e) {
            $result['data'] = $e;
        }


        return $result;
    }
    //获取支持的时区
    public  function getZone()
    {

        return include __DIR__ . '/../../data/timeZoneList.php';
    }

    //判断时间是否是时间戳
    protected function is_timestamp($timestamp)
    {
        if (strtotime(date('Y-m-d H:i:s', $timestamp)) === $timestamp) {
            return true;
        } else {
            return false;
        }
    }

    //判断时间是否有效
    protected function is_date($date)
    {
        if (strtotime($date)) {
            return true;
        } else {
            return false;
        }
    }


}