<?php

declare(strict_types=1);

namespace AgelxNash\Cmsdetect\Signature\Php;

use AgelxNash\Cmsdetect\Dto\Site;
use AgelxNash\Cmsdetect\SignatureInterface;

class Laravel implements SignatureInterface
{
    private array $cookieNames = [
        'laravel', //laravel 4
        'laravel_session' //laravel 5
    ];

    public function detect(Site $site): float
    {
        $i = 0;

        foreach ($site->cookies as $cookie) {
            if (\in_array($cookie->name, $this->cookieNames, true)) {
                $i++;
                break;
            }
            /**
             * В Laravel 5.6 куку можно переименовывать. Но почему-то префиксы везде одинаковые
             */
            if ($cookie->name === 'XSRF-TOKEN' && str_starts_with($cookie->value, "eyJpdiI6I") !== false) {
                foreach ($site->cookies as $cookie2) {
                    if (str_ends_with($cookie2->name, '_session')
                        && str_starts_with($cookie2->value, "eyJpdiI6I") !== false
                    ) {
                        $i++;
                        break 2;
                    }
                }
            }
        }

        return $i;
    }
}
