<?php

use Inc\Base\BaseController;

$control = new BaseController();
?>
<?php

//$post_id = 3729;
$post_id = 1830;

$repeater_value = get_post_meta($post_id, 'price_table', true);

if ($repeater_value) {
	for ($i=0; $i<$repeater_value;$i++) {

		 $meta_key = 'price_table_'.$i.'_row_title';
		 $sub_field_value = get_post_meta($post_id, $meta_key, true);
		 update_field($meta_key, $sub_field_value , 2064);

	}
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




    <h2 class="nav-tab-wrapper">
        <a href="?page=hmu_api_plugin&tab=basic_auth" class="nav-tab <?php echo ( $_GET[ 'tab' ] =='basic_auth'  ) ? $_GET[ 'tab' ] :  ''; ?> <?php echo ( $_GET[ 'tab' ] ==''  ) ? $_GET[ 'tab' ] :  ''; ?>">Basic Auth</a>
        <a href="?page=hmu_api_plugin&tab=auth_one" class="nav-tab <?php echo  ( $_GET[ 'tab' ] =='auth_one' ) ? $_GET[ 'tab' ] : ''; ?>">oAuth 1</a>
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
	            <?php  //hookeMeUp_display_basic_result(); ?>
            <?php else: if($active_tab == 'auth_one') ?>
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

        <?php endif; ?>



        </div>




    </div><!-- container -->



<!-- ================ Bsic Oauth showing data ================= -->
<?php

function hookeMeUp_display_basic_result(){


    $option = get_option('hmu_api_basic');
    $url = $option['basic_auth_url'];
    $user = $option["basic_auth_username"];
    $pass = $option["basic_auth_password"];




     //   echo $show = 'website: '.$url.' ck: '.$user.' cs: '.$pass;
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

	// echo wp_remote_retrieve_response_code( $wp_get_post_response ) . ' ' . wp_remote_retrieve_response_message( $wp_get_post_response );
	$res = json_decode($wp_get_post_response['body']);



	// print_r( json_decode($wp_get_post_response['body']) );
	?>
    <table class="widefat fixed" cellspacing="0">

        <thead>

        <tr>
            <th> Count</th>
            <th> ID</th>
            <th> Product name</th>
            <th> brand</th>
            <th> price</th>
            <th> Description</th>
            <th> Attribute one</th>
            <th> Attribute two</th>
            <th> Attribute three</th>
           <!-- <th> Code</th>-->
            <th> Subgroup</th>
            <th> Web sale price</th>
            <th> Web product</th>
            <th> Current product</th>
            <th>Date adj online</th>
            <th> Style Number</th>
        </tr>

        </thead>
        <tbody>
		<?php
        $i = 1;
		foreach ($res as $r ) {


			$stdInstance   = json_decode(json_encode($r),true);
			//
			$name = $stdInstance["ProductName"];
			$price = $stdInstance["SalesPrice"];
			$desc = $stdInstance["ProductName"];
			$attr1 = $stdInstance["Attrib1"];
			$attr2 = $stdInstance["Attrib2"];
			$attr3 = $stdInstance["Attrib3"];
		//	$code = $stdInstance["ShopCode"];
			$subgroup = $stdInstance["SubGroup"];
			$Brand = $stdInstance["Brand"];
			$ID = $stdInstance["ProductID"];
			$webSalesPrice = $stdInstance["WebSalesPrice"];
			$webproduct = $stdInstance["WebProduct"];
			$CurrentProduct = $stdInstance['CurrentProduct'];
			$DateAdjustedOnlineStock = $stdInstance['DateAdjustedOnlineStock'];
			$StyleNumber = $stdInstance['StyleNumber'];
			?>

            <tr>
                <td><?php echo $i; ?></td>
                <td><?php echo $ID ; ?></td>
                <td><?php echo $name ; ?></td>
                <td><?php echo $Brand; ?></td>
                <td><?php echo $price; ?></td>
                <td><?php echo $desc; ?></td>
                <td><?php echo $attr1; ?></td>
                <td><?php echo $attr2; ?></td>
                <td><?php echo $attr3; ?></td>
               <!-- <td><?php /*//echo $code; */?></td>-->
                <td><?php echo $subgroup; ?></td>
                <td><?php echo $webSalesPrice; ?></td>
                <td><?php echo $webproduct; ?></td>
                <td><?php echo $CurrentProduct; ?></td>
                <td><?php echo $DateAdjustedOnlineStock; ?></td>
                <td><?php echo $StyleNumber; ?></td>
            </tr>





		<?php $i++; } ?>
        </tbody>



    </table>
	<?php




}


//var_dump(hookeMeUp_select_website_data());
if(isset($_SESSION['result'])){
        $result = $_SESSION['result'];

    ?>



  <main class="main-area">

  <table class="widefat fixed" cellspacing="0">
        <tr>

            <th>Link</th>
            <th>Product Name</th>
            <th>Price</th>
            <th>Image</th>
       </tr>
      <?php


      //var_dump($result);
    if($result = $_SESSION['result']){

        $result=json_decode(json_encode($result),true);
      foreach ($result as  $value ){
        $id =  $value['id'];
        $name =  $value['name'];
        $price =  $value['price'];
        $srcs = $value['images'];
        foreach ($srcs as $src){
            $image = $src['src'];
        }

    ?>
        <tr>
    <td>
      <a href="single.php?id=<?php echo $id; ?>">Link</a></td>
      <td><h6><?php echo $name; ?></h6></td>
      <td><p><?php echo (!empty($price)? '£'.$price : 'No Price');  ?></td>
      <td><img src="<?php echo $image; ?>" alt="" width="100px" height="100px"></td>


      </tr>
  <?php  } }  ?>



                  </table>

  </main><!-- .main-area -->

  <?php

}




