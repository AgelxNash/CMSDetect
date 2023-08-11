<?php

declare(strict_types=1);

namespace AgelxNash\Cmsdetect\Signature\Php;

use AgelxNash\Cmsdetect\Dto\Site;
use AgelxNash\Cmsdetect\SignatureInterface;

/**
 * @see https://vamshop.ru/
 */
class VamShop  implements SignatureInterface
{
    public function detect(Site $site): float
    {
        $i = 0;
        if (\mb_strpos($site->content,
                'Работает на основе <a href="http://vamshop.ru" target="_blank">VamShop</a>') !== false) {
            $i += 0.35;
        }
        if (\mb_strpos($site->content,
                '<a href="http://vamshop.ru" target="_blank">Создание интернет магазина</a>') !== false) {
            $i += 0.35;
        }

        return $i;
    }
}
