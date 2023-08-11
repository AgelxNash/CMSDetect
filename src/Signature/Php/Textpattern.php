<?php

declare(strict_types=1);

namespace AgelxNash\Cmsdetect\Signature\Php;

use AgelxNash\Cmsdetect\Dto\Site;
use AgelxNash\Cmsdetect\SignatureInterface;
use Symfony\Component\DomCrawler\Crawler;

/**
 * @see http://textpattern.com/
 */
class Textpattern  implements SignatureInterface
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
                    if ($row->getAttribute('content') === 'Textpattern CMS') {
                        $i += 0.5;
                    }
                    break;
            }
        }

        return $i;
    }
}
