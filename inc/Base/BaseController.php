<?php

namespace Inc\Base;

class BaseController
{
    public $plugin_path;

    public $plugin_url;

    public $plugin;

    public $subpagesOutput = array();

    public $dahboardFields = array();

    public $fieldsOutput = array();


    public function __construct()
    {
        $this->plugin_path = SITE_ROOT;
        $this->plugin_url = plugins_url().'/hook-me-up-api';

        $this->subpagesOutput = array(

        );

        /*
        * FIELDS
        */
        
        $this->dahboardFields = array(
            // ID
            //0- title 1- callback 2-page 3- section 4- option name 5-input type

            'basic_auth_url' => //id
                array('Basic Auth Url',
                    'hmu_api_basic_auth_url',
                    'hmu_api_plugin',
                    'hmu_api_dashboard_index',
                    'hmu_api_basic',
                    'boolean'
                )



        );


    }




}