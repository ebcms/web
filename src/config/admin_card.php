<?php

use DiggPHP\Framework\Config;
use DiggPHP\Router\Router;
use DiggPHP\Framework\Framework;

return Framework::execute(function (
    Router $router,
    Config $config
): array {
    $res = [];

    if (!file_exists(Framework::getRoot() . '/config/ebcms/web/site.php')) {
        $res[] = [
            'title' => '站点设置',
            'body' => '请<a href="' . $router->build('/ebcms/web/set') . '" class="mx-1 fw-bold">设置</a>站点信息',
            'tags' => ['remind']
        ];
    }
    if ($config->get('site.is_close@ebcms.web')) {
        $res[] = [
            'title' => '站点已关闭',
            'body' => '站点已经关闭，去<a href="' . $router->build('/ebcms/web/set') . '" class="mx-1 fw-bold">开启</a>',
            'tags' => ['remind']
        ];
    }
    return $res;
});
