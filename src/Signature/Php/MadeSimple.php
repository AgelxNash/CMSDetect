<?php

declare(strict_types=1);

namespace AgelxNash\Cmsdetect\Signature\Php;

use AgelxNash\Cmsdetect\Dto\Site;
use AgelxNash\Cmsdetect\SignatureInterface;
use Symfony\Component\DomCrawler\Crawler;

class MadeSimple  implements SignatureInterface
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
                    if (0 === \mb_strpos($content, 'CMS Made Simple - Copyright')) {
                        $i += 0.5;
                    }
                    break;
            }
        }

        $str = "powered by <a href='http://www.cmsmadesimple.org'>CMS Made Simple</a>";
        if (\mb_strpos($site->content, $str) !== false) {
            $i += 0.35;
        }
        foreach ($site->cookies as $cookie) {
            if (preg_match('/(AEFCookies\d{4}\[.{6}\])/i', $cookie->name)) {
                $i++;
                continue;
            }
            if (preg_match('/CMSSESSID.{12}/i', $cookie->name)) {
                $i++;
                continue;
            }
        }

        return $i;
    }
}
