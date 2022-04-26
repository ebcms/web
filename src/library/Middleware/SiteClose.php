<?php

declare(strict_types=1);

namespace App\Ebcms\Web\Middleware;

use DiggPHP\Psr17\Factory;
use DiggPHP\Framework\Config;
use DiggPHP\Framework\Framework;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;

class SiteClose implements MiddlewareInterface
{
    public function process(
        ServerRequestInterface $request,
        RequestHandlerInterface $handler
    ): ResponseInterface {
        return Framework::execute(function (
            Config $config,
            Factory $factory
        ) use ($request, $handler): ResponseInterface {
            if ($config->get('site.is_close@ebcms.web')) {
                return $factory->createResponse(200)->withBody($factory->createStream($config->get('site.close_reason@ebcms.web', '维护中...')));
            }
            return $handler->handle($request);
        });
    }
}
