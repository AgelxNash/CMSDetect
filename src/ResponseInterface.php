<?php

declare(strict_types=1);

namespace AgelxNash\Cmsdetect;

use AgelxNash\Cmsdetect\Dto\Cookie;
use AgelxNash\Cmsdetect\Dto\Header;

interface ResponseInterface
{
    /**
     * @return Header[]
     */
    public function headers(): array;

    /**
     * @return Cookie[]
     */
    public function cookies(): array;

    public function originalHost(): string;

    public function resultHost(): string;

    public function content(): string;

    public function code(): int;
}