<?php require '../layouts/header.php';?>
<?php require '../../config/config.php';?>
<?php 
 if(!isset($_SESSION['adminname'])) {
    echo "<script>window.location.href='".ADMIN_URL."admins/login-admins.php'</script>";
  }

  if(isset($_POST["submit"])) {
    if(empty($_POST["adminname"]))  {
        echo "<script>alert('Admin name cannot be empty');</script>";
    }else if(empty($_POST["email"])) {
        echo "<script>alert('Email cannot be empty');</script>";
    }else if(empty($_POST["password"])) {
        echo "<script>alert('Password cannot be empty');</script>";
    }else {
      $adminname = $_POST['adminname'];
      $email = $_POST['email'];
      $password = $_POST['password'];

      $insert = $conn->prepare("INSERT INTO admins (adminname, email, password) VALUES (:adminname, :email, :password)");
      $insert->execute([
        ':adminname' => $adminname,
        ':email' => $email,
        ':password' => password_hash($password, PASSWORD_DEFAULT)
      ]);
      echo "<script>window.location.href='".ADMIN_URL."/admins/admins.php'</script>";
    }
}

?>
       <div class="row">
        <div class="col">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title mb-5 d-inline">Create Admins</h5>
          <form method="POST" action="create-admins.php" enctype="multipart/form-data">
                <!-- Email input -->
                <div class="form-outline mb-4 mt-4">
                  <input type="email" name="email" id="form2Example1" class="form-control" placeholder="email" />
                </div>

                <div class="form-outline mb-4">
                  <input type="text" name="adminname" id="form2Example1" class="form-control" placeholder="username" />
                </div>
                <div class="form-outline mb-4">
                  <input type="password" name="password" id="form2Example1" class="form-control" placeholder="password" />
                </div>
                <!-- Submit button -->
                <button type="submit" name="submit" class="btn btn-primary  mb-4 text-center">create</button>

          
              </form>

            </div>
          </div>
        </div>
      </div>
  <?php require '../layouts/footer.php';?>