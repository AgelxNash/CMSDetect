<?php

declare(strict_types=1);

namespace AgelxNash\Cmsdetect\Signature\Php;

use AgelxNash\Cmsdetect\Dto\Site;
use AgelxNash\Cmsdetect\SignatureInterface;
use Symfony\Component\DomCrawler\Crawler;

class ModxRevolution implements SignatureInterface
{
    public function detect(Site $site): float
    {
        $i = 0;
        foreach ($site->headers as $header) {
            if ($header->name === 'x-powered-by' && $header->value === 'MODX ModxRevolution') {
                $i++;
                continue;
            }
            if ($header->name === 'Tickets_User') {
                $i++;
                continue;
            }
        }

        /**
         * Такой хинт ушами применяют в FormIT для MODX
         */
        if (str_contains($site->content, '<input type="hidden" name="nospam:blank" value="" />')) {
            $i++;
        }
        /**
         * Форма поиска Simple Search
         */
        if (str_contains($site->content, '<form class="sisea-search-form" action="')) {
            $i++;
        }


        if (strpos($site->content, '/assets/components/quip/') !== false) {
            $i++;
        }
        if (strpos($site->content, '/assets/components/phpthumbof/') !== false) {
            $i++;
        }
        if (strpos($site->content, '/assets/components/tickets/') !== false) {
            $i++;
        }
        if (strpos($site->content, '/assets/components/office/') !== false) {
            $i++;
        }
        if (strpos($site->content, '/assets/components/pdotools/') !== false) {
            $i++;
        }
        if (strpos($site->content, '/assets/components/minifyx/cache/') !== false) {
            $i++;
        }
        if (strpos($site->content, '/assets/components/minishop2/') !== false) {
            $i++;
        }
        if (strpos($site->content, '/assets/components/magnific-popup/') !== false) {
            $i++;
        }
        if (strpos($site->content, '/assets/components/tag_manager2/') !== false) {
            $i++;
        }
        if (strpos($site->content, '/assets/components/shopkeeper/') !== false) {
            $i++;
        }
        if (strpos($site->content, '/assets/components/ajaxform/') !== false) {
            $i++;
        }
        if (strpos($site->content, '/assets/components/gl/') !== false) {
            $i++;
        }
        if (strpos($site->content, '/assets/components/msearch2/') !== false) {
            $i++;
        }
        if (strpos($site->content, '/assets/components/msfavorites/') !== false) {
            $i++;
        }
        if (strpos($site->content, '/assets/components/epochta/') !== false) {
            $i++;
        }
        if (strpos($site->content, '/assets/components/easycomm/') !== false) {
            $i++;
        }
        if (strpos($site->content, '/assets/components/modtelegram/') !== false) {
            $i++;
        }

        if (strpos($site->content, '/assets/components/gallery/connector.php?action=') !== false) {
            $i++;
        }

        //А это возможно картинки phpthumbon
        if (preg_match('/\/assets\/cache_image\/(.*)_(\d+)x(\d+)_(.{3})\.(png|jpg|jpeg|gif)/', $site->content)) {
            $i++;
        }

        //Дефолтный заголовок в тексте
        if (strpos($site->content, '<title>MODX ModxRevolution - Home</title>') !== false) {
            $i++;
        }

        if (strpos($site->content, 'assets/components/') !== false &&
            strpos($site->content, 'assets/images/') !== false
        ) {
            //ПОскольку примитивная проверка, то проверяю дополнительно еще и имя сессии.
            //MODX его не переименовывает и всегда создает
            //А потом еще проверяю наличие base href тега. 90% сайтов его используют
            foreach ($site->cookies as $cookie) {
                switch ($cookie->name) {
                    case 'APIKIT_BOTSTOP_GUEST_ID':
                        $i++;
                        break;
                    case 'phpsessid':
                        $crawler = new Crawler();
                        $crawler->addHtmlContent($site->content);

                        $rows = $crawler->filter('base');
                        foreach ($rows as $row) {
                            if ($row->hasAttribute('href')) {
                                $i++;
                                break 2;
                            }
                        }
                        break;
                }
            }
        }

        return $i;
    }
}
