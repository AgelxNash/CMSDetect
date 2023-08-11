<?php

declare(strict_types=1);

namespace AgelxNash\Cmsdetect\Dto;

class Site
{
    /**
     * @param string $domain
     * @param string $content
     * @param Header[] $headers
     * @param array $cookies
     */
    public function __construct(public string $domain, public string $content, public array $headers = [], public array $cookies = [])
    {
    }
}