<?php

declare(strict_types=1);

namespace AgelxNash\Cmsdetect\Signature\Php;

use AgelxNash\Cmsdetect\Dto\Site;
use AgelxNash\Cmsdetect\SignatureInterface;

class Yii  implements SignatureInterface
{
    public function detect(Site $site): float
    {
        $i = 0;
        foreach ($site->cookies as $cookie) {
            if ($cookie->name === 'yiisession') {
                $i++;
                continue;
            }
            if ($cookie->name === 'YII_CSRF_TOKEN') {
                $i++;
                continue;
            }
        }

        return $i;
    }
}
