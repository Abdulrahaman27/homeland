<?php require "../includes/header.php";?>
<?php require "../config/config.php";?>
<?php 
if(!isset($_SESSION['username'])) {
    echo "<script>window.location.href='".BASE_URL."'</script>";
  }
if(isset($_POST['submit'])){
    $prop_id = $_POST['prop_id'];
    $user_id = $_POST['user_id'];

    $insert = $conn->prepare("INSERT INTO favorites (prop_id, user_id) VALUES (:prop_id, :user_id)");
      $insert->execute([
        ':prop_id' => $prop_id,
        ':user_id' => $user_id,
      ]);
        echo "<script>window.location.href='".BASE_URL."/property-details.php?id=$prop_id'</script>";
}else {
          echo "<script>window.location.href='".BASE_URL."/404.php'</script>";
}
