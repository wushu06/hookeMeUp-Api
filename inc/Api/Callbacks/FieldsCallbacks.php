<?php 

namespace Inc\Api\Callbacks; 

use \Inc\Base\BaseController;

use \Inc\Api\SettingsApi;

class FieldsCallbacks extends BaseController {

    public $cron_name;

    public function sanitizeCallback( $input )
    {
        $output = array();


        if(isset($_POST['btnSubmit'])):

            $output = get_option('hmu_api_dashboard');

            if (empty($output)) {
                $output['1'] = $input;

            } else {

                foreach ($output as $key => $value) {
                    $count = count($output);
                    if ($key < $count) {
                        $output[$key] = $value;

                    } else {
                        $output[$key + 1] = $input;

                    }


                }
            }

        endif;


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

    function hmu_api_auth_1_url($args)
    {
        $name = $args['label_for'];
        $classes = $args['class'];
        $option_name = $args['option_name'];
        $value =  get_option( $option_name );
        $isvalue = isset($value[$name]) ? $value[$name]  : '';
        $this->cron_name = $isvalue;

        echo '<input type="text" class="regular-text hmu-input" name="'. $option_name.'['.$name.']"  value="' . $isvalue . '"  placeholder="Url">';
    }

    function hmu_api_auth_1_ck($args)
    {
        $name = $args['label_for'];
        $classes = $args['class'];
        $option_name = $args['option_name'];
        $value =  get_option( $option_name );
        $isvalue = isset($value[$name]) ? $value[$name]  : '';
        $this->cron_name = $isvalue;

        echo '<input type="text" class="regular-text hmu-input" name="'. $option_name.'['.$name.']"  value="' . $isvalue . '"  placeholder="CK">';
    }

    function hmu_api_auth_1_cs($args)
    {
        $name = $args['label_for'];
        $classes = $args['class'];
        $option_name = $args['option_name'];
        $value =  get_option( $option_name );
        $isvalue = isset($value[$name]) ? $value[$name]  : '';
        $this->cron_name = $isvalue;

        echo '<input type="text" class="regular-text hmu-input" name="'. $option_name.'['.$name.']"  value="' . $isvalue . '"  placeholder="CS">';
    }







}
?>
