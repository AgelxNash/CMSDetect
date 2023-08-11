<?php

declare(strict_types=1);

namespace AgelxNash\Cmsdetect\Signature\Php;

use AgelxNash\Cmsdetect\Dto\Site;
use AgelxNash\Cmsdetect\SignatureInterface;
use Symfony\Component\DomCrawler\Crawler;

class Zend  implements SignatureInterface
{
    public function detect(Site $site): float
    {
        $i = 0;
        $crawler = new Crawler();
        $crawler->addHtmlContent($site->content);

        $rows = $crawler->filter('head meta');
        /**
         * @var \DOMElement $row
         */
        foreach ($rows as $row) {
            $name = \mb_strtolower($row->getAttribute('name'));
            switch ($name) {
                case 'generator':
                    $content = $row->getAttribute('content');
                    if (0 === \mb_strpos($content, 'Zend.com CMS ')) {
                        $i += 0.5;
                    }
                    break;
            }
        }

        foreach ($site->headers as $header) {
            if ($header->name === 'server' && 0 === \mb_strpos($header->value, 'Zend ')) {
                $i++;
                continue;
            }
            if ($header->name === 'x-powered-by' && 0 === \mb_strpos($header->value, 'Zend Framework')) {
                $i++;
                continue;
            }
            if ($header->name === 'x-powered-by' && 0 === \mb_strpos($header->value, 'Zend Core')) {
                $i++;
                continue;
            }
        }

        return $i;
    }
}
