<?php

declare(strict_types=1);

namespace AgelxNash\Cmsdetect\Signature\Php;

use AgelxNash\Cmsdetect\Dto\Site;
use AgelxNash\Cmsdetect\SignatureInterface;
use Symfony\Component\DomCrawler\Crawler;

class WordPress  implements SignatureInterface
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
                    if (0 === \mb_strpos($content, 'WordPress ')) {
                        $i += 0.5;
                    }
                    break;
            }
        }
        if (\mb_strpos($site->content, '/wp-content/plugins/') !== false) {
            $i += 0.35;
        }
        if (\mb_strpos($site->content, '/wp-content/themes/') !== false) {
            $i += 0.35;
        }
        if (\mb_strpos($site->content, '/wp-includes/') !== false) {
            $i += 0.35;
        }
        if (\mb_strpos($site->content, '/wp-content/uploads/') !== false) {
            $i += 0.35;
        }
        if (\mb_strpos($site->content, '<!-- WP Super Cache is installed but broken. ') !== false) {
            $i += 0.35;
        }
        if (\mb_strpos($site->content, '<!--wp_footer-->') !== false) {
            $i += 0.35;
        }

        foreach ($site->headers as $header) {
            if ($header->name === 'link' &&
                (\mb_strpos($header->value, '/wp-json/') !== false || \mb_strpos($header->value, 'api.w.org'))
            ) {
                $i++;
                continue;
            }
            if ($header->name === 'x-pingback' && \mb_substr($header->value, -11) === '/xmlrpc.php') {
                $i += 0.35;
                continue;
            }
            if ($header->name === 'x-powered-by') {
                if (0 === \mb_strpos($header->value, 'WP Rocket')) {
                    $i++;
                    continue;
                }
                if (0 === \mb_strpos($header->value, 'W3 Total Cache')) {
                    $i++;
                    continue;
                }
                if (0 === \mb_strpos($header->value, 'WP Optimize By xTraffic')) {
                    $i++;
                    continue;
                }
            }
        }

        foreach ($site->cookies as $cookie) {
            //cookie
            /**
             * wpuid
             * wp_locale_test_group
             */

            if ($cookie->name === '_wp_session') {
                $i++;
                continue;
            }
            if (0 === \mb_strpos($cookie->name, 'wordpress_')) {
                $i++;
                continue;
            }
            if ($cookie->name === 'WP-LastViewedPosts') {
                $i++;
                continue;
            }
            if (0 === \mb_strpos($cookie->name, 'wp_woocommerce_session_')) {
                $i++;
                continue;
            }
            if (0 === \mb_strpos($cookie->name, 'wptouch')) {
                $i++;
                continue;
            }
        }

        return $i > 1;
    }
}
