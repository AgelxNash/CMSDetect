<?php

declare(strict_types=1);

namespace AgelxNash\Cmsdetect\Signature\Php;

use AgelxNash\Cmsdetect\Dto\Site;
use AgelxNash\Cmsdetect\SignatureInterface;

class Dle  implements SignatureInterface
{
    public function detect(Site $site): float
    {
        $i = 0;

        if (str_contains($site->content, "<div id='dle-content'>")) {
            $i++;
        }
        if (str_contains($site->content, "var dle_root")) {
            $i++;
        }

        //header.x-powered-by = 'DataLife Engine'
        foreach ($site->cookies as $cookie) {
            if (\mb_substr($cookie->name, 0, 4) === 'dle_') {
                $i++;
                continue;
            }
        }

        return $i;
    }

}
