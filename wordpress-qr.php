<?php
/*
Plugin Name: Wordpress QR
Plugin URI: http://www.blackcrystal.net/project/wordpress-qr/
Description: Adds QR code to admin screens of all post types, adds [qr] shortcode
Version: 1.0
Author: Sergei Miami <miami@blackcrystal.net>
Author URI: http://www.blackcrystal.net

Copyright 2016  Sergei Miami <miami@blackcrystal.net>

This program is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation; either version 2 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA

*/

if ( !defined( 'ABSPATH' ) ) exit;

class wordpressqr
{

	private static $instance = null;

	public static function init()
	{
		if( self::$instance == null )
			self::$instance = new self;
		return self::$instance;
	}

	private function __construct()
	{
		add_shortcode( 'qr', array($this,'add_shortcode'));
		add_action( 'add_meta_boxes', array($this,'add_metaboxes'));
	}

	public function add_metaboxes()
	{
		add_meta_box('wordpress-qr', 'QR code', array($this,'render_metaboxes'), null, 'side', 'low');
	}

	public function render_metaboxes( $post )
	{
		if (get_post_status($post) != 'publish')
		{
			echo "Clik Publish to get QR code";
			return;
		}
		echo do_shortcode('[qr style="width: 100%; height: auto;"]');
	}

	public function add_shortcode( $atts )
	{
		$atts = shortcode_atts( array(
			'link'=>get_post_permalink(),
			'size'=>'300',
			'style'=>'',
		), $atts );

    //$atts['link'] = $this->shorten_link($atts['link']);

    $url = 'http://chart.apis.google.com/chart?cht=qr'.
      '&chs='.$atts['size'].'x'.$atts['size'] .
      '&chl='.urlencode($atts['link']).
      '&chld=H|0';
		return '<img src="'.$this->get_cached_qr_url($url).'" style="'.$atts['style'].'">';
	}

	private function shorten_link($url)
  {
    if ($result = wp_cache_get($url, 'wordpress-qr')) return $result;
    $context = stream_context_create(array(
      'http' => array(
        'method'  => 'POST',
        'header'  => array('Content-Type: application/json'),
        'content' => json_encode(array('longUrl'=>$url)),
      ),
    ));
    $json  = file_get_contents('https://www.googleapis.com/urlshortener/v1/url?key=AIzaSyAZUFTmJLUHJJsmaXr3mHr6Z9kGbhhxGzA', false, $context);

    $obj   = json_decode($json);
    $result = isset($obj->id) ? $obj->id : $url;
    wp_cache_set($url, $result, 'wordpress-qr');
    return $result;
  }

  /**
   * Cache QR code into uplads dir
   * @param string $url google chart api url
   * @return string uri to image
   */
	private function get_cached_qr_url( $url )
  {
    $dir = wp_get_upload_dir();
    $file = md5($url).'.png';
    $subdir = substr($file,0,2);
    if (!file_exists($path = "$dir[basedir]/wordpress-qr/$subdir"))
      wp_mkdir_p($path);
    if (!file_exists($path = "$dir[basedir]/wordpress-qr/$subdir/$file"))
      file_put_contents($path, file_get_contents($url)) && chmod($path, 0666);
    return "$dir[baseurl]/wordpress-qr/$subdir/$file";
  }
}

// let's rock!
add_action( 'plugins_loaded', array('wordpressqr', 'init') );