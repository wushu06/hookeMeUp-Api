<?php

use Inc\Base\BaseController;
$control = new BaseController();

use Inc\Data\DisplayData;
$display_data = new DisplayData();

use Inc\Data\InsertProducts;
$insert_product = new InsertProducts();

?>
<?php



if(isset($_POST['insert_all_products'])) {

    $data_array = $display_data->hmu_main_loop();

	$insert_product->insert_all($data_array);
}

if(isset($_POST['update_stock'])) {

$display_data->hmu_stock_level_loop();



}


?>

<?php ?>
<h1><?php echo esc_html( get_admin_page_title() ); ?></h1>


<div class="wrap">
    <?php settings_errors(); ?>
    <?php
    $active_tab = '';
    if( isset( $_GET[ 'tab' ] ) )
        $active_tab = $_GET[ 'tab' ];
    ?>

	<?php


	if( isset( $_GET[ 'delete' ] ) && $_GET[ 'delete' ] =='ba'  ) {


		delete_option('hmu_api_basic');
		$url = admin_url() . '?page=hmu_api_plugin&tab=basic_auth';
		header('Location: ' . $url);
		die();
	}

	?>




    <h2 class="nav-tab-wrapper">
        <a href="?page=hmu_api_plugin&tab=basic_auth" class="nav-tab <?php echo ( $_GET[ 'tab' ] =='basic_auth'  ) ? $_GET[ 'tab' ] :  ''; ?> <?php echo ( $_GET[ 'tab' ] ==''  ) ? $_GET[ 'tab' ] :  ''; ?>">Basic Auth</a>
        <a href="?page=hmu_api_plugin&tab=auth_one" class="nav-tab <?php echo  ( $_GET[ 'tab' ] =='auth_one' ) ? $_GET[ 'tab' ] : ''; ?>">oAuth 1</a>
        <a href="?page=hmu_api_plugin&tab=all_products" class="nav-tab <?php echo  ( $_GET[ 'tab' ] =='all_products' ) ? $_GET[ 'tab' ] : ''; ?>">All Porducts</a>
        <a href="?page=hmu_api_plugin&tab=orders" class="nav-tab <?php echo  ( $_GET[ 'tab' ] =='orders' ) ? $_GET[ 'tab' ] : ''; ?>">Orders</a>
    </h2>



    <div class="container">

        <?php
            if( $active_tab == 'basic_auth' || $active_tab == ''  ):

        ?>


            <form method="post" class="hmu-general-form" action="options.php">
                <?php
                settings_fields( 'hmu_api_dashboard_options_group' );
                do_settings_sections( 'hmu_api_plugin' );
                submit_button( 'Save Settings', 'hmu-btn hmu-primary', 'btnSubmit' );
                ?>

            </form>
                <!-- ==== received data  ===== -->

                <?php

                $option = get_option('hmu_api_basic');
                $url = $option['basic_auth_url'];
                $username = $option["basic_auth_username"];
                $password = $option["basic_auth_password"];

                ?>

                <h2>Basic Auth</h2>

                <hr>
                <form action="" method="post">
                    <input class="hmu-input hmu-success" type="submit" name="update_stock" value="Update Stock">
                </form>

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

                <hr>
                <br/>
                <a class=" hmu-input hmu-delete" href="<?php echo admin_url() ?>?page=hmu_api_plugin&tab=basic_auth&delete=ba">Delete table</a>
            <?php elseif($active_tab == 'auth_one'): ?>
                <form method="post" class="hmu-general-form" action="options.php">
                <?php
                settings_fields( 'hmu_api_dashboard_second_group' );
                do_settings_sections( 'hmu_api_auth_plugin' );
                submit_button( 'Save Settings', 'hmu-btn hmu-primary', 'btnSubmit' );
                ?>

                </form>


                <!-- ==== received data ===== -->

                <?php

                $option = get_option('hmu_api_oauth_one');
                $url = $option['auth_one_url'];
                $ck = $option["auth_one_ck"];
                $cs = $option["auth_one_cs"];
                ?>
                <h2>oAuth 1</h2>
                <table class="widefat fixed" cellspacing="0">

                    <thead>

                    <tr>

                        <th> Website Url</th>
                        <th> CK</th>
                        <th> CS</th>
                    </tr>

                    </thead>
                    <tbody>
                    <tr>
                        <td><?php echo $url; ?></td>
                        <td><?php echo $ck; ?></td>
                        <td><?php echo $cs; ?></td>
                    </tr>
                    </tbody>

                    <tbody>
                    </tbody>

                </table>

            <?php elseif ($active_tab == 'all_products'): ?>
                <h1>All Porducts</h1>
                <p>Link: Products/ALL?DateAdjusted=2018-02-20T00:00:00 </p>
                <form action="" method="post">
                    <input class="hmu-btn hmu-primary" type="submit" name="insert_all_products" value="Insert Products">
                </form>

	            <?php  $display_data->hookeMeUp_display_basic_result(); ?>


	            <?php elseif ($active_tab == 'orders'): ?>
                    <h1>Orders</h1>
                    <?php
	                    $display_data->hmu_display_basic_orders('GO0Qui001');
                    ?>
        <?php endif; ?>



        </div>




    </div><!-- container -->








