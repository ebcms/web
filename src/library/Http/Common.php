<?php

declare(strict_types=1);

namespace App\Ebcms\Web\Http;

use App\Ebcms\Admin\Traits\ResponseTrait;
use App\Ebcms\Admin\Traits\RestfulTrait;
use App\Ebcms\Web\Middleware\SiteClose;
use DiggPHP\Framework\Framework;

abstract class Common
{
    use RestfulTrait;
    use ResponseTrait;

    public function __construct()
    {
        Framework::bindMiddleware(SiteClose::class);
    }
}
