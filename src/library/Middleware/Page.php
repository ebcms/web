<?php

declare(strict_types=1);

namespace App\Ebcms\Web\Middleware;

use DiggPHP\Psr17\Factory;
use DiggPHP\Template\Template;
use DiggPHP\Framework\Framework;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;

class Page implements MiddlewareInterface
{
    public function process(
        ServerRequestInterface $request,
        RequestHandlerInterface $handler
    ): ResponseInterface {
        return Framework::execute(function (
            Template $template,
            Factory $factory
        ) use ($request, $handler): ResponseInterface {
            if (isset($_SERVER['PATH_INFO']) && $_SERVER['PATH_INFO']) {
                $path = ltrim($_SERVER['PATH_INFO'], '/');
                if (preg_match('/^\w+$/', $path)) {
                    $tpl = $path . '@ebcms/web';
                    if ($template->getTplFile($tpl)) {
                        $response = $factory->createResponse();
                        $response->getBody()->write($template->renderFromFile($tpl));
                        return $response;
                    }
                }
            }
            return $handler->handle($request);
        });
    }
}
