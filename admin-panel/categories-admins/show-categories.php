<?php require '../layouts/header.php';?>
<?php require '../../config/config.php';?>
<?php 
 if(!isset($_SESSION['adminname'])) {
    echo "<script>window.location.href='".ADMIN_URL."admins/login-admins.php'</script>";
  }
  
$categories = $conn->query("SELECT * FROM categories");
$categories->execute();
$allCategories = $categories->fetchAll(PDO::FETCH_OBJ);
  
?>
          <div class="row">
        <div class="col">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title mb-4 d-inline">Categories</h5>
              <a href="<?php echo ADMIN_URL; ?>/categories-admins/create-category.php" class="btn btn-primary mb-4 text-center float-right">Create Categories</a>
              <table class="table">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">name</th>
                    <th scope="col">update</th>
                    <th scope="col">delete</th>
                  </tr>
                </thead>
                <tbody>
                  <?php $count = 1 ; foreach($allCategories as $category): ?>
                  <tr>
                    <th scope="row"><?php echo $count++; ?></th>
                    <td><?php echo $category->name ?></td>
                    <td><a href="<?php echo ADMIN_URL;?>/categories-admins/update-category.php?id=<?php echo $category->id;?>" class="btn btn-warning text-white text-center ">Update </a></td>
                    <td><a href="<?php echo ADMIN_URL;?>/categories-admins/delete-category.php?id=<?php echo $category->id;?>" class="btn btn-danger  text-center ">Delete </a></td>
                  </tr>
                  <?php endforeach; ?>
                </tbody>
              </table> 
            </div>
          </div>
        </div>
      </div>


<?php require '../layouts/footer.php';?>
