<?php

declare(strict_types=1);

namespace AgelxNash\Cmsdetect\Signature\Php;

use AgelxNash\Cmsdetect\Dto\Site;
use AgelxNash\Cmsdetect\SignatureInterface;

/**
 * @see https://www.cs-cart.ru/
 */
class CSCart  implements SignatureInterface
{
    public function detect(Site $site): float
    {
        $i = 0;

        foreach ($site->cookies as $cookie) {
            if (\mb_substr($cookie->name, 0, 13) === 'sid_customer_') {
                $i++;
                continue;
            }
        }

        if (str_contains($site->content, '<input type="hidden" name="search_performed" value="Y" />')) {
            $i++;
        }

        return $i;
    }
}
