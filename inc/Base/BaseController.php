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
        $this->plugin_path = plugin_dir_path(dirname(__FILE__, 2));
        $this->plugin_url = plugin_dir_url(dirname(__FILE__, 2));
        $this->plugin = plugin_basename(dirname(__FILE__, 3)) . '/hook-me-up-csv.php';

        $this->subpagesOutput = array(

        );

        /*
        * FIELDS
        */
        $op = array('hmu_plugin' => 'activate_cron');

        $this->dahboardFields = array(
            // ID
            //0- title 1- callback 2-page 3- section 4- option name 5-input type

            'basic_auth_url' => //id
                array('Basic Auth Url',
                    'hmu_api_basic_auth_url',
                    'hmu_api_plugin',
                    'hmu_api_dashboard_index',
                    'hmu_api_dashboard',
                    'boolean'
                ),
            'basic_auth_username' => //id
                array('Basic Auth Username',
                    'hmu_api_basic_auth_username',
                    'hmu_api_plugin',
                    'hmu_api_dashboard_index',
                    'hmu_api_dashboard',
                    'boolean'
                ),
            'basic_auth_password' => //id
                array('Basic Auth Password',
                    'hmu_api_basic_auth_password',
                    'hmu_api_plugin',
                    'hmu_api_dashboard_index',
                    'hmu_api_dashboard',
                    'boolean'
                ),



        );


    }




}