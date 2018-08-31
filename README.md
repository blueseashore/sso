# sso
# 单点登录登出
    一个站点登录，全部站点在下一个请求后也登录
    一个站点登出，全部站点在下一个请求后也登出    
# 环境说明
    macbook下
    php 7.1.7
    apache 2.4.27
# 流程
    1、开始搭建基础服务
        1.1、新增三个vhost
            testsso.com、testsso1.com、testsso2.com
            testsso.com 为认证中心
            <VirtualHost *:80>
              DocumentRoot "/Users/kendo/Desktop/program/personal/sso"
              ServerName testsso.com
              DirectoryIndex index.html index.php
              <Directory "/Users/kendo/Desktop/program/personal/sso">
                Options -Indexes +FollowSymlinks
                AllowOverride All
                Require all granted
              </Directory>
            </VirtualHost>
            
            <VirtualHost *:80>
              DocumentRoot "/Users/kendo/Desktop/program/personal/sso"
              ServerName testsso1.com
              DirectoryIndex index.html index.php
              <Directory "/Users/kendo/Desktop/program/personal/sso">
                Options -Indexes +FollowSymlinks
                AllowOverride All
                Require all granted
              </Directory>
            </VirtualHost>
            
            <VirtualHost *:80>
              DocumentRoot "/Users/kendo/Desktop/program/personal/sso"
              ServerName testsso2.com
              DirectoryIndex index.html index.php
              <Directory "/Users/kendo/Desktop/program/personal/sso">
                Options -Indexes +FollowSymlinks
                AllowOverride All
                Require all granted
              </Directory>
            </VirtualHost>
        1.2、配置hosts,/etc/hosts文件末尾追加
            127.0.0.1  testsso.com
            127.0.0.1  testsso1.com
            127.0.0.1  testsso2.com
        1.3、重启apache,apachectl restart
           
    2、打开站点[testsso1.com]，在数据渲染之前，向认证中心[testsso.com]请求认证，查看是否登录
        2.1、若尚未登录，则在认证中心[testsso.com]处进行登录，登录成功跳转回 [testsso1.com],并带上用户基础信息
        2.2、若已经登录，跳转回 [testsso1.com],并带上用户基础信息
        
    3、登出时，请求认证中心登出接口[testsso.com/logout.php]，清除当前会话的登录信息，则相关站点[[testsso1.com]/[testsso2.com]]在请求认证时，会发现用户已经登出