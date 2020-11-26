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
        $id = $_POST['id'];

        $stmt = $pdo->prepare("UPDATE categories SET name = :name , description = :description  WHERE id = '$id' " );
        $result = $stmt->execute(
          array(':name' => $name,':description' => $description)
        );
         print_r($result);  
         exit();  
      }
      if (!empty($result)) {
       

        echo "<script>alert('Category has been upadated!');window.location.href='index.php';</script>";
      }
  } 

 
  $stmt = $pdo -> prepare("SELECT * FROM categories WHERE id = " . $_GET['id']);
  $stmt->execute();
  $result = $stmt->fetchAll();
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
                <form action="cat_edit.php" method="post" enctype="multipart/form-data">
                  <div class="form-group">
                    <input type="hidden" name="_token" value="<?php echo $_SESSION['_token'] ?>">
                    <input type="hidden" name="id" value="<?php echo escape($result[0]['id']) ?>">
                     <label for="name">Name</label>
                     <input type="text" class="form-control " name="name" id="title" value="<?php echo escape($result[0]['name'])?>">

                     <p class="text-danger mt-3 font-weight-bold"><?php echo empty($nameError) ? '' : $nameError; ?></p>
                  </div>
                  <div class="form-group">
                     <label for="description">Description</label>
                     <textarea name="description" id="content" class="form-control" cols="30" rows="10">
                       <?php echo escape($result[0]['description'])?>
                     </textarea>
                     <p class="text-danger mt-3 font-weight-bold"><?php echo empty($descError) ? '' : $descError; ?>
                       
                     </p>
                  </div>                  
                  <div class="form-group d-flex justify-content-end">
                    <input type="submit" value="SUBMIT" class="btn btn-success mr-3">
                    <a href="index.php" class="btn btn-danger">Back</a>
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
