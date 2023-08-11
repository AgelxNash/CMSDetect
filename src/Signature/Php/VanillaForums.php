<?php

declare(strict_types=1);

namespace AgelxNash\Cmsdetect\Signature\Php;

use AgelxNash\Cmsdetect\Dto\Site;
use AgelxNash\Cmsdetect\SignatureInterface;

/**
 * @see https://vanillaforums.com/
 */
class VanillaForums  implements SignatureInterface
{
    public function detect(Site $site): float
    {
        $i = 0;
        if (strpos($site->content,
                '<link rel="stylesheet" href="/applications/vanilla/design/tag.css?') !== false) {
            $i++;
        }
        if (strpos($site->content,
                '<link rel="stylesheet" href="/applications/vanilla/design/spoilers.css?') !== false) {
            $i++;
        }
        if (strpos($site->content, '<script src="/applications/vanilla/js/spoilers.js?') !== false) {
            $i++;
        }
        if (strpos($site->content, '<script src="/applications/vanilla/js/tagging.js?') !== false) {
            $i++;
        }
        if (strpos($site->content, '<body id="vanilla_discussions_index" class="Vanilla Discussions') !== false) {
            $i++;
        }
        if (strpos($site->content, '<body id="vanilla_categories_home" class="Vanilla Categories') !== false) {
            $i++;
        }

        return $i;
    }
}
