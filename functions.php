<?php

//ENSIX STUDIOS CUSTOM SHORTCODES http://www.ensixstudios.com/

function addfile_func( $atts ) {
    $a = shortcode_atts( array(
        'template' => 'none'


    ), $atts );
      $template = $a['template'];
      
      ob_start();
 
        get_template_part( 'template-parts/content', 'oceancompound-feature');
return ob_get_clean();
  
 
    
};
add_shortcode( 'addfile', 'addfile_func' );
 


 /*
 * themo_hook_head_css = to add custom css or JS to your head
 */

//add_action('wp_head','themo_hook_head_css');
function themo_hook_head_css() {
    $output="<script>
        jQuery(document).ready(function($) {

           console.log('My Headeer Script');
        });
            </script>";
    echo $output;
}


//add_action( 'wp_footer', 'my_themo_footer_scripts' );
function my_themo_footer_scripts() {
    ?>

    <script type="text/javascript">
        /* Disable slider_gallery lightbox  */
        jQuery(document).ready(function($) {
            "use strict";
            console.log('My Footer Script');
        });
    </script>
    <?php
}

/********************************
WooCommerce Extras
 ********************************/
/*
WooCommerce Booking Support
WooCommerce Custom Booking Fields to checkout.
Comment these actions and filters if of you wish to use.

TO ACTIVATE UNCOMMENT the add_action lines at the bottom of this file (Scroll Down).
*/


// If woocommerce enabled then ensure shortcodes are respected inside our html metaboxes.
function wdm_enque_scripts(){
        wp_register_script('th_addtocart', get_stylesheet_directory_uri() . '/assets/js/th_single_product_page.js', array('jquery'), '1', true);
        wp_enqueue_script('th_addtocart');
        $array_to_be_sent = array('ajaxurl' => admin_url('admin-ajax.php'));
        wp_localize_script('th_addtocart', 'th_ajax', $array_to_be_sent);
    }


function wdm_add_user_custom_data_options_callback()
{
    //Custom data - Sent Via AJAX post method
    $product_id = $_POST['id']; //This is product ID
    $custom_data_1 =  $_POST['custom_data_1']; //This is User custom value sent via AJAX
    $custom_data_2 = $_POST['custom_data_2'];
    $custom_data_3 = $_POST['custom_data_3'];
    $custom_data_4 = $_POST['custom_data_4'];
    $custom_data_5 = $_POST['custom_data_5'];

    //echo "<h1> GETTER HERE".$custom_data_1."</h1>>";

    session_start();
    if (isset($custom_data_1) && $custom_data_1 > "") {
        $_SESSION['custom_data_1'] = $custom_data_1;
    }
    if (isset($custom_data_2) && $custom_data_2 > "") {
        $_SESSION['custom_data_2'] = $custom_data_2;
    }
    if (isset($custom_data_3) && $custom_data_3 > "") {
        $_SESSION['custom_data_3'] = $custom_data_3;
    }
    if (isset($custom_data_4) && $custom_data_4 > "") {
        $_SESSION['custom_data_4'] = $custom_data_4;
    }
    if (isset($custom_data_5) && $custom_data_5 > "") {
        $_SESSION['custom_data_5'] = $custom_data_5;
    }
    die();
}

// step 2



if(!function_exists('wdm_add_item_data'))
{
    function wdm_add_item_data($cart_item_data,$product_id)
    {
        /*Here, We are adding item in WooCommerce session with, wdm_user_custom_data_value name*/
        global $woocommerce;
        session_start();

        $new_value = array();


        if (isset($_SESSION['custom_data_1']) && $_SESSION['custom_data_1'] > "") {
            $option1 = $_SESSION['custom_data_1'];
            $new_value['custom_data_1'] =  $option1;
        }
        if (isset($_SESSION['custom_data_2']) && $_SESSION['custom_data_2'] > "") {
            $option2 = $_SESSION['custom_data_2'];
            $new_value['custom_data_2'] =  $option2;
        }
        if (isset($_SESSION['custom_data_3']) && $_SESSION['custom_data_3'] > "") {
            $option3 = $_SESSION['custom_data_3'];
            $new_value['custom_data_3'] =  $option3;
        }
        if (isset($_SESSION['custom_data_4']) && $_SESSION['custom_data_4'] > "") {
            $option4 = $_SESSION['custom_data_4'];
            $new_value['custom_data_4'] =  $option4;
        }
        if (isset($_SESSION['custom_data_5']) && $_SESSION['custom_data_5'] > "") {
            $option5 = $_SESSION['custom_data_5'];
            $new_value['custom_data_5'] =  $option5;
        }

        if( empty($option1) && empty($option2) && empty($option3) && empty($option4) && empty($option5)  )
            return $cart_item_data;
        else
        {
            if(empty($cart_item_data))
                return $new_value;
            else
                return array_merge($cart_item_data,$new_value);
        }


//        vardump($new_value);
//        die();


        unset($_SESSION['custom_data_1']);
        unset($_SESSION['custom_data_2']);
        unset($_SESSION['custom_data_3']);
        unset($_SESSION['custom_data_4']);
        unset($_SESSION['custom_data_5']);

        //Unset our custom session variable, as it is no longer needed.
    }
}

// step 3


if(!function_exists('wdm_get_cart_items_from_session'))
{
    function wdm_get_cart_items_from_session($item,$values,$key)
    {

        if (array_key_exists( 'custom_data_1', $values ) && $values['custom_data_1'] > "")
        {
            $item['custom_data_1'] = $values['custom_data_1'];
        }

        if (array_key_exists( 'custom_data_2', $values )  && $values['custom_data_2'] > "")
        {
            $item['custom_data_2'] = $values['custom_data_2'];
        }

        if (array_key_exists( 'custom_data_3', $values )  && $values['custom_data_3'] > "")
        {
            $item['custom_data_3'] = $values['custom_data_3'];
        }

        if (array_key_exists( 'custom_data_4', $values )  && $values['custom_data_4'] > "")
        {
            $item['custom_data_4'] = $values['custom_data_4'];
        }

        if (array_key_exists( 'custom_data_5', $values )  && $values['custom_data_5'] > "")
        {
            $item['custom_data_5'] = $values['custom_data_5'];
        }

        return $item;
    }
}


// step 4



if(!function_exists('wdm_add_user_custom_option_from_session_into_cart'))
{
    function wdm_add_user_custom_option_from_session_into_cart($product_name, $values, $cart_item_key )
    {
        /*code to add custom data on Cart & checkout Page*/
        if(isset($values['custom_data_1']) && count($values['custom_data_1']) > 0)
        {
            $return_string = $product_name . "</a><dl class='variation'>";
            $return_string .= "<table class='wdm_options_table' id='" . $values['product_id'] . "'>";
            $return_string .= "<tr><td>".esc_html__('Check-in', 'BELLEVUE')." : " . $values['custom_data_1'] . "</td></tr>";
            if(isset($values['custom_data_2']) && $values['custom_data_2'] != 'false') {
                $return_string .= "<tr><td>" . esc_html__('Check-out', 'BELLEVUE') . " : " . $values['custom_data_2'] . "</td></tr>";
            }
            if(isset($values['custom_data_3']) && $values['custom_data_3'] != 'false') {
                $return_string .= "<tr><td>" . esc_html__('Custom 3', 'BELLEVUE') . " : " . $values['custom_data_3'] . "</td></tr>";
            }
            if(isset($values['custom_data_4']) && $values['custom_data_4'] != 'false') {
                $return_string .= "<tr><td>" . esc_html__('Custom 4', 'BELLEVUE') . " : " . $values['custom_data_4'] . "</td></tr>";
            }
            if(isset($values['custom_data_5']) && $values['custom_data_5'] != 'false') {
                $return_string .= "<tr><td>" . esc_html__('Custom 5', 'BELLEVUE') . " : " . $values['custom_data_5'] . "</td></tr>";
            }
            $return_string .= "</table></dl>";

            return $return_string;
        }
        else
        {
            return $product_name;
        }
    }
}


// step 5


if(!function_exists('wdm_add_values_to_order_item_meta'))
{
    function wdm_add_values_to_order_item_meta($item_id, $values)
    {
        global $woocommerce,$wpdb;


        $custom_data_1 = $values['custom_data_1'];

        if(!empty($custom_data_1) && $custom_data_1 > '')
        {
            wc_add_order_item_meta($item_id,'Check-in',$custom_data_1);
        }


        $custom_data_2 = $values['custom_data_2'];

        if(!empty($custom_data_2)  && $custom_data_2 > '')
        {
            wc_add_order_item_meta($item_id,'Check-out',$custom_data_2);
        }

        $custom_data_3 = $values['custom_data_3'];

        if(!empty($custom_data_3)  && $custom_data_3 > '')
        {
            wc_add_order_item_meta($item_id,'custom_data_3',$custom_data_3);
        }

        $custom_data_4 = $values['custom_data_4'];

        if(!empty($custom_data_4)  && $custom_data_4 > '')
        {
            wc_add_order_item_meta($item_id,'custom_data_4',$custom_data_4);
        }

        $custom_data_5 = $values['custom_data_5'];

        if(!empty($custom_data_5)  && $custom_data_5 > '')
        {
            wc_add_order_item_meta($item_id,'custom_data_5',$custom_data_5);
        }
    }
}


// step 6


if(!function_exists('wdm_remove_user_custom_data_options_from_cart'))
{
    function wdm_remove_user_custom_data_options_from_cart($cart_item_key)
    {
        global $woocommerce;
        // Get cart
        $cart = $woocommerce->cart->get_cart();
        // For each item in cart, if item is upsell of deleted product, delete it
        foreach( $cart as $key => $values)
        {
            if ( $values['wdm_user_custom_data_value'] == $cart_item_key )
                unset( $woocommerce->cart->cart_contents[ $key ] );
        }
    }
}

// UNCOMMENT ALL OF THE LINKS BELOW
// This will provide sample code for showing WP Booking fields in the Woo Cart.


/*
if ( class_exists( 'woocommerce' ) ) {
    add_action( 'wp_enqueue_scripts', 'wdm_enque_scripts' );
    add_action('wp_ajax_wdm_add_user_custom_data_options', 'wdm_add_user_custom_data_options_callback');
    add_action('wp_ajax_nopriv_wdm_add_user_custom_data_options', 'wdm_add_user_custom_data_options_callback');
    add_filter('woocommerce_add_cart_item_data','wdm_add_item_data',1,2);
    add_filter('woocommerce_get_cart_item_from_session', 'wdm_get_cart_items_from_session', 1, 3 );
    add_filter('woocommerce_checkout_cart_item_quantity','wdm_add_user_custom_option_from_session_into_cart',1,3);
    add_filter('woocommerce_cart_item_price','wdm_add_user_custom_option_from_session_into_cart',1,3);
    add_action('woocommerce_add_order_item_meta','wdm_add_values_to_order_item_meta',1,2);
    add_action('woocommerce_before_cart_item_quantity_zero','wdm_remove_user_custom_data_options_from_cart',1,1);
}
*/