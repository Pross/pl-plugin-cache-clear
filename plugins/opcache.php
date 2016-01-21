<?php
namespace PL_CacheClear;
class Opcache {

  static function run() {
    if( 'upgrader_process_complete' != current_filter() ) // only clear opcache on core updates
      return false;
    error_log( 'pl5 - run() at ' . __CLASS__  );
    if( ! function_exists( 'opcache_reset' ) ) {
      return false;
    }
    opcache_reset();
    error_log( 'pl5 - cleared WP-Super-Cache caches.' );
  }
}
