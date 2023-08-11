<?php

declare(strict_types=1);

namespace AgelxNash\Cmsdetect\Signature\Ruby;

use AgelxNash\Cmsdetect\Dto\Site;
use AgelxNash\Cmsdetect\SignatureInterface;
use Symfony\Component\DomCrawler\Crawler;

class Discourse  implements SignatureInterface
{
    public function detect(Site $site): float
    {
        $i = 0;

        foreach ($site->headers as $header) {
            if ($header->name === 'x-discourse-username') {
                $i++;
                continue;
            }
            if ($header->name === 'x-discourse-route') {
                $i++;
                continue;
            }
            if ($header->name === 'x-discourse-trackview') {
                $i++;
                continue;
            }
        }

        $str = '<p>Powered by <a href="https://www.discourse.org">Discourse</a>, best viewed with JavaScript enabled</p>';
        if (\mb_strpos($site->content, $str) !== false) {
            $i++;
        }
        if (\mb_strpos($site->content, 'Discourse.Environment = \'') !== false) {
            $i++;
        }

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
                    if (0 === \mb_strpos($content, 'Discourse ')) {
                        $i += 0.5;
                    }
                    break;
            }
        }

        return $i;
    }
}
