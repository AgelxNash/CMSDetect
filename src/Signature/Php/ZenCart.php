<?php

declare(strict_types=1);

namespace AgelxNash\Cmsdetect\Signature\Php;

use AgelxNash\Cmsdetect\Dto\Site;
use AgelxNash\Cmsdetect\SignatureInterface;
use Symfony\Component\DomCrawler\Crawler;

class ZenCart  implements SignatureInterface
{
    public function detect(Site $site): float
    {
        $i = 0;
        foreach ($site->cookies as $cookie) {
            if ($cookie->name === 'zenid') {
                $i++;
                break;
            }
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
                    if (0 === \mb_strpos($content, 'shopping cart program by Zen Cart')) {
                        $i += 0.5;
                    }
                    break;
                case 'authors':
                    $content = $row->getAttribute('content');
                    if (0 === \mb_strpos($content, 'The Zen Cart')) {
                        $i += 0.5;
                    }
                    break;
            }
        }

        if (\mb_strpos($site->content, 'index.php?main_page=advanced_search_result') !== false) {
            $i++;
        }

        $str = 'Powered by <a href="http://www.zen-cart.com" target="_blank">Zen Cart</a>';
        if (\mb_strpos($site->content, $str) !== false) {
            $i++;
        }

        if (\mb_strpos($site->content, 'Powered by Zen Cart!, The Art of E-commerce</title>') !== false) {
            $i++;
        }

        return $i;
    }
}
