<?php
/**
 * User: kendo    Date: 2018/8/30
 */
session_start();
if (!empty($_GET['ticket'])) {
    $_SESSION['userName'] = $_GET['userName'];
    $_SESSION['ticket'] = $_GET['ticket'];
} else {
    header('location:http://testsso.com/login.php?redirectUri=http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']);
}
$redirectUri = 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
echo 'SessionId:', session_id(), '<hr/>', $_SESSION['userName'] . '--登录成功，登录时间' . date('Y-m-d H:i:s', time()), PHP_EOL;
echo '<hr/><a href="http://testsso1.com/index.php" target="_blank">test1sso.com</a>';
echo '<hr/><a href="http://testsso.com/logout.php?redirectUri=' . urlencode('http://testsso1.com/index.php') . '">test1sso.com登出</a>';
echo '<hr/><a href="http://testsso2.com/index.php" target="_blank">test2sso.com</a>';
echo '<hr/><a href="http://testsso.com/logout.php?redirectUri=' . urlencode('http://testsso2.com/index.php') . '" >test2sso.com登出</a>';