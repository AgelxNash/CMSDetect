<?php

declare(strict_types=1);

namespace AgelxNash\Cmsdetect\Signature\Php;

use AgelxNash\Cmsdetect\Dto\Site;
use AgelxNash\Cmsdetect\SignatureInterface;
use Symfony\Component\DomCrawler\Crawler;

class Subrion  implements SignatureInterface
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
                    if (\mb_substr($content, 0, 12) == 'Subrion CMS ') {
                        $i += 0.5;
                    }
                    break;
            }
        }

        foreach ($site->cookies as $cookie) {
            if (preg_match('/(INTELLI\_.{10})/i', $cookie->name)) {
                $i++;
                continue;
            }
        }

        foreach ($site->headers as $header) {
            if ($header->name == 'x-powered-cms' && $header->value === 'Subrion CMS') {
                $i++;
                continue;
            }
        }

        if (\mb_strpos($site->content,
                'Powered by <a href="http://www.subrion.org" title="Open Source CMS">Subrion CMS</a>') !== false) {
            $i += 0.35;
        }

        return $i;
    }
}
