<?php

declare(strict_types=1);

namespace App\Ebcms\Web;

use App\Ebcms\Web\Middleware\Page;
use DiggPHP\Framework\AppInterface;
use DiggPHP\Framework\Framework;

class App implements AppInterface
{

    public static function onExecute()
    {
        Framework::bindMiddleware(Page::class);
    }
}
