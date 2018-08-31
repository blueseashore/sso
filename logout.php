<?php
/**
 * User: kendo    Date: 2018/8/31
 */

if (empty($_GET['redirectUri'])) {
    header("Content-Type:application/json");
    exit(json_encode(['code' => 1, 'msg' => '禁止直接访问']));
}

//授权检测
$allowWeb = [
    'http://testsso1.com',
    'http://testsso2.com',
];
$webInfo = parse_url(urldecode($_GET['redirectUri']));
$baseWeb = ($webInfo['scheme'] ?? '') . '://' . ($webInfo['host'] ?? '');

if (!in_array(strtolower($baseWeb), $allowWeb)) {
    header("Content-Type:application/json");
    exit(json_encode(['code' => 1, 'msg' => '不在授权内']));
}

//登录状态清楚
session_start();
$_SESSION['ticket'] = '';
$_SESSION['userName'] = '';

//返回之前的页面
header('location:' . $_GET['redirectUri']);