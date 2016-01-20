<?php
/*
  Plugin Name:  CacheClear
  Version:      0.1
  Author:       Simon
*/
namespace PL_CacheClear;
class CacheClear {

  function __construct() {
    include_once( 'inc/plugin.php' );
    new Plugin();
  }
}
new CacheClear;
