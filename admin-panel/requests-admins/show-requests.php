<?php require '../layouts/header.php';?>
<?php require '../../config/config.php';?>
<?php 
 if(!isset($_SESSION['adminname'])) {
    echo "<script>window.location.href='".ADMIN_URL."admins/login-admins.php'</script>";
  }

  $requests = $conn->query("SELECT * FROM requests WHERE author='$_SESSION[adminname]'");
  $requests->execute();
  $allRequests = $requests->fetchAll(PDO::FETCH_OBJ);
?>

          <div class="row">
        <div class="col">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title mb-4 d-inline">Requests</h5>
            
              <table class="table mt-3">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">name</th>
                    <th scope="col">email</th>
                    <th scope="col">phone</th>
                    <th scope="col">go to this property</th>
                  </tr>
                </thead>
                <tbody>
                  <?php if(count($allRequests) > 0): ?>
                  <?php $count = 1;
                  foreach($allRequests as $request): ?>
                  <tr>
                    <th scope="row"><?php echo $count++; ?></th>
                    <td><?php echo $request->name ?></td>
                    <td><?php echo $request->email ?></td>
                    <td><?php echo $request->phone ?></td>
                     <td><a href="<?php echo BASE_URL; ?>/property-details.php?id=<?php echo $request->prop_id; ?>" class="btn btn-success  text-center ">go</a></td>
                  </tr>
                  <?php endforeach;?>
                  <?php else : ?>
                    <div class="bg-success text-white p-2 ">No Requests at the moment.</div>
                    <?php endif; ?>
                </tbody>
              </table> 
            </div>
          </div>
        </div>
      </div>
<?php require '../layouts/footer.php';?>



