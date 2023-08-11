<?php

declare(strict_types=1);

namespace AgelxNash\Cmsdetect\Signature\Php;

use AgelxNash\Cmsdetect\Dto\Site;
use AgelxNash\Cmsdetect\SignatureInterface;

class OpenCart  implements SignatureInterface
{
    public function detect(Site $site): float
    {
        $i = 0;
        if (\mb_strpos($site->content,
                '<div id="powered">Powered By <a href="http://www.opencart.com"') !== false) {
            $i += 0.35;
        }
        foreach ($site->cookies as $cookie) {
            if ($cookie->name === 'currency' && strpos($site->content,
                    '?route=product/') !== false && strpos($site->content, 'catalog/view/theme/') !== false) {
                $i++;
                break;
            }
        }

        return $i;
    }
}
