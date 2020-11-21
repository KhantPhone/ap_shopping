<?php 

  require_once '../config/config.php';
  require_once '../config/common.php';
 
  if (empty($_SESSION['user_id']) && empty($_SESSION['logged_in'])) {
    header('Location:login.php');
  }
  if ($_SESSION['role'] = 0 ) {
   
    header('Location:login.php');
  }
  if ($_POST) {
      if (empty($_POST['name']) || empty($_POST['description'])) {
        if (empty($_POST['name'])) {
           $nameError =  "Category name cannot be empty!";
        }
        if (empty($_POST['description'])) {
           $descError = "Description cannot be empty!";
        }
      }
      else{
        $name = $_POST['name'];
        $description = $_POST['description'];

        $stmt = $pdo->prepare("INSERT INTO categories (name,description) VALUES (:name,:description)");
        $result = $stmt->execute(
          array(':name' => $name,':description' => $description)
        );
      }
      if (!empty($result)) {
       

        echo "<script>alert('Category has been added!');window.location.href='index.php';</script>";
      }
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
              <div class="card-body">
                <form action="cat_add.php" method="post" enctype="multipart/form-data">
                  <div class="form-group">
                    <input type="hidden" name="_token" value="<?php echo $_SESSION['_token'] ?>">
                     <label for="name">Name</label>
                     <input type="text" class="form-control " name="name" id="title">

                     <p class="text-danger mt-3 font-weight-bold"><?php echo empty($nameError) ? '' : $nameError; ?></p>
                  </div>
                  <div class="form-group">
                     <label for="description">Description</label>
                     <textarea name="description" id="content" class="form-control" cols="30" rows="10"></textarea>
                     <p class="text-danger mt-3 font-weight-bold"><?php echo empty($descError) ? '' : $descError; ?>
                       
                     </p>
                  </div>                  
                  <div class="form-group d-flex justify-content-end">
                    <input type="submit" value="SUBMIT" class="btn btn-success mr-3">
                    <a href="category.php" class="btn btn-danger">Back</a>
                  </div>
                </form>
              </div>
            </div>
          </div>
          
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  <?php 
     require_once 'footer.html';
   ?>
