<?php

declare(strict_types=1);

namespace AgelxNash\Cmsdetect\Dto;

class Cookie
{
    public function __construct(public string $name, public string $value)
    {

    }
}