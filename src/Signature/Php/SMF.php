<?php

declare(strict_types=1);

namespace AgelxNash\Cmsdetect\Signature\Php;

use AgelxNash\Cmsdetect\Dto\Site;
use AgelxNash\Cmsdetect\SignatureInterface;

/**
 * @see http://www.simplemachines.org/
 */
class SMF  implements SignatureInterface
{
    public function detect(Site $site): float
    {
        $i = 0;

        if (\mb_strpos($site->content, 'document.getElementById("upshrink").src = smf_images_url + ') !== false) {
            $i += 0.35;
        }
        if (\mb_strpos($site->content,
                '<a href="http://www.simplemachines.org/about/copyright.php" title="Free Forum Software" target="_blank"') !== false) {
            $i += 0.35;
        }
        if (\mb_strpos($site->content, ' target="_blank" class="new_win">SMF ') !== false) {
            $i += 0.35;
        }
        if (\mb_strpos($site->content,
                '<a href="http://www.simplemachines.org/" title="Simple Machines Forum" target="_blank">Powered by SMF ') !== false) {
            $i += 0.35;
        }

        return $i;
    }
}
