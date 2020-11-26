<?php 
  require_once '../config/config.php';
  require_once '../config/common.php';
 
  if (empty($_SESSION['user_id']) && empty($_SESSION['logged_in'])) {
    header('Location:login.php');
  }
  if ($_SESSION['role'] = 0) {
   
    header('Location:login.php');
  }

 ?>
 <?php 
     require_once 'header.php';
  ?>

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
        <div class="row">
          
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Order Listings</h3>
                
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <?php 
                  if (!empty($_GET['pageno'])) {
                   $pageno = $_GET['pageno'];
                  }else{
                    $pageno = 1 ;
                  }
                  $numofrecs = 5;
                  $offset = ($pageno -1 ) * $numofrecs ;


                  $stmt = $pdo->prepare("SELECT * FROM sale_orders_details WHERE sale_orders_id = " . $_GET['id']);
                  $stmt->execute();
                  $rawResult = $stmt->fetchAll();

                  $total_pages = ceil(count($rawResult) / $numofrecs);

                 
                  $stmt = $pdo->prepare("SELECT * FROM sale_orders_details WHERE sale_orders_id = " . $_GET['id'] . " ORDER BY id DESC LIMIT $offset,$numofrecs ");
                  $stmt->execute();
                  $result = $stmt->fetchAll();

                 
                 ?>
                 
                
                
                <table class="table table-bordered">
                  <thead>                  
                    <tr>
                      <th style="width: 10px">#</th>
                      <th>Product</th>
                      <th>Quantity</th>
                      <th>Order Date</th>
                      
                    </tr>
                  </thead>
                  <tbody>
                    <?php 
                        if ($result) {
                          $i = 1;
                          foreach ($result as $value) { ?>
                            <?php 
                        $pstmt = $pdo->prepare("SELECT * FROM products WHERE id = " . $value['product_id']);
                        $pstmt->execute();
                        $presult = $pstmt->fetchAll();

                        ?>
                      <tr>
                      <td>
                        <?php echo $i; ?>
                      </td>
                      <td>
                        <?php foreach ($presult as $pvalue) { ?>
                          <?php echo $pvalue['name']; ?>
                        <?php } ?>
                        
                      </td>
                      <td>
                        <?php echo escape($value['quantity']) ?>
                      </td>
                      <td>
                        <?php echo $value['order_date']; ?>
                      </td>
                    </tr>                   
                                           
                      <?php
                      $i++;
                    }
                        }
                     ?>
                    
                  </tbody>
                </table>
                <a href="order_list.php">                  
                <button class="btn btn-danger btn-block mt-4">Back</button>
                </a>
              </div>
              <!-- /.card-body -->
              <nav>
                <ul class="pagination d-flex justify-content-end mr-3">
                  <li class="page-item"><a class="page-link" href="?pageno=1">First</a></li>
                  <li class="page-item <?php if($pageno <= 1 ){ echo 'disabled' ;} ?>" >
                    <a class="page-link" href="<?php if($pageno <= 1 ){echo '#';}else{echo "?pageno = ".
                    ($pageno-1);} ?>">Previous</a></li>
                  <li class="page-item"><a class="page-link" href="#"><?php echo $pageno; ?></a></li>
                  <li class="page-item <?php if($pageno >= $total_pages ){ echo 'disabled' ;} ?>">
                    <a class="page-link" href="<?php if($pageno >= $total_pages ){echo '#';}
                    else{echo "?pageno=".($pageno+1);} ?>">Next</a>
                  </li>
                  <li class="page-item"><a class="page-link" href="?pageno=<?php echo $total_pages ?>">Last</a></li>
                </ul>
              </nav>           
            </div>
            <!-- /.card -->

           
            <!-- /.card -->
          </div>
          
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  <?php 
     require_once 'footer.html';
   ?>