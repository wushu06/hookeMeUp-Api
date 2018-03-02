<?php 

namespace Inc\Pages; 

use \Inc\Base\BaseController;

use \Inc\Api\SettingsApi;

use \Inc\Api\Callbacks\AdminCallbacks;

use \Inc\Api\Callbacks\FieldsCallbacks;

class Admin extends BaseController {

    public $settings;
	public $admin_callbacks;
	public $fields_callbacks;
    public $pages = array();
	public $subpages = array();

   

    function __construct() {
		

		$this->settings = new SettingsApi();
		
				$this->admin_callbacks = new AdminCallbacks();
				$this->fields_callbacks = new FieldsCallbacks();
		
				$this->set_pages();
		
				$this->setSubpages();
		
				$this->setSettings();
				$this->setSections();
				$this->setFields();
		
				$this->settings->add_pages( $this->pages )->withSubPage( 'Dashboard' )->addSubPages( $this->subpages )->register();

				
    }

    /*
    * create menu 
    */
        
    function set_pages () {
        $this->pages = array(
            array(
                    'page_title' => 'Hook Me Up Api',
                    'menu_title' => 'Hook Me Up Api',
                    'capability' => 'manage_options', 
                    'menu_slug' => 'hmu_api_plugin',
                    'callback' => array( $this->admin_callbacks, 'hmu_api_plugin' ),
                    'icon_url' => plugins_url(). '/hook-me-up-api/assets/images/api.png',
                    'position' => 110
                )
            );
  
    

	}
	public function setSubpages()
	{
		foreach ($this->subpagesOutput as $slug => $title_callback) {
			    $this->subpages[] = array (
				'parent_slug' => 'hmu_api_plugin',
				'page_title' => $title_callback[0],
				'menu_title' => $title_callback[0],
				'capability' => 'manage_options',
				'menu_slug' => $slug,
				'callback' => array( $this->admin_callbacks, $title_callback[1] ),
			);

		}

	}
    /*
    * create fields
    */
	public function setSettings()
	{
        /*
         * # for each page create group of fields and give each group option name
         * #
         */


		$args = array(
			array(
				'option_group' => 'hmu_api_dashboard_options_group',
				'option_name' => 'hmu_api_basic',
				//'callback' => array( $this->fields_callbacks,'sanitizeCallback' )
			),
            array(
                'option_group' => 'hmu_api_dashboard_second_group',
                'option_name' => 'hmu_api_oauth_one',
                //'callback' => array( $this->fields_callbacks,'sanitizeCallback' )
            )
			
		);
	
		

		$this->settings->setSettings( $args );
	}

	public function setSections()
	{
		$args = array(
            array(
                'id' => 'hmu_api_dashboard_index',
                'title' => 'Dashboard',
                'callback' => array( $this->fields_callbacks, 'dashboardSectionManager' ),
                'page' => 'hmu_api_plugin' //dashboard page
            ),
            array(
                'id' => 'hmu_api_dashboard_second',
                'title' => 'Auth 1',
                'callback' => array( $this->fields_callbacks, 'dashboardSectionManager' ),
                'page' => 'hmu_api_auth_plugin' //dashboard page
            )
		);

		$this->settings->setSections( $args );
    }
    

    public function dahboardFields() 
    {
        return  array(
            // ID
            //0- title 1- callback 2-page 3- section 4- option name 5-input type
    
            'basic_auth_url' => //id
            array('Basic Auth Url',
                'hmu_api_basic_auth_url',
                'hmu_api_plugin',
                'hmu_api_dashboard_index',
                'hmu_api_basic',
                'boolean'
            ),
        'basic_auth_username' => //id
            array('Basic Auth Username',
                'hmu_api_basic_auth_username',
                'hmu_api_plugin',
                'hmu_api_dashboard_index',
                'hmu_api_basic',
                'boolean'
            ),
        'basic_auth_password' => //id
            array('Basic Auth Password',
                'hmu_api_basic_auth_password',
                'hmu_api_plugin',
                'hmu_api_dashboard_index',
                'hmu_api_basic',
                'boolean'
            ),
        'auth_one_url' => //id
            array('oAuth 1 Url',
                'hmu_api_auth_1_url',
                'hmu_api_auth_plugin',
                'hmu_api_dashboard_second',
                'hmu_api_oauth_one',
                'boolean'
            ),
        'auth_one_ck' => //id
            array('oAuth CK',
                'hmu_api_auth_1_ck',
                'hmu_api_auth_plugin',
                'hmu_api_dashboard_second',
                'hmu_api_oauth_one',
                'boolean'
            ),
        'auth_one_cs' => //id
            array('oAuth CS',
                'hmu_api_auth_1_cs',
                'hmu_api_auth_plugin',
                'hmu_api_dashboard_second',
                'hmu_api_oauth_one',
                'boolean'
            ),

    
    
    
        );
    

    }  

	public function setFields()
	{
  
        $args = array ();
        
       /* $args   =array (
            array (
				'id' => 'basic_auth_url',
				'title' => 'Basic Auth Url',
				'callback' => array( $this->fields_callbacks, 'hmu_api_basic_auth_url'),
				'page' => 'hmu_api_plugin',
				'section' => 'hmu_api_dashboard_index',
					'args' => array(
						'option_name' => 'hmu_api_basic',
						'label_for' =>'basic_auth_url',
						'class' => 'hmu-upload'
					)
				)
		
            );*/



		foreach ($this->dahboardFields()   as $id_dash => $dashtitle_callback ) {
			
			$args[] = array (
				'id' => $id_dash,
				'title' => $dashtitle_callback[0],
				'callback' => array( $this->fields_callbacks, $dashtitle_callback[1] ),
				'page' => $dashtitle_callback[2],
				'section' => $dashtitle_callback[3],
					'args' => array(
						'option_name' => $dashtitle_callback[4],
						'label_for' => $id_dash,
						'class' => 'hmu-upload'
					)
				);
		}
		

		$this->settings->setFields( $args );
	}

}