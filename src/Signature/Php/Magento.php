<?php

declare(strict_types=1);

namespace AgelxNash\Cmsdetect\Signature\Php;

use AgelxNash\Cmsdetect\Dto\Site;
use AgelxNash\Cmsdetect\SignatureInterface;

class Magento  implements SignatureInterface
{
    public function detect(Site $site): float
    {
        $i = 0;
        /**
         * @see: https://github.com/urbanadventurer/WhatWeb/blob/master/plugins/magento.rb
         */
        foreach ($site->cookies as $cookie) {
            /**
             * Magento 2
             */
            if ($cookie->name === 'optimizelyEndUserId') {
                $i++;
                continue;
            }

            /**
             * Set-Cookie: frontend=3d3tts5uumgt3v6klitfr15b05;    ALPHA    1.1.6
             * Set-Cookie: frontend=c7ec59c75e957b29f1d5e0d6cfcb3a98;    HEX    1.2.0.2
             * Set-Cookie: frontend=54f0e9aa64fe53d0f076ef0e328841d5;    HEX    1.2.1.2
             * Set-Cookie: frontend=873sd3kemps1al4np0c6ndkac4;    ALPHA    1.3.1
             * Set-Cookie: frontend=dcf246795fa247992d07daa7a7ba147e;    HEX    1.3.1.1
             * Set-Cookie: frontend=a9239941fea5df3bb1b75485d56cb817;    HEX    1.3.2.1
             * Set-Cookie: frontend=ec409bd20122a68f9c27fa66c358fc7d;    HEX    1.4.0.1
             * Set-Cookie: frontend=s0ucd54lq2js68cp05sp6r2u92;    ALPHA    1.4.0.1
             */
            if ($cookie->name === 'frontend') {
                $i++;
                continue;
            }
        }

        return $i;
    }
}
