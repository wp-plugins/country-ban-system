<?php
/*
Plugin Name: Country Ban System
Plugin URI: https://github.com/jzvikas/Country-Ban-System
Description: Hide text/link/image in specific country.
Version: 1.0
Author: Justinas Žvikas
Author URI: https://github.com/jzvikas/Country-Ban-System
*/
function cbs_block_country($attr,$content) {
extract(shortcode_atts(array('ct'=>'ct','message'=>'message'),$attr));
require_once('geoip.inc');
$geoip = geoip_open(plugin_dir_path(__FILE__) . 'GeoIP.dat',GEOIP_STANDARD);
$country = geoip_country_code_by_addr($geoip, $_SERVER['REMOTE_ADDR']);
$ct = strtoupper($ct);
preg_match_all("/([^,]+)/", $ct, $pairs);
$i = 0;
foreach($pairs as $pair){
if($pair[$i++] == $country){
$text = '<br><p align="center"><b>'.$message.'</b></p><br>';
}
}
return isset($text)?$text:$content;
}
add_shortcode('cbs_block_country', 'cbs_block_country');
?>