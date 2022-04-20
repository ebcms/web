<?php

declare(strict_types=1);

namespace App\Ebcms\Web;

use App\Ebcms\Web\Middleware\Page;
use Ebcms\Framework\AppInterface;
use Ebcms\Framework\Framework;

class App implements AppInterface
{

    public static function onExecute()
    {
        Framework::bindMiddleware(Page::class);
    }
}
