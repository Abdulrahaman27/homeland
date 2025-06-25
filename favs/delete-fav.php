<?php require "../includes/header.php";?>
<?php require "../config/config.php";?>
<?php 
if(!isset($_SESSION['username'])) {
    echo "<script>window.location.href='".BASE_URL."'</script>";
  }
if(isset($_GET['prop_id']) AND isset($_GET['user_id'])){
    $prop_id = $_GET['prop_id'];
    $user_id = $_GET['user_id'];

    $delete = $conn->query("DELETE FROM favorites WHERE prop_id='$prop_id' AND user_id='$user_id'");
    $delete->execute();
        echo "<script>window.location.href='".BASE_URL."/property-details.php?id=$prop_id'</script>";
}else {
          echo "<script>window.location.href='".BASE_URL."/404.php'</script>";
}
