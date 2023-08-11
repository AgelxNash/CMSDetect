<?php

declare(strict_types=1);

namespace AgelxNash\Cmsdetect;

class SignatureCollection
{
    public static function get(): array
    {
        return [
            //////// Asp
            'envisage' => Signature\Asp\Envisage::class,

            //////// PHP

            // PHP
            'modx-revo' => Signature\Php\ModxRevolution::class,
            'modx-evo' => Signature\Php\ModxEvolution::class,
            'laravel' => Signature\Php\Laravel::class,
            'amiro-cms' => Signature\Php\AmiroCMS::class,
            'bitrix' => Signature\Php\Bitrix::class,
            'cakephp' => Signature\Php\CakePHP::class,
            'contao' => Signature\Php\Contao::class,
            'cs-cart' => Signature\Php\CSCart::class,
            'dle' => Signature\Php\Dle::class,
            'drupal' => Signature\Php\Drupal::class,
            'hostcms' => Signature\Php\HostCMS::class,
            'image-cms' => Signature\Php\ImageCMS::class,
            'instantcms' => Signature\Php\InstantCMS::class,
            'joomla' => Signature\Php\Joomla::class,
            'livestreet' => Signature\Php\LiveStreet::class,
            'madesimple' => Signature\Php\MadeSimple::class,
            'magento' => Signature\Php\Magento::class,
            'netcat' => Signature\Php\NetCat::class,
            'opencart' => Signature\Php\OpenCart::class,
            'phpbb' => Signature\Php\PhpBB::class,
            'php-shop' => Signature\Php\PHPShop::class,
            'phusion-passenger' => Signature\Php\PhusionPassenger::class,
            'prestashop' => Signature\Php\PrestaShop::class,
            'silver-stripe' => Signature\Php\SilverStripe::class,
            'simpla-cms' => Signature\Php\SimplaCMS::class,
            'smf' => Signature\Php\SMF::class,
            'subrion' => Signature\Php\Subrion::class,
            'symfony' => Signature\Php\Symfony::class,
            'textpattern' => Signature\Php\Textpattern::class,
            'typo3' => Signature\Php\Typo3::class,
            'umi-cms' => Signature\Php\UMICMS::class,
            'vam-shop' => Signature\Php\VamShop::class,
            'vbulletin' => Signature\Php\vBulletin::class,
            'wordpress' => Signature\Php\WordPress::class,
            'xenforo' => Signature\Php\XenForo::class,
            'yii' => Signature\Php\Yii::class,
            'zen-cart' => Signature\Php\ZenCart::class,
            'zend' => Signature\Php\Zend::class,
            'vanilla-forums' => Signature\Php\VanillaForums::class,
            'boonex-dolphin' => Signature\Php\BoonexDolphin::class,
            'grav' => Signature\Php\Grav::class,
            'pagekit' => Signature\Php\Pagekit::class,
            'phalcon' => Signature\Php\Phalcon::class,

            //Ruby
            'discourse' => Signature\Ruby\Discourse::class,
        ];
    }
}