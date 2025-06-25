<?php require "../includes/header.php"; ?>
<?php require "../config/config.php"; ?>

<?php 
if (isset($_POST['submit'])) {

    $errors = [];

    if (empty($_POST["name"])) {
        $errors[] = "Name cannot be empty";
    }

    if (empty($_POST["email"])) {
        $errors[] = "Email cannot be empty";
    }

    if (empty($_POST["phone"])) {
        $errors[] = "Phone number cannot be empty";
    }

    if (!empty($errors)) {
        foreach ($errors as $error) {
            echo "<script>alert('$error');</script>";
        $prop_id = $_POST['prop_id'];
        echo "<script>window.location.href='".BASE_URL."/property-details.php?id=$prop_id'</script>";
        }
    } else {
        $name = $_POST['name'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $prop_id = $_POST['prop_id'];
        $user_id = $_POST['user_id'];
        $author = $_POST['admin_name'];

        $insert = $conn->prepare("INSERT INTO requests (name, email, phone, prop_id, user_id, author) VALUES (:name, :email, :phone, :prop_id, :user_id, :author)");
        $insert->execute([
            ':name' => $name,
            ':email' => $email,
            ':phone' => $phone,
            ':prop_id' => $prop_id,
            ':user_id' => $user_id,
            ':author' => $author,
        ]);

        echo "<script>alert('Request sent successfully');</script>";
        
        echo "<script>window.location.href='".BASE_URL."/property-details.php?id=$prop_id'</script>";
    }
}
?>
