<?php

class SplurgySettings
{

    public function adminSideBarMenu()
    {
        add_menu_page('Splurgy', 'Splurgy', 'manage_splurgy', 'splurgy');

        add_submenu_page(
           'splurgy', 'Settings', 'Settings', 'manage_options', 'settings', 
            array($this, 'settingsPage')
        );
    }

    public function postHandler() {
        $ads = $_POST['ads'];
        if (isset($ads)) {
            if($ads == 'live') {
                update_option('splurgyAds', 'live');
                echo '<div id="message" class="updated"><p>Splurgy Ads are now live!</p></div>';             
            } else {
                update_option('splurgyAds', 'off');
                echo '<div id="message" class="updated"><p>Splurgy Ads are now disabled. You will not see any ads inserted into your posts.</p></div>';             
            }
        }

        $token = $_POST['token'];
        if (isset($token)) {
            $token_prefix = substr($token, 0, 2);
            if($token_prefix == 'pi') {
                update_option('splurgyAdToken', $token);
                echo '<div id="message" class="updated"><p>Your token has been set! You can turn on your ads now!</p></div>';             
            } else {
                echo '<div id="message" class="error"><p>That token is invalid. Please try again.</p></div>';             
            }
        }


        $delete = $_POST['delete_token'];
        if (isset($delete)) {
            if($delete == 'deleted') {
                update_option('splurgyAdToken', 'deleted');
                update_option('splurgyAds', 'off');
                echo '<div id="message" class="updated"><p>Your token has been deleted! Your ads have been turned off.</p></div>';             
            }
        }

        $dimension = $_POST['dimension'];
        if (isset($dimension)) {
            if($dimension == '400x300') {
                update_option('splurgyAdDimension', '400x300');
                echo '<div id="message" class="updated"><p>Your ad dimension has been set to 400x300.</p></div>';             
            } elseif($dimension == '300x250') {
                update_option('splurgyAdDimension', '300x250');
                echo '<div id="message" class="updated"><p>Your ad dimension has been set to 300x250.</p></div>';             
            }
        }

        $post_id = $_POST['test_post'];
        if (isset($post_id)) {
            if(is_numeric($post_id)) {
                update_option('splurgyAdTestPost', $post_id);
                echo '<div id="message" class="updated"><p>Your Post ID: '.$post_id.' should now have a Splurgy Ad injected</p></div>';             
            } elseif($post_id == 'off') {
                update_option('splurgyAdTestPost', 'off');
                echo '<div id="message" class="updated"><p>Sitewide ad test has been turned off</p></div>';             
            }
        }        
    }

    public function settingsPage() {
        $is_live = get_option('splurgyAds');
        $token = get_option('splurgyAdToken');
        $dimension = get_option('splurgyAdDimension');
        $post_id = get_option('splurgyAdTestPost');

        echo "<div class='wrap' style='width: 500px; display: inline-block;'>";
        echo "<h1>Splurgy Settings</h1>";
        echo "<br>";
        echo "<h2>Splurgy Ads are currently <b>{$is_live}</b></h2>";
        echo "<br>";
        echo "<hr>";
        echo "<h2>Advertisemment Settings</h2>";
        echo "<p>The following settings allows you to toggle Splurgy Ads on and off. "
            . "When ads are live, an advertisement will be inserted into the middle of a post ONLY on the post page. "
            . "More specifically, it will be inserted after the second paragraph. "
            . "If the post is short, it will automatically be inserted after the first paragraph or sentence."
            . "This will not disable posts with shortcode embeds. <b>You will be able to turn on ads after you setup your token.</b>";
        echo "</p>";

        if($token == 'init' || $token == 'deleted') {
            echo "<form name='set_token' method='post'></br/>";
            echo "<input type='text' name='token' placeholder='Type your token here'/>";
            echo "<input type='submit' value='Set Token' />";
            echo "</form><br/>";   
        } else {
            echo "Your current token is <b>$token</b>";
            echo "<form name='delete_token' method='post'>";
            echo "<input type='hidden' name='delete_token' value='deleted'/>";
            echo "<input type='submit' value='Delete Token' />";
            echo "</form><br/>";

            echo "Current Dimension Size is <b>$dimension</b>";
            echo "<form name='dimension' method='post'>";
            echo "<select  name='dimension'>";
            echo "<option value='400x300'>400x300</option>";
            echo "<option value='300x250'>300x250</option>";
            echo "</select>";
            echo "<input type='submit' value='Select Size' />";
            echo "</form>";

            echo "<form name='ads' method='post'></br/>";
            if($is_live == 'off') {            
                echo "<input type='hidden' name='ads' value='live' />"; 
                echo "<input type='submit' value='Turn on ads' />";
            } elseif($is_live == 'live') {
                echo "<input type='hidden' name='ads' value='off' />"; 
                echo "<input type='submit' value='Turn off ads' />";
            }
            echo "</form><br/>";  
        }
 

        echo "<hr>";
        echo "<h2>Are you interested in advertising with Splurgy?</h2>";
        echo "Brand Exposure. Social Network Boost. Conversational Media. ";
        echo "Splurgy does it all. Drop us an e-mail support@splurgy.com";

        echo "<hr>";
        echo "<h2>Test Mode</h2>";
        echo "This allows you to test how sitewide ads will look on a given post (only works when sitewide ads are off). ";
        echo "To disable, just save as 'off'.";
        echo "<br/>";
        echo "<br/>";
        echo "Current Test Post is <b>$post_id</b>";
        echo "<form name='test_post' method='post'>";
        echo "<input type='text' name='test_post' placeholder='Type your post ID here'/>";
        echo "<input type='submit' value='Save' />";
        echo "</form><br/>";

        echo "</div>";

    }
}

