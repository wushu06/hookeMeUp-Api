<?php

namespace Inc\Data;

class DisplayData
{
	//Display / get the stock level by product id
	function hmu_display_basic_orders($product_id)
	{
		$option = get_option('hmu_api_basic');
		$url = $option['basic_auth_url'].'StockLevelsByID/ALL?ProductID='.$product_id;
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
		foreach ($res as $r ) {


			$stdInstance = json_decode(json_encode($r), true);
			return $stock_level = $stdInstance["StockLevel"];
		}

	}

	//Display all products
	function hookeMeUp_display_basic_result(){


		$option = get_option('hmu_api_basic');
		$url = $option['basic_auth_url'].'Products/ALL?DateAdjusted=2018-02-20T00:00:00';
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
				<th> STOCK LEVEL</th>
				<th> price</th>
				<th> Description</th>
				<th> Attribute one</th>
				<th> Attribute two</th>
				<th> Attribute three</th>
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
			$pro_arr = array();

			foreach ($res as $r ) {

				$stdInstance   = json_decode(json_encode($r),true);

				if ($i == 100) { break; }




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

				$variation = array();
				$variation [] = array(
					"attributes"  => array(
						'size'=>$attr1,'color'=>$attr2,'attr3'=>$attr3

					),
					"price"=>$price
				);
				$pro_arr[] = array(
					"name" => $name,
					"sku" =>$ID,
					"description" => $desc,
					"categories" => array(
						$subgroup, $Brand
					),
					"available_attributes"=>array(
						'color','size','attr3'
					),
					"variations" => $variation

				);


				echo '<pre>';
				//var_dump($variation);
				echo '</pre>';


				?>

				<tr>
					<td><?php echo $i; ?></td>
					<td><?php echo $ID ; ?></td>
					<td><?php echo $name ; ?></td>
					<td><?php echo $Brand; ?></td>
					<td><?php echo $this->hmu_display_basic_orders($ID); ?></td>
					<td><?php echo $price; ?></td>
					<td><?php echo $desc; ?></td>
					<td><?php echo $attr1; ?></td>
					<td><?php echo $attr2; ?></td>
					<td><?php echo $attr3; ?></td>
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


	function hmu_main_loop()
	{
		$option = get_option('hmu_api_basic');
		$url = $option['basic_auth_url'].'Products/ALL?DateAdjusted=2018-02-20T00:00:00';
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


			$i = 1;
			$pro_arr = array();

			foreach ($res as $r ) {

				$stdInstance   = json_decode(json_encode($r),true);

				if ($i == 50) { break; }




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

				$variation = array();
				$variation [] = array(
					"attributes"  => array(
						'size'=>$attr1,'color'=>$attr2,'attr3'=>$attr3

					),
					"price"=>$price
				);
				$pro_arr[] = array(
					"name" => $name,
					"sku" =>$ID,
					"description" => $desc,
					"categories" => array(
						$subgroup, $Brand
					),
					"available_attributes"=>array(
						'color','size','attr3'
					),
					"variations" => $variation

				);


				echo '<pre>';
				//var_dump($pro_arr);
				echo '</pre>';
			 $i++; }

		return $pro_arr;

	}


	// loop to get the stock level
	function hmu_stock_level_loop()
	{
		$option = get_option('hmu_api_basic');
		$url = $option['basic_auth_url'].'Products/ALL?DateAdjusted=2018-02-20T00:00:00';
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


		$i = 1;
		$level_ID = array();

		foreach ($res as $r ) {

			$stdInstance   = json_decode(json_encode($r),true);

			if ($i == 2) { break; }


			$ID = $stdInstance["ProductID"];
			$level =  $this->hmu_display_basic_orders($ID);



			$this->hmu_insert_stock($ID, $level);




			$i++;
		}



	}

	function hmu_insert_stock($ID, $level)
    {
	    update_post_meta($ID, '_stock', $level);
	    if($level != 0) {
		    update_post_meta($ID, '_stock_status', 'instock');
	    }

    }



	//oauth one display all products
	function hmu_display_oauth_1_products()
	{


	//var_dump(hookeMeUp_select_website_data());
		if (isset($_SESSION['result'])) {
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
					if ($result = $_SESSION['result']) {

						$result = json_decode(json_encode($result), true);
						foreach ($result as $value) {
							$id = $value['id'];
							$name = $value['name'];
							$price = $value['price'];
							$srcs = $value['images'];
							foreach ($srcs as $src) {
								$image = $src['src'];
							}

							?>
							<tr>
								<td>
									<a href="single.php?id=<?php echo $id; ?>">Link</a></td>
								<td><h6><?php echo $name; ?></h6></td>
								<td><p><?php echo(!empty($price) ? '£' . $price : 'No Price'); ?></td>
								<td><img src="<?php echo $image; ?>" alt="" width="100px" height="100px"></td>


							</tr>
						<?php }
					} ?>


				</table>

			</main><!-- .main-area -->

			<?php

		}
	}


}