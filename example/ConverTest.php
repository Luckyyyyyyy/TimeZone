<?php


require_once '../vendor/autoload.php'; // 加载自动加载文件

use  Linjincan\Convert;

$rose = new Convert();

echo $rose->desc(1594719359);
//var_dump($rose->getZone());