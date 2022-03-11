<?php

declare(strict_types=1);

namespace App\Ebcms\Web;

use App\Ebcms\Web\Middleware\Page;
use DigPHP\Framework\AppInterface;
use DigPHP\Framework\Framework;

class App implements AppInterface
{

    public static function onExecute()
    {
        Framework::bindMiddleware(Page::class);
    }
}
