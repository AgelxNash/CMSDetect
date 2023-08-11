<?php

declare(strict_types=1);

namespace AgelxNash\Cmsdetect\Signature\Php;

use AgelxNash\Cmsdetect\Dto\Site;
use AgelxNash\Cmsdetect\SignatureInterface;

class Bitrix  implements SignatureInterface
{
    public function detect(Site $site): float
    {
        $i = 0;
        foreach ($site->headers as $header) {
            if (0 === \mb_strpos($header->name, 'x-bitrix-')) {
                $i++;
                continue;
            }
            if ($header->name === 'x-powered-cms' && \mb_substr($header->value, 0, 19) === 'Bitrix Site Manager') {
                $i++;
                continue;
            }
            if ($header->name === 'b-powered-by' && \mb_substr($header->value, 0, 9) === 'Bitrix SM') {
                $i++;
                continue;
            }
        }

        foreach ($site->cookies as $cookie) {
            if (0 === \mb_strpos($cookie->name, 'BITRIX_SM_')) {
                $i++;
                continue;
            }
            if (0 === \mb_strpos($cookie->name, 'BX_USER_ID')) {
                $i++;
                continue;
            }
        }

        /**
         * /bitrix/templates/
         * /bitrix/cache/
         */
        return $i;
    }
}
