<?php

declare(strict_types=1);

namespace AgelxNash\Cmsdetect\Signature\Php;

use AgelxNash\Cmsdetect\Dto\Site;
use AgelxNash\Cmsdetect\SignatureInterface;
use Symfony\Component\DomCrawler\Crawler;

/**
 * @see http://www.phpshop.ru/
 */
class PHPShop  implements SignatureInterface
{
    public function detect(Site $site): float
    {
        $i = 0;

        /**
         * Если включен режим отладки, то в подвале появляется надпись
         * <!-- БД 19 запроса ~ 0.0514  3668.05 Kb, Сборка 520 -->
         */
        if (preg_match('/<!--\sБД\s+\d+\sзапрос([а]*)\s+~\s+\d+([.,]{1})\d+\s+\d+([.,]{1})\d+\s+Kb,\s+Сборка\s+\d+\s+-->/i',
            $site->content)) {
            $i++;
        }
        /**
         * Гостевая книга всегда находится по адресу /gbook/
         */
        $crawler = new Crawler();
        $crawler->addHtmlContent($site->content);

        $rows = $crawler->filter('head meta');
        /**
         * @var \DOMElement $row
         */
        foreach ($rows as $row) {
            $name = \mb_strtolower($row->getAttribute('name'));
            switch ($name) {
                case 'copyright':
                case 'engine-copyright':
                    if (strpos($row->getAttribute('content'), 'PHPShop') !== false) {
                        $i += 0.5;
                    }
                    break;
            }
        }

        return $i;
    }
}
