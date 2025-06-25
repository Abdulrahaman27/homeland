<?php require '../layouts/header.php';?>
<?php require '../../config/config.php';?>
<?php 
 if(!isset($_SESSION['adminname'])) {
    echo "<script>window.location.href='".ADMIN_URL."admins/login-admins.php'</script>";
  }

$props = $conn->query("SELECT * FROM props");
$props->execute();
$allProps = $props->fetchAll(PDO::FETCH_OBJ);
?>
        <div class="row">
        <div class="col">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title mb-4 d-inline">Properties</h5>
              <a href="<?php echo ADMIN_URL; ?>/properties-admins/create-properties.php" class="btn btn-primary mb-4 text-center float-right">Create Properties</a>

              <table class="table mt-4">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">name</th>
                    <th scope="col">price</th>
                    <th scope="col">home type</th>
                    <th scope="col">delete</th>
                  </tr>
                </thead>
                <tbody>
                  <?php $count = 1;
                   foreach($allProps as $props): ?>
                  <tr>
                    <th scope="row"><?php echo $count++; ?></th>
                    <td><?php echo $props->name ;?></td>
                    <td><?php echo $props->price ;?></td>
                    <td><?php echo $props->home_type ;?></td>
                     <td><a href="<?php echo ADMIN_URL; ?>/properties-admins/delete-properties.php?id=<?php echo $props->id; ?>" class="btn btn-danger  text-center ">delete</a></td>
                  </tr>
                  <?php endforeach; ?>
                </tbody>
              </table> 
            </div>
          </div>
        </div>
      </div>
<?php require '../layouts/footer.php';?>
