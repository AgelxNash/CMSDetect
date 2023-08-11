<?php namespace AgelxNash\Cmsdetect;

namespace AgelxNash\Cmsdetect;

use AgelxNash\Cmsdetect\Dto\Site;

interface SignatureInterface
{
    public function detect(Site $site): float;
}
