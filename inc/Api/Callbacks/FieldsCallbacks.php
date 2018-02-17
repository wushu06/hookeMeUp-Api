<?php 

namespace Inc\Api\Callbacks; 

use \Inc\Base\BaseController;

use \Inc\Api\SettingsApi;

class FieldsCallbacks extends BaseController {

    public $cron_name;

    public function inputSanitize( $input )
    {
        // Create our array for storing the validated options
        $output = array();

        // Loop through each of the incoming options
        foreach ($this->dahboardFields  as $id_dash => $title_callback) {

            // Check to see if the current option has a value. If so, process it.
            if( isset( $input[$id_dash] ) ) {

                // Strip all HTML and PHP tags and properly handle quoted strings
                $output[$id_dash] = strip_tags( stripslashes( $input[ $id_dash ] ) );

            } // end if

        } // end foreach

        // Return the array processing any additional functions filtered by this action
        return $output;

    }



    public function dashboardSectionManager ()
    {

    }

    function hmu_api_basic_auth_url ($args)
    {
        $name = $args['label_for'];
        $classes = $args['class'];
        $option_name = $args['option_name'];
        $value =  get_option( $option_name );
        $isvalue = isset($value[$name]) ? $value[$name]  : '';
        $this->cron_name = $isvalue;

        echo '<input type="text" class="regular-text hmu-input" name="'. $option_name.'['.$name.']"  value="' . $isvalue . '"  placeholder="Url">';


    }

    function hmu_api_basic_auth_username ($args)
    {
        $name = $args['label_for'];
        $classes = $args['class'];
        $option_name = $args['option_name'];
        $value =  get_option( $option_name );
        $isvalue = isset($value[$name]) ? $value[$name]  : '';
        $this->cron_name = $isvalue;

        echo '<input type="text" class="regular-text hmu-input" name="'. $option_name.'['.$name.']"  value="' . $isvalue . '"  placeholder="Username">';


    }

    function hmu_api_basic_auth_password ($args)
    {
        $name = $args['label_for'];
        $classes = $args['class'];
        $option_name = $args['option_name'];
        $value =  get_option( $option_name );
        $isvalue = isset($value[$name]) ? $value[$name]  : '';
        $this->cron_name = $isvalue;

        echo '<input type="password" class="regular-text hmu-input" name="'. $option_name.'['.$name.']"  value="' . $isvalue . '"  placeholder="Password">';


    }








}
?>
