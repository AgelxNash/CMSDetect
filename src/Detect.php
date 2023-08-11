<?php

declare(strict_types=1);

namespace AgelxNash\Cmsdetect;

use AgelxNash\Cmsdetect\Dto\Site;
use Exception;

class Detect
{
    public function __construct(private array $signature)
    {
    }

    public function check(Site $site, $signature = null): array
    {
        $detect = [];
        foreach ($this->signature as $name => $worker) {
            if (null !== $signature && $name !== $signature) {
                continue;
            }
            try {
                /**
                 * @var $workObj SignatureInterface
                 */
                $workObj = new $worker();
                if ($count = $workObj->detect($site)) {
                    $detect[$name] = $count;
                }
            } catch (Exception ) {}
        }

        arsort($detect);
        return $detect;
    }
}
