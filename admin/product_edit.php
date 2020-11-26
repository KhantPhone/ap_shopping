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
                   echo "1 ";exit();

        }
        if (empty($_POST['description'])) {
           $descError = "Description cannot be empty!";
                              echo "2 ";exit();

        }
        if (empty($_POST['category'])) {
           $catError = "Category cannot be empty!";
                              echo "3 ";exit();

        }
        if (empty($_POST['quantity'])) {
           $qtyError = "Quantity cannot be empty!";
                              echo "4 ";exit();

        }       
          elseif ($_POST['quantity'] && (is_numeric($_POST['quantity']) != 1)){
           $qtyError = "Qunatity should be integer!";       
                              echo "5 ";exit();
   
        }
        if (empty($_POST['price'])) {
           $priceError = "Price cannot be empty!";
                              echo "6 ";exit();

        }        
          elseif ($_POST['price'] && (is_numeric($_POST['price']) != 1)){
           $qtyError = "Price should be integer!";  
                              echo "7 ";exit();
         
        }
        if (empty($_FILES['image'])) {
           $imageError = "Image cannot be empty!";
                              echo "8 ";exit();

        }
       }   
       else{
        //validation success
        if ($_FILES['image']['name'] != null) {
          $file = 'images/'.($_FILES['image']['name']);
          $imageType = pathinfo($file,PATHINFO_EXTENSION);

          if ($imageType !== 'jpg' && $imageType !== 'jpeg' && $imageType = 'png') {
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
            $id = $_POST['id'];
            move_uploaded_file($_FILES['image']['tmp_name'], $file);

            $stmt = $pdo ->prepare("UPDATE products SET name = :name , description = :description,
                                    category_id = :category,quantity = :quantity ,price = :price,
                                    image = :image WHERE id = '$id' " );
            $result = $stmt->execute(
                        array(
                        ':name' => $name , ':description' => $description , ':category' => $category,
                        ':quantity' => $quantity , ':price' => $price , ':image' => $image )              
                        ); 
                      
            if (!empty($result)) {      
              echo "<script>alert('Category has been Updated!');window.location.href='index.php';</script>";
           }
        }
        }
        else
        {         
          $name = $_POST['name'];
          $description = $_POST['description'];
          $category = $_POST['category'];
          $quantity = $_POST['quantity'];
          $price = $_POST['price']; 
          $id = $_POST['id'];

          $stmt = $pdo ->prepare("UPDATE products SET name = :name , description = :description,
                                  category_id = :category,quantity = :quantity ,price = :price WHERE  
                                   id  =  '$id' "  );
            $result = $stmt->execute(
                        array(
                        ':name' => $name , ':description' => $description , ':category' => $category,
                        ':quantity' => $quantity , ':price' => $price )                 
                        ); 
            
         
          if (!empty($result)) {      
            echo "<script>alert('Category has been upadted!');window.location.href='index.php';</script>";
           }
        }
        }
       
    }

     $stmt = $pdo -> prepare("SELECT * FROM products WHERE id = " . $_GET['id']);
     $stmt -> execute();
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
                <form action="product_edit.php?id=<?php echo escape($result[0]['id'])?>" method="post" enctype="multipart/form-data">
                  <div class="form-group">
                     <input type="hidden" name="_token" value="<?php echo $_SESSION['_token'] ?>">
                     <input type="hidden" name="id" value="<?php echo escape($result[0]['id'])?>">
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
                            <?php if($value['id'] == $result[0]['category_id']) : ?>
                              <option value="<?php echo escape($value['id']); ?>" selected><?php echo escape($value['name']); ?>                                
                              </option> 
                              <?php else : ?>
                              <option value="<?php echo escape($value['id']); ?>" ><?php echo escape($value['name']); ?>                                
                              </option> 
                              <?php endif  ?>                        
                        <?php  
                         }
                        ?>
                     </select>                     
                     <p class="text-danger mt-3 font-weight-bold"><?php echo empty($catError) ? '' : $catError; ?>                     
                     </p>
                  </div>
                  <div class="form-group">                   
                     <label for="quantity">Qunatity</label>
                     <input type="number" class="form-control " name="quantity" id="quantity" 
                       value="<?php echo escape($result[0]['quantity'])?>">
                     <p class="text-danger mt-3 font-weight-bold"><?php echo empty($qtyError) ? '' : $qtyError; ?></p>
                  </div>  
                  <div class="form-group">                   
                     <label for="price">Price</label>
                     <input type="number" class="form-control " name="price" id="price" 
                     value="<?php echo escape($result[0]['price'])?>">
                     <p class="text-danger mt-3 font-weight-bold"><?php echo empty($priceError) ? '' : $priceError; ?></p>
                  </div> 
                  <div class="form-group ">                   
                     <label for="image">Image</label>
                     <input type="file"  name="image" id="image">
                     <img src="images/<?php echo escape($result[0]['image'])?>" alt="" width="150" height="150" class="d-block mt-3">
                     <p class="text-danger mt-3 font-weight-bold"><?php echo empty($imageError) ? '' : $imageError; ?></p>
                  </div>                  
                  <div class="form-group d-flex justify-content-end">
                    <input type="submit" value="SUBMIT" name ="submit" class="btn btn-success mr-3">
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
