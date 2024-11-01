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
class ShortCodes
{

    private $_adUnitGenerator;

    public function adUnit( $atts , $content ) 
    {
        extract( shortcode_atts( array(
            'token' => null,
            'dimension' => null,
        ), $atts ) );
        
        $ad_unit = new SplurgyPublisherAdUnitGenerator($token, $dimension, 'ad-unit');
        $html = $ad_unit->getHtml();
        return $html;
    }

    public function shortCodeMeta() {
        add_meta_box(
            'myplugin_sc_sectionid', __(
                'Splurgy Short Code Help', 'myplugin_sc_textdomain'
            ), array($this, 'shortCodeHelp'), 'post', 'normal', 'high'
        );

        add_meta_box(
            'myplugin_sc_sectionid', __(
                'Splurgy Short Code Help', 'myplugin_sc_textdomain'
            ), array($this, 'shortCodeHelp'), 'page', 'normal', 'high'
        );
    }


    public function shortCodeHelp() {
       echo "<div class='text_help_for_shortcode'>" 
           ."<label for='shortcode_help'>"
           ."The 'splurgy_adunit' shortcode will display the active promotion assigned to a Location. "
           ."You can find your Location token in your <a href='https://offers.splurgy.com/channels' target='_blank'>Splurgy Control Panel under \"Locations\"</a>. </br> </br>"
           ."<u>Example usage</u><br>"
           ."[splurgy_adunit token='pi_a11b459df7a57b193be1ca367ea26e8aedf94779' dimension='400x460']"
           ."</label>"
           ."</div>";
    }

}

?>
