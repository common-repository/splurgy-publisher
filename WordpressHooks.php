<?php
/**
 * All wordpress hooks should go here.
 *
 * PHP version 5.3.1
 * 
 */

require_once 'ShortCodes.php';
require_once 'ContentExtras.php';
require_once 'SplurgySettings.php';


/**
 * WordPress Hooks Class Definition
 *
 * @category WordPressHooks
 * @package  PackageName
 * @author   Splurgy <support@splurgy.com>
 * @license  http://opensource.org/licenses/MIT MIT
 * @link     http://www.splurgy.com Splurgy
 */

class WordpressHooks
{
    private $_shortCodes;
    private $_contentExtras;
    private $_splurgySettings;
    
    /**
     * Wordpress Hooks construct
     * 
     * @param type $shortCodes shortCodes variable
     */
    public function __construct()
    {
        $this->_shortCodes = new ShortCodes();
        $this->_contentExtras = new ContentExtras();
        $this->_splurgySettings = new SplurgySettings();


        /** Add Short Codes **/
        add_shortcode('splurgy_adunit', array($this->_shortCodes, 'adUnit'));
        add_action(
            'add_meta_boxes', array(
            $this->_shortCodes, 'shortCodeMeta')
        );

        /** Hook for adding stuff to the_content */
        add_filter('the_content', array( $this->_contentExtras, 'content' ));

        /** Admin Menu **/
        add_action('admin_head', array($this->_splurgySettings, 'postHandler'));
        add_action('admin_menu', array( $this->_splurgySettings, 'adminSideBarMenu' ));

        /** Wp Head **/
        add_action('wp_head', array( $this->_contentExtras, 'getImpressionTracker'));
        
    }

}

?>
