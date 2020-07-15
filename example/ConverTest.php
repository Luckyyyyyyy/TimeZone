<?php


require_once '../vendor/autoload.php'; // 加载自动加载文件

use  Linjincan\Convert;

$rst = new Convert();



echo  '转换的时间为:';
var_dump($rst->convert(time()));

echo  '支持的时区为:';

var_dump($rst->getZone());
