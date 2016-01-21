<?php
namespace PL_CacheClear;
class Wpengine {

  static function run() {
    error_log( 'pl5 - run() at ' . __CLASS__  );
    if( ! class_exists( 'WpeCommon' ) ) {
      return false;
    }
    WpeCommon::purge_memcached();
    WpeCommon::clear_maxcdn_cache();
    WpeCommon::purge_varnish_cache();
    error_log( 'pl5 - cleared WPE caches.' );
  }
}
