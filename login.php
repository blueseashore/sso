<?php
/**
 * User: kendo    Date: 2018/8/30
 */
if (empty($_GET['redirectUri'])) {
    header("Content-Type:application/json");
    exit(json_encode(['code' => 1, 'msg' => '禁止直接访问']));
}
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

session_start();

if (!empty($_SESSION['ticket'])) {    //已经登录,跳回页面
    header('location:' . $_GET['redirectUri'] . '?userName=' . $_SESSION['userName'] . '&ticket=' . $_SESSION['ticket']);
} else {  //进行登录
    if (!empty($_POST)) {
        $_SESSION['userName'] = $_POST['userName'];
        $_SESSION['ticket'] = md5(session_id());
        header('location:' . $_POST['redirectUri'] . '?userName=' . $_SESSION['userName'] . '&ticket=' . $_SESSION['ticket']);
    } else {
        $redirectUri = $_GET['redirectUri'];
        echo <<<EOT
<form action="#" method="post">
    <input type="hidden" name="redirectUri" value="$redirectUri"/>
    userName:<input type="text" name="userName">
    <button type="submit">提交</button>
</form>
EOT;
    }
}