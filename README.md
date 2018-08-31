# sso
# 单点登录登出
    一个站点登录，全部站点在下一个请求后也登录
    一个站点登出，全部站点在下一个请求后也登出    
# 流程
    1、打开站点A的页面B，在数据渲染之前，向认证中心请求认证，查看是否登录
        1.1、若尚未登录，则在认证中心处进行登录，登录成功跳转回 [站点A的页面B],并带上用户基础信息
        1.2、若已经登录，跳转回 [站点A的页面B],并带上用户基础信息
    2、登出时，请求认证中心清楚当前会话的登录信息，则相关站点在请求认证时，会发现用户已经登出
# 环境说明
    macbook下
    php 7.1.7
    apache 2.4.27