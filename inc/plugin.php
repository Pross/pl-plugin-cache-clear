<?php
namespace PL_CacheClear;
class Plugin {
  
  function __construct() {

    $this->classes = array();
    $this->actions = array(
      'pl_server_save_page',
      'save_post'
    );
    $this->load_files();
    $this->add_actions();
  }
  function load_files() {
    foreach( glob( plugin_dir_path( __FILE__ ) . '../plugins/*.php' ) as $file ) {
      include_once( $file );
      $class = 'PL_CacheClear\\' . ucfirst( rtrim( basename( $file ), '.php' ) );
      $this->classes[] = $class;
      new $class();
    }
  }
  
  function add_actions() {
    foreach( $this->actions as $action ) {
      foreach( $this->classes as $class ) {
        add_action( $action, array( $class, 'run' ) );
      }
    }
  }
}
