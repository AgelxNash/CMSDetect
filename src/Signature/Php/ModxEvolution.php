<?php

declare(strict_types=1);

namespace AgelxNash\Cmsdetect\Signature\Php;

use AgelxNash\Cmsdetect\Dto\Site;
use AgelxNash\Cmsdetect\SignatureInterface;

class ModxEvolution implements SignatureInterface
{
    public function detect(Site $site): float
    {
        $i = 0;

        foreach ($site->cookies as $cookie) {
            if ($cookie->name === 'yams_lang') {
                $i++;
                continue;
            }
            if ($cookie->name === 'tsvshop') {
                $i++;
                continue;
            }
            if ($cookie->name === 'MODxLoggingCookie') {
                $i++;
                continue;
            }
        }
        foreach ($site->cookies as $cookie) {
            if (!$this->checkCookie($cookie)) {
                continue;
            }

            foreach ($site->headers as $header) {
                if ($header->name === 'p3p') {
                    if ($header->value === 'CP="NOI NID ADMa OUR IND UNI COM NAV"') {
                        $i++;
                    }
                    continue 2;
                }
            }
            if (\mb_strpos($site->content, 'assets/') !== false) {
                $i++;
            }
        }

        return $i;
    }

    protected function checkCookie($cookie)
    {
        return (
            (\mb_strlen($cookie->name) === 15 && 0 === \mb_strpos($cookie->name, 'SN')) ||
            (\mb_strlen($cookie->name) >= 9 && 0 === \mb_strpos($cookie->name, 'evo'))
        );
    }
}
