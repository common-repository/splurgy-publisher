<?php

/**
 * All functions for hooks and will output HTML should go here.
 *
 * PHP version 5.3.1
 *
 * @category WordPressView
 * @package  PackageName
 * @author   Splurgy <support@splurgy.com>
 * @license  http://opensource.org/licenses/MIT MIT
 * @link     http://www.splurgy.com Splurgy
 */

require_once 'splurgy-lib/SplurgyPublisherEmbedGenerator.php';
require_once 'splurgy-lib/SplurgyPublisherAdUnitGenerator.php';


/**
 * WordPress View Class definition
 *
 * @category WordPressView
 * @package  PackageName
 * @author   Splurgy <support@splurgy.com>
 * @license  http://opensource.org/licenses/MIT MIT
 * @link     http://www.splurgy.com Splurgy
 */

class ContentExtras
{

    public function content($content)
    {
        if( get_option('splurgyAds') != 'live' &&
            get_option('splurgyAdTestPost') == get_the_ID() ) {
            $content = $this->injectAd($content);
        } elseif (!$this->splurgy_shortcode_exists($content) && is_single() && get_option('splurgyAds') == 'live') {
            $content = $this->injectAd($content);
        }
                  
        return $content;
    }

    public function getImpressionTracker() 
    {
        $impression = new SplurgyPublisherEmbedGenerator('impression', null, 'ad-unit');
        $html = $impression->getHtml();
        echo $html;
    }

    public function getDynamicAdUnit() 
    {
        $unit = new SplurgyPublisherAdUnitGenerator(get_option('splurgyAdToken'), get_option('splurgyAdDimension'), 'dynamic-ad-unit');
        $html = $unit->getHtml();
        return $html;
    }

    public function injectAd($content) {
        $needle = '</p>';
        $pos1 = strpos($content, $needle);
        $pos2 = strpos($content, $needle, $pos1 + strlen($needle));
        $embed = $this->getDynamicAdUnit();

        if($pos2 != false) {
            $content = substr_replace($content, $embed, $pos2, 0);
        } else {
            $content = substr_replace($content, $embed, $pos1, 0);
        }

        return $content;
    }

    public function splurgy_shortcode_exists($content) {
        $needle = '[splurgy_adunit';

        $temppos = strpos($content,$needle);
        if($temppos === false) {
          return false;
        } else {
          return true;
        }
    }
}
