	<?php 
 	    require_once 'config/common.php';
		require_once 'config/config.php'; 		       	 
		require_once 'header.php';

 	?>
 		    <?php 

 		        if (session_status() == PHP_SESSION_NONE) {
 		        	session_start();
 		        }
 		         
                  if (!empty($_GET['pageno'])) {
                   $pageno = $_GET['pageno'];
                  }else{
                    $pageno = 1 ;
                  }	
                  $numofrecs = 6;
                  $offset = ($pageno -1 ) * $numofrecs ;
                 

                 if (empty($_POST['search'])) {
                  $stmt = $pdo->prepare("SELECT * FROM products ORDER BY id DESC");
                  $stmt->execute();
                  $rawResult = $stmt->fetchAll();
                  $total_pages = ceil(count($rawResult) / $numofrecs);

                 
                  $stmt = $pdo->prepare("SELECT * FROM products  ORDER BY id DESC LIMIT $offset,$numofrecs ");
                  $stmt->execute();
                  $result = $stmt->fetchAll();
                 }else{
                  $searchKey = $_POST['search'];
                  $stmt = $pdo->prepare("SELECT * FROM products WHERE name LIKE '%$searchKey%' ORDER BY id DESC");
                  $stmt->execute();
                  $rawResult = $stmt->fetchAll();                 
                  $total_pages = ceil(count($rawResult) / $numofrecs); 

                  $stmt = $pdo->prepare("SELECT * FROM products WHERE name LIKE '%$searchKey%' ORDER BY id DESC LIMIT $offset,$numofrecs ");
                  $stmt->execute();
                  $result = $stmt->fetchAll();
                 }

                 ?>

		<div class="container">
			<div class="row">
				<div class="col-xl-3 col-lg-4 col-md-5">
					<div class="sidebar-categories">
						<div class="head">Browse Categories</div>
						<ul class="main-categories">
							<li class="main-nav-list">
								<?php 
									$catstmt = $pdo -> prepare("SELECT * FROM categories ORDER BY ID DESC");
									$catstmt -> execute();
									$catresult = $catstmt -> fetchAll();
								 ?>
								 <?php 
								 	foreach ($catresult  as $catvalue) { ?>
								    <a data-toggle="collapse" href="#" aria-expanded="false" aria-controls="fruitsVegetable">
							        <span class="lnr lnr-arrow-right"></span><?php echo escape($catvalue['name']) ?></a>
								 <?php		
								 	}
								  ?>
								
							</li>						
						</ul>
					</div>				
				</div>
			<div class="col-xl-9 col-lg-8 col-md-7">
 				<div class="filter-bar  d-flex flex-wrap align-items-center">
					<div class="pagination">
					<a href="?pageno=1" class="active">First</a>
					<a <?php if($pageno <= 1 ){ echo 'disabled' ;} ?> href="<?php if($pageno <= 1 ){echo '#';}else{echo "?pageno = ".
                    	($pageno-1);} ?>" class="prev-arrow"><i class="fa fa-long-arrow-left"></i>
                    	</a>
						<a href="#" class="active"><?php echo $pageno; ?>							
						</a>
						<a <?php if($pageno >= $total_pages ){ echo 'disabled' ;} ?> href="<?php if($pageno >= $total_pages ){echo '#';}
			              else{echo "?pageno=".($pageno+1);} ?>" class="next-arrow"><i class="fa fa-long-arrow-right"></i></a>
			                 <a href="?pageno=<?php echo $total_pages ?>" class="active">Last</a>
						</div>
				   </div>
				<!-- End Filter Bar -->
				<!-- Start Best Seller -->
				<section class="lattest-product-area pb-40 category-list">
					<div class="row">
						<!-- single product -->
						<?php 
							if ($result) {
								foreach ($result as $key => $value) {  ?>
							<div class="col-lg-4 col-md-6 col-sm-12">
								<div class="single-product">
								<img class="img-fluid" src="admin/images/<?php echo
								escape($value['image']) ?>" alt="" style="height: 35vh;">
								<div class="product-details ">
									<h6><?php echo escape($value['name']) ?></h6>
									<div class="price">
										<h6><?php echo escape($value['price']) ?></h6>
										
									</div>
									<div class="prd-bottom">
										<a href="" class="social-info">
											<span class="ti-bag"></span>
											<p class="hover-text">add to bag</p>
										</a>										
										<a href="" class="social-info">
											<span class="lnr lnr-move"></span>
											<p class="hover-text">view more</p>
										</a>
									</div>
								</div>
							</div>
						</div>
							<?php	}
							}
						 ?>
						
					</div>
				</section>				
			</div>
		</div>
	</div>
	<?php 
		require_once 'footer.php';
	 ?>