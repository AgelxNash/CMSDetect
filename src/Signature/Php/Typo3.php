<?php

declare(strict_types=1);

namespace AgelxNash\Cmsdetect\Signature\Php;

use AgelxNash\Cmsdetect\Dto\Site;
use AgelxNash\Cmsdetect\SignatureInterface;
use Symfony\Component\DomCrawler\Crawler;

class Typo3  implements SignatureInterface
{
    public function detect(Site $site): float
    {
        $i = 0;

        if (strpos($site->content, 'This website is powered by TYPO3 - inspiring people to share!') !== false) {
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
                    if (0 === \mb_strpos($content, 'TYPO3')) {
                        $i++;
                    }
                    break;
            }
        }

        foreach ($site->cookies as $cookie) {
            if ($cookie->name === 'fe_type_user') {
                $i++;
                continue;
            }
        }

        return $i;
    }
}
