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

      
      if (empty($_POST['name']) || empty($_POST['description']) || empty($_POST['category'])
          || empty($_POST['quantity']) || empty($_POST['price']) || empty($_FILES['image'])) {

        if (empty($_POST['name'])) {
           $nameError =  "Category name cannot be empty!";
                

        }
        if (empty($_POST['description'])) {
           $descError = "Description cannot be empty!";
                             

        }
        if (empty($_POST['category'])) {
           $catError = "Category cannot be empty!";
                              

        }
        if (empty($_POST['quantity'])) {
           $qtyError = "Quantity cannot be empty!";
                             

        }       
          elseif ($_POST['quantity'] && (is_numeric($_POST['quantity']) != 1)){
           $qtyError = "Qunatity should be integer!";       
                           
   
        }
        if (empty($_POST['price'])) {
           $priceError = "Price cannot be empty!";
                          

        }        
          elseif ($_POST['price'] && (is_numeric($_POST['price']) != 1)){
           $qtyError = "Price should be integer!";  
                              
         
        }
        if (empty($_FILES['image'])) {
           $imageError = "Image cannot be empty!";            

        }
       }   
       else{
        //validation success
        $file = 'images/'.($_FILES['image']['name']);
        $imageType = pathinfo($file,PATHINFO_EXTENSION);

        if ($imageType !='jpg' && $imageType != 'jpeg' && $imageType != 'png') {
          echo "<script>alert('Image should be png or jpg or jpeg');</script>";
        }
        else{
          //image validation success 
          $name = $_POST['name'];
          $description = $_POST['description'];
          $category = $_POST['category'];
          $quantity = $_POST['quantity'];
          $price = $_POST['price'];
          $image = $_FILES['image']['name'];
          move_uploaded_file($_FILES['image']['tmp_name'], $file);

          $stmt = $pdo->prepare("INSERT INTO products(name,description,category_id,quantity,price,image)
                                  VALUES(:name,:description,:category,:quantity,:price,:image)");
          $result = $stmt->execute(
                      array(
                      ':name' => $name , ':description' => $description , ':category' => $category,
                      ':quantity' => $quantity , ':price' => $price , ':image' => $image)                 
                      ); 
          if (!empty($result)) {      
            echo "<script>alert('Category has been added!');window.location.href='index.php';</script>";
           }
        }
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
                <form action="product_add.php" method="post" enctype="multipart/form-data">
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
                  <div class="form-group">
                    <?php 
                      $catstmt = $pdo -> prepare("SELECT * FROM categories");
                      $catstmt ->execute();
                      $catresult = $catstmt->fetchAll();
                     ?>
                     <label for="category">Category</label>
                     <select name="category" id="" class="form-control w-25">
                       <option value="">Select Categories</option>
                       <?php 
                          foreach ($catresult as $value) { ?>
                            <option value="<?php echo escape($value['id']); ?>"><?php echo escape($value['name']); ?></option>                           
                        <?php  
                         }
                        ?>
                     </select>                     
                     <p class="text-danger mt-3 font-weight-bold"><?php echo empty($catError) ? '' : $catError; ?>                     
                     </p>
                  </div>
                  <div class="form-group">                   
                     <label for="quantity">Qunatity</label>
                     <input type="number" class="form-control " name="quantity" id="quantity">
                     <p class="text-danger mt-3 font-weight-bold"><?php echo empty($qtyError) ? '' : $qtyError; ?></p>
                  </div>  
                  <div class="form-group">                   
                     <label for="price">Price</label>
                     <input type="number" class="form-control " name="price" id="price">
                     <p class="text-danger mt-3 font-weight-bold"><?php echo empty($priceError) ? '' : $priceError; ?></p>
                  </div> 
                  <div class="form-group">                   
                     <label for="image" class="d-flex">Image</label>
                     <input type="file"  name="image" id="image">
                     <p class="text-danger mt-3 font-weight-bold"><?php echo empty($imageError) ? '' : $imageError; ?></p>
                  </div>                  
                  <div class="form-group d-flex justify-content-end">
                    <input type="submit" value="SUBMIT" name ="submit" class="btn btn-success mr-3">
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
