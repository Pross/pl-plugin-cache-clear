<?php
namespace PL_CacheClear;
class Supercache {

  static function run() {
    error_log( 'pl5 - run() at ' . __CLASS__  );
    if( ! function_exists( 'wp_cache_clear_cache' ) ) {
      return false;
    }
    wp_cache_clear_cache();
    error_log( 'pl5 - cleared WP-Super-Cache caches.' );
  }
}
