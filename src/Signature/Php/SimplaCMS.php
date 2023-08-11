<?php

declare(strict_types=1);

namespace AgelxNash\Cmsdetect\Signature\Php;

use AgelxNash\Cmsdetect\Dto\Site;
use AgelxNash\Cmsdetect\SignatureInterface;

/**
 * @see http://simplacms.ru/
 */
class SimplaCMS  implements SignatureInterface
{
    public function detect(Site $site): float
    {
        $i = 0;
        if (\mb_strpos($site->content,
                '<a href="http://simplacms.ru">Скрипт интернет-магазина Simpla</a>') !== false) {
            $i += 0.35;
        }

        return $i;
    }
}
