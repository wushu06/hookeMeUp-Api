<h1><?php echo esc_html( get_admin_page_title() ); ?></h1>

<h2>Plugin's Panel Control</h2>


<form method="post" class="hmu-general-form" action="options.php">
<?php
    settings_fields( 'hmu_api_dashboard_options_group' );
    do_settings_sections( 'hmu_api_plugin' );
    submit_button( 'Save Settings', 'hmu-btn hmu-primary', 'btnSubmit' );
?>

</form>
<?php

$option = get_option('hmu_api_dashboard');
$url = $option['basic_auth_url'];
$username = $option["basic_auth_username"];
$password = $option["basic_auth_password"];
?>
<table class="widefat fixed" cellspacing="0">

    <thead>

    <tr>

        <th> Website Url</th>
        <th> Username</th>
        <th> Password</th>
     </tr>

    </thead>
    <tbody>
    <tr>
        <td><?php echo $url; ?></td>
        <td><?php echo $username; ?></td>
        <td><input id="hmuInput" type="password" value="<?php echo $password; ?>" disabled><i class="fas fa-eye"></i></td>
    </tr>
    </tbody>

    <tbody>
    </tbody>

</table>


<!-- ================ Bsic Oauth showing data ================= -->
<?php

function hookeMeUp_display_basic_result(){


    $option = get_option('hmu_api_dashboard');
    $url = $option['basic_auth_url'];
    $user = $option["basic_auth_username"];
    $pass = $option["basic_auth_password"];




        echo $show = 'website: '.$url.' ck: '.$user.' cs: '.$pass;
        $data = array($url, $user, $pass);

        $wp_request_headers = array(
            'Authorization' => 'Basic ' . base64_encode( $user.':'.$pass )
        );

        $wp_request_url = $url;

        $wp_get_post_response = wp_remote_request(
            $wp_request_url,
            array(
                'method'    => 'GET',
                'headers'   => $wp_request_headers
            )
        );

        echo wp_remote_retrieve_response_code( $wp_get_post_response ) . ' ' . wp_remote_retrieve_response_message( $wp_get_post_response );
        echo '<pre>';
        print_r($wp_get_post_response);
        echo '</pre>';



}

