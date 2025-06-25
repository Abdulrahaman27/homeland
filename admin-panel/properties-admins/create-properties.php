<?php require '../layouts/header.php';?>
<?php require '../../config/config.php';?>
<?php 
 if(!isset($_SESSION['adminname'])) {
    echo "<script>window.location.href='".ADMIN_URL."admins/login-admins.php'</script>";
  }
$id = '';
if(isset($_POST['submit'])) {
    if(empty($_POST["name"]))  {
        echo "<script>alert('Property name cannot be empty');</script>";
    }else if(empty($_POST["location"])) {
        echo "<script>alert('Property location cannot be empty');</script>";
    }else if(empty($_POST["price"])) {
        echo "<script>alert('Price cannot be empty');</script>";
    }else if(empty($_POST["beds"])) {
        echo "<script>alert('Beds cannot be empty');</script>";
    }else if(empty($_POST["baths"])) {
        echo "<script>alert('Baths cannot be empty');</script>";
    }else if(empty($_POST["sq_ft"])) {
        echo "<script>alert('sq ft cannot be empty');</script>";
    }else if(empty($_POST["year_built"])) {
        echo "<script>alert('Year built cannot be empty');</script>";
    }else if(empty($_POST["price"])) {
        echo "<script>alert('Price cannot be empty');</script>";
    }else if(empty($_POST["price_sqft"])) {
        echo "<script>alert('Price per square ft cannot be empty');</script>";
    }else if(empty($_POST["home_type"])) {
        echo "<script>alert('Home type cannot be empty');</script>";
    }else if(empty($_POST["type"])) {
        echo "<script>alert('Type cannot be empty');</script>";
    }else if(empty($_POST["description"])) {
        echo "<script>alert('Description cannot be empty');</script>";
    }else {


    $name = $_POST['name'];
    $location = $_POST['location'];
    $price = $_POST['price'];
    $beds = $_POST['beds'];
    $baths = $_POST['baths'];
    $sq_ft = $_POST['sq_ft'];
    $year_built = $_POST['year_built'];
    $price_sqft = $_POST['price_sqft'];
    $home_type = $_POST['home_type'];
    $type = $_POST['type'];
    $description = $_POST['description'];
    $adminname = $_SESSION['adminname'];
    $image = $_FILES['thumbnail']['name'];

    $dir = 'thumbnails/' . basename($image);
    $insert = $conn->prepare("INSERT INTO props(name, location, price, beds, baths, sqft, year_built, price_sqft, home_type, type, description, admin_name, image) 
                            VALUES (:name, :location, :price, :beds, :baths, :sqft, :year_built, :price_sqft, :home_type, :type, :description, :admin_name, :image)");
    $insert->execute([
        ':name' => $name,
        ':location' => $location,
        ':price' => $price,
        ':beds' => $beds,
        ':baths' => $baths,
        ':sqft' => $sq_ft,
        ':year_built' => $year_built,
        ':price_sqft' => $price_sqft,
        ':home_type' => $home_type,
        ':type' => $type,
        ':description' => $description,
        ':admin_name' => $adminname,
        ':image' => $image,
    ]);

    if(move_uploaded_file($_FILES['thumbnail']['tmp_name'], $dir)){
        echo "<script>alert('Property added successfully');</script>";
        echo "<script>window.location.href='".ADMIN_URL."/properties-admins/show-properties.php'</script>";
    }

    
    $id = $conn->lastInsertId();
	foreach ($_FILES['image']['tmp_name'] as $key => $value) {
		$filename=$_FILES['image']['name'][$key];
		$filename_tmp=$_FILES['image']['tmp_name'][$key];
		echo '<br>';
		$ext=pathinfo($filename,PATHINFO_EXTENSION);

		$finalimg='';
        $filename=str_replace('.','-',basename($filename,$ext));
        $newfilename=$filename.time().".".$ext;
        move_uploaded_file($filename_tmp, 'images/'.$newfilename);
        $finalimg=$newfilename;
			//insert
			$insertqry=$conn->prepare("INSERT INTO `related_images`( `image`,prop_id) VALUES ('$finalimg', '$id')");
			$insertqry->execute();
      echo "<script>window.location.href='".ADMIN_URL."properties-admins/show-properties.php'</script>";
    }
}
}
?>
<div class="row">
        <div class="col">
          <div class="card">
            <div class="card-body">
                    <h5 class="card-title mb-5 d-inline">Create Properties</h5>
                    <form method="POST" action="<?php echo ADMIN_URL; ?>/properties-admins/create-properties.php" enctype="multipart/form-data">
                        <!-- Email input -->
                        <div class="form-outline mb-4 mt-4">
                            <input type="text" name="name" id="form2Example1" value="<?php if(isset($_POST['name'])){ echo $_POST['name'];} ?>" class="form-control" placeholder="name" />
                        </div>    
                        <div class="form-outline mb-4 mt-4">
                            <input type="text" name="location" id="form2Example1" value="<?php if(isset($_POST['location'])){ echo $_POST['location'];} ?>" class="form-control" placeholder="location" />
                        </div> 
                        <div class="form-outline mb-4 mt-4">
                            <input type="text" name="price" id="form2Example1" value="<?php if(isset($_POST['price'])){ echo $_POST['price'];} ?>" class="form-control" placeholder="price" />
                        </div> 
                        <div class="form-outline mb-4 mt-4">
                            <input type="text" name="beds" id="form2Example1" value="<?php if(isset($_POST['beds'])){ echo $_POST['beds'];} ?>" class="form-control" placeholder="beds" />
                        </div>
                        <div class="form-outline mb-4 mt-4">
                            <input type="text" name="baths" id="form2Example1" value="<?php if(isset($_POST['baths'])){ echo $_POST['baths'];} ?>" class="form-control" placeholder="baths" />
                        </div>
                        <div class="form-outline mb-4 mt-4">
                            <input type="text" name="sq_ft" id="form2Example1" value="<?php if(isset($_POST['sq_ft'])){ echo $_POST['sq_ft'];} ?>" class="form-control" placeholder="SQ/FT" />
                        </div>   
                        <div class="form-outline mb-4 mt-4">
                            <input type="text" name="year_built" id="form2Example1" value="<?php if(isset($_POST['year_built'])){ echo $_POST['year_built'];} ?>" class="form-control" placeholder="Year Build" />
                        </div> 
                        <div class="form-outline mb-4 mt-4">
                            <input type="text" name="price_sqft" id="form2Example1" value="<?php if(isset($_POST['price_sqft'])){ echo $_POST['price_sqft'];} ?>" class="form-control" placeholder="Price Per SQ FT" />
                        </div> 
                        
                        <select name="home_type" class="form-control form-select" value="<?php if(isset($_POST['home_type'])){ echo $_POST['home_type'];} ?>" aria-label="Default select example">
                            <option selected>Select Home Type</option>
                            <?php
                            $categories = $conn->query("SELECT * FROM categories");
                            $allCategories = $categories->fetchAll(PDO::FETCH_OBJ);?>
                            <?php
                            foreach($allCategories as $category): ?>
                            <option value="<?php echo $category->name ;?>"><?php echo $category->name; ?></option>
                           <?php endforeach; ?>
                        </select>   
                        <select name="type" class="form-control mt-3 mb-4 form-select"  value="<?php if(isset($_POST['type'])){ echo $_POST['type'];} ?>" aria-label="Default select example">
                            <option selected>Select Type</option>
                            <option value="rent">Rent</option>
                            <option value="sale">Sale</option>
                        </select>  
                        <div class="form-group">
                            <label for="exampleFormControlTextarea1">Description</label>
                            <textarea placeholder="Description" name="description" value="<?php if(isset($_POST['description'])){ echo $_POST['description'];} ?>" class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="formFile" class="form-label">Property Thumbnail</label>
                            <input name="thumbnail" class="form-control" type="file" id="formFile">
                        </div>
                        <div class="mb-3">
                            <label for="formFileMultiple" class="form-label">Gallery Images</label>
                            <input name="image[]" class="form-control" type="file" id="formFileMultiple" multiple>
                        </div>
                        <!-- Submit button -->
                        <button type="submit" name="submit" class="btn btn-primary  mb-4 text-center">create</button>
                
                    </form>

            </div>
          </div>
        </div>
      </div>

 
<?php require '../layouts/footer.php';?>

