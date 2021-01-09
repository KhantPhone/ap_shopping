	<?php 
			require_once 'header.php';
	 ?>
	 <?php 
	 		require_once 'config/config.php';	 		
	 		$stmt = $pdo->prepare("SELECT * FROM products WHERE id = " . $_GET['id']);
	 		$stmt -> execute();
	 		$result =  $stmt->fetch(PDO::FETCH_ASSOC);
	 		
	  ?>

 <!--================Single Product Area =================-->
	<div class="product_image_area">
		<div class="container">
			<div class="row s_product_inner">
				<div class="col-lg-6">
					<div class="single-prd-item">
							<img class="img-fluid" src="admin/images/<?php echo escape($result['image']) ?>" alt="" width = "100%">
					</div>
				</div>
				<div class="col-lg-5 offset-lg-1">
					<div class="s_product_text">
						<h3><?php echo escape($result['name']) ?></h3>
						<h2><?php echo escape($result['price']) ?></h2>
						<ul class="list">							
							<li><a href="#"><span>Availibility</span> : In Stock</a></li>
						</ul>
						<p><?php echo escape($result['description']) ?></p>
						<form action="addtocart.php" method="post">
							<input type="hidden" name="_token" value="<?php echo $_SESSION['_token'];?>">
							<input type="hidden" name="id" value="<?php echo escape($result['id']) ?>">
							<div class="product_count">
							<label for="qty">Quantity:</label>
							<input type="text" name="qty" id="sst" maxlength="12" value="1" title="Quantity:" class="input-text qty">
							<button onclick="var result = document.getElementById('sst'); var sst = result.value; if( !isNaN( sst )) result.value++;return false;"
							 class="increase items-count" type="button"><i class="lnr lnr-chevron-up"></i></button>
							<button onclick="var result = document.getElementById('sst'); var sst = result.value; if( !isNaN( sst ) &amp;&amp; sst > 0 ) result.value--;return false;"
							 class="reduced items-count" type="button"><i class="lnr lnr-chevron-down"></i></button>
							</div>
							<div class="card_area d-flex align-items-center mb-5">
								<button class="primary-btn border-0" type = "submit" href="#">Add to Cart</button> 											
							</div>
						</form>
						<a href="index.php">
							<button class="primary-btn border-0">Back</button> 
						</a>						
					</div>
				</div>
			</div>
		</div>
	</div>
	<!--================End Single Product Area =================-->	
<?php 
		require_once 'footer.php';
?>