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
    
    if ( ! function_exists('opcache_get_configuration') ) { 
      error_log('OPCache is not installed/running');
      return false;
    }
    $data     = opcache_get_status();
    $expired  = array();
 
    if ( empty( $data['scripts'] ) ) {
      error_log('no cached files');
      return false;
    }
    error_log( count($data['scripts']) . ' cached' );       
 
    foreach ( $data['scripts'] as $file ) {
      /* Added testing to see if timestamp was set - if not, opcache.revalidate_timestamp is off */
      if ( empty( $file['timestamp'] ) ) {
        error_log( "This script only works if opcache.validate_timestamps is true in php.ini" );
        return false;
    }
    if ( ! empty( $file['timestamp'] ) && ! empty( $file['full_path'] ) 
    && ( ! file_exists( $file['full_path'] ) || (int) $file['timestamp'] < filemtime( $file['full_path'] ) ) ) {
      $expired[] = $file['full_path'];
      opcache_invalidate( $file['full_path'], true );     
      }
    }
    error_log( count($expired) . ' deleted' );

    opcache_reset();
    error_log( 'pl5 - cleared Opcache caches.' );
  }
}
