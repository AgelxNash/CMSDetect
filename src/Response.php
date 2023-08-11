<?php

declare(strict_types=1);

namespace AgelxNash\Cmsdetect;

use AgelxNash\Cmsdetect\Dto\Cookie;
use AgelxNash\Cmsdetect\Dto\Header;

class Response implements ResponseInterface
{
    /**
     * @template T_HOST array{result: string, original: string}
     * @template T_DATA array{code: int, content: string, host: T_HOST, headers: array<string>}
     * @param T_DATA|array $data
     */
    public function __construct(private array $data)
    {
        if (isset($data['error'])) {
            throw new \LogicException($data['error']);
        }

        $this->validate();
    }

    /**
     * {@inheritDoc}
     */
    public function headers(): array
    {
        return array_filter(array_map(static function(array $item) {
            return new Header(key($item), current($item));
        }, $this->data['headers']));
    }

    /**
     * {@inheritDoc}
     */
    public function cookies(): array
    {
        return array_filter(array_map(static function(array $item) {
            return new Cookie(key($item), current($item));
        }, $this->data['cookies']));
    }

    public function originalHost(): string
    {
        return $this->data['host']['original'];
    }

    public function resultHost(): string
    {
        return $this->data['host']['result'] ?? $this->originalHost();
    }

    public function content(): string
    {
        return $this->data['content'];
    }

    public function code(): int
    {
        return $this->data['code'];
    }

    private function validate(): void
    {
        if (!isset($this->data['content'])) {
            throw new \InvalidArgumentException('content');
        }

        if (!is_array($this->data['headers']) || !is_array($this->data['host'])) {
            throw new \InvalidArgumentException('not array');
        }

        if (!isset($this->data['host']['result'], $this->data['host']['original'])) {
            throw new \InvalidArgumentException('host');
        }

        if (!is_int($this->data['code'])) {
            throw new \InvalidArgumentException('code');
        }
    }
}