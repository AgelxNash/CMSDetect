<?php

declare(strict_types=1);

namespace AgelxNash\Cmsdetect\Signature\Php;

use AgelxNash\Cmsdetect\Dto\Site;
use AgelxNash\Cmsdetect\SignatureInterface;

class BoonexDolphin  implements SignatureInterface
{
    public function detect(Site $site): float
    {
        $i = 0;
        if (\mb_strpos($site->content, 'var aDolImages = {') !== false) {
            $i++;
        }
        if (\mb_strpos($site->content, 'var aDolLang = {') !== false) {
            $i++;
        }
        if (\mb_strpos($site->content, 'var aDolOptions = {') !== false) {
            $i++;
        }

        return $i;
    }
}
