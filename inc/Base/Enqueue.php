<?php 

namespace Inc\Base; 

use Inc\Base\BaseController;

class Enqueue extends BaseController {

    function register () {

        add_action( 'admin_enqueue_scripts', array( $this, 'enqueue' ) );
    }

    function enqueue ($hook) {
	    if($hook != 'toplevel_page_hmu_api_plugin' ) {
		    return;
	    }
        // enqueue all our scripts
        wp_enqueue_style( 'mystyle', $this->plugin_url. 'assets/app.css', array(), null, 'screen' );
        wp_enqueue_style( 'fontAwesome', 'https://use.fontawesome.com/releases/v5.0.6/css/all.css', array(), null, 'screen' );
        wp_enqueue_script( 'myscript', $this->plugin_url. 'assets/app.js', array(), null, true );

    }

}