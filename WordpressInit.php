<?php
/**
   Plugin Name: Sponsored Promotions
   Plugin URI: https://github.com/splurgy/plugins/
   Description: This plugin will allow publishers to easily embed ad units
   Version: 1.5.3
   Author: Splurgy
   Author URI: http://www.splurgy.com
   License: MIT
 * 
 * PHP version 5.3.1
 *
 * @category WordpressInit
 * @package  PackageName
 * @author   Splurgy <support@splurgy.com>
 * @license  http://opensource.org/licenses/MIT MIT
 * @link     http://www.splurgy.com Splurgy
*/
?>
<?php
/**  Copyright (C) 2012 Splurgy Inc

    Permission is hereby granted, free of charge, to any person obtaining a 
    copy of this software and associated documentation files (the "Software"), 
    to deal in the Software without restriction, including without limitation 
    the rights to use, copy, modify, merge, publish, distribute, sublicense, 
    and/or sell copies of the Software, and to permit persons to whom the 
    Software is furnished to do so, subject to the following conditions:

    The above copyright notice and this permission notice shall be included in 
    all copies or substantial portions of the Software.

    THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR 
    IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY, 
    FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE 
    AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER 
    LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, 
    OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN 
    THE SOFTWARE.
*/
?>
<?php
require_once 'WordpressHooks.php';

/**
 * Initiates the plugin
 *
 * @category WordPressInit
 * @package  PackageName
 * @author   Splurgy <support@splurgy.com>
 * @license  http://opensource.org/licenses/MIT MIT
 * @link     http://www.splurgy.com Splurgy
 */
class WordpressInit
{
    protected $wpHooks;

    /**
     * Wordpress Init construct function
     */
    public function __construct()
    {
        register_activation_hook(dirname(__FILE__). '/WordpressInit.php', array( $this, 'activate' ));
        register_deactivation_hook(dirname(__FILE__). '/WordpressInit.php', array( $this, 'deactivate' ));

        $this->wpHooks = new WordpressHooks();
    }

    public function activate() { 
      add_option('splurgyAds', 'off'); 
      add_option('splurgyAdToken', 'init'); 
      add_option('splurgyAdDimension', '300x250'); 
      add_option('splurgyAdTestPost', 'off'); 

    }

    public function deactivate() { 
      delete_option('splurgyAds'); 
      delete_option('splurgyAdToken'); 
      delete_option('splurgyAdDimension');
      delete_option('splurgyAdTestPost'); 


    }
}

$wordpressInit = new WordpressInit();



?>
