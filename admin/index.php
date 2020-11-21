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
                <h3 class="card-title">Bordered Table</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                 
                <a href="add.php" class="btn btn-success mb-3">New Blog Post</a>
                
                <table class="table table-bordered">
                  <thead>                  
                    <tr>
                      <th style="width: 10px">#</th>
                      <th>Title</th>
                      <th>Description</th>
                      <th style="width: 40px">Actions</th>
                    </tr>
                  </thead>
                  <tbody>
                    
                    
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
              
             
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
