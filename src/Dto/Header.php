<?php

declare(strict_types=1);

namespace AgelxNash\Cmsdetect\Dto;

class Header
{
    public function __construct(public string $name, public string $value)
    {

    }
}