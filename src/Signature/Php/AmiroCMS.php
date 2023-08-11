<?php

declare(strict_types=1);

namespace AgelxNash\Cmsdetect\Signature\Php;

use AgelxNash\Cmsdetect\Dto\Site;
use AgelxNash\Cmsdetect\SignatureInterface;

/**
 * Class AmiroCMS
 * @see https://www.amiro.ru/
 */
class AmiroCMS  implements SignatureInterface
{
    public function detect(Site $site): float
    {
        $i = 0;

        foreach ($site->cookies as $cookie) {
            if (in_array($cookie->name, array('uh_curr_mod', 'uh_prev_mod', 'uh_prev_url', 'uh_cur_url'))) {
                $i++;
                continue;
            }
        }

        return $i;
    }
}
