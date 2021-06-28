<?php
/**
 * Plugin Name: QR Shortcode 
 * Plugin URI: https://www.primeview.com/
 * Description: Adds a QR Code to your site using a shortcode
 * Version: 1.0.1
 * Author: PV DEV
 * Author URI: https://www.primeview.com/
 */

// Include Widget
include( plugin_dir_path( __FILE__ ) . 'widget/qr-widget.php'); 

function qr_generateQRCode($atts, $content = null){
    // Defaults
    $url = '';
    $target = '_blank';
    $size = '200';
    $alt = '';
    $title = '';
    $color = '000';
    $bgcolor = 'fff';
    extract(shortcode_atts(array(
        'url' => $url,
        'target' => $target,
       'size' => $size,
       'alt' => $alt,
       'title' => $title,
       'color' => $color,
       'bgcolor' => $bgcolor
    ), $atts));

    if(empty($url)){
        $return_string = '<img src="//api.qrserver.com/v1/create-qr-code/?data='.do_shortcode($content).'&size='.$size.'x'.$size.'&color='.$color.'&bgcolor='.$bgcolor.'" alt="'.$alt.'" title="'.$title.'" height="'.$size.'" width="'.$size.'" />';
    } 
    else {
        if($target == 'none'){
            $return_string = '<a href="'.$url.'" ><img src="//api.qrserver.com/v1/create-qr-code/?data='.do_shortcode($content).'&size='.$size.'x'.$size.'&color='.$color.'&bgcolor='.$bgcolor.'" alt="'.$alt.'" title="'.$title.'" height="'.$size.'" width="'.$size.'" /></a>';
        } else {
            $return_string = '<a href="'.$url.'" target="'.$target.'"><img src="//api.qrserver.com/v1/create-qr-code/?data='.do_shortcode($content).'&size='.$size.'x'.$size.'&color='.$color.'&bgcolor='.$bgcolor.'" alt="'.$alt.'" title="'.$title.'" height="'.$size.'" width="'.$size.'" /></a>';
        }
    }
    
    $return_string = str_replace('&#038;', 'and', $return_string);
    return $return_string;
}

function qr_registerQRShortcode(){
    add_shortcode( 'qrcode', 'qr_generateQRCode' ); //[qrcode size=200 alt=alttext title=titletext][/qrcode]
}
add_action( 'init', 'qr_registerQRShortcode');
?>