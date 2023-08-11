<?php

declare(strict_types=1);

namespace AgelxNash\Cmsdetect\Signature\Php;

use AgelxNash\Cmsdetect\Dto\Site;
use AgelxNash\Cmsdetect\SignatureInterface;

class Drupal  implements SignatureInterface
{
    public function detect(Site $site): float
    {
        $i = 0;

        if (\mb_strpos($site->content, 'jQuery.extend(Drupal.settings,') !== false) {
            $i += 0.35;
        }

        $str =  'alt="Powered by Drupal, an open source content management system"';
        if (\mb_strpos($site->content, $str) !== false) {
            $i += 0.35;
        }

        foreach ($site->headers as $header) {
            if (0 === \mb_strpos($header->name, 'x-drupal-')) {
                $i++;
                continue;
            }
            if ($header->name === 'x-generator' && $header->value === 'Drupal 7 (http://drupal.org)') {
                $i++;
                continue;
            }
        }

        foreach ($site->cookies as $cookie) {
            if (0 === \mb_strpos($cookie->name, 'Drupal.')) {
                $i++;
                continue;
            }
        }

        return $i;
    }
}
