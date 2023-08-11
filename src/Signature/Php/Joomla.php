<?php

declare(strict_types=1);

namespace AgelxNash\Cmsdetect\Signature\Php;

use AgelxNash\Cmsdetect\Dto\Site;
use AgelxNash\Cmsdetect\SignatureInterface;
use Symfony\Component\DomCrawler\Crawler;

class Joomla  implements SignatureInterface
{
    public function detect(Site $site): float
    {
        /**
         * @see: http://joomfans.com/?format=feed&type=atom
         */
        $i = 0;
        /**
         * @see: https://github.com/urbanadventurer/WhatWeb/blob/master/plugins/joomla.rb
         */

        foreach ($site->headers as $header) {
            if ($header->name === 'x-generated-by' && str_contains($header->value, 'Joomla')) {
                $i++;
                continue;
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
                    if (stripos($content, 'Joomla! ') === 0) {
                        $i++;
                    }
                    break;
            }
        }

        if (preg_match('/<a href="[^"^:]*index.php\?option=(com_[^&^"]+)/', $site->content)) {
            $i++;
        }

        $tmp = preg_quote($site->domain, '/');
        $regex = '/<a href="(http|https)?:\/\/' . $tmp . '[^"]*index.php\?option=(com_[^&^"]+)/';
        if (preg_match($regex, $site->content)) {
            $i++;
        }

        return $i;
    }
}
