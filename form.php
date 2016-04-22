<!DOCTYPE HTML>
<html>
<head>
<style>
.error {color: #FF0000;}
</style>
</head>
<body>

<?php
// define variables and set to empty values
$nameErr = $phoneErr = $misErr = "";

$name = $phone = $mis = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
   if (empty($_POST["name"])) {
     $nameErr = "Name is required!";
   } else {
     $name = test_input($_POST["name"]);
     // check if name only contains letters and whitespace
     if (!preg_match("/^[a-zA-Z ]*$/",$name)) {
       $nameErr = "Only letters and white space allowed!";
     }
   }
  
   if (empty($_POST["phone"])) {
     $phoneErr = "Phone is required";
   } else {
     $phone = test_input($_POST["phone"]);
     if (strlen($phone) != 10) {
       $phoneErr = "Invalid phone format";
     }
   }
    
   if (empty($_POST["mis"])) {
     $misErr = "mis required";
   } else {
     $mis = test_input($_POST["mis"]);
     if (strlen($mis) != 10) {
      {
       $misErr = "Invalid mis";
     }
   }
}

function test_input($data) {
   $data = trim($data);
   $data = stripslashes($data);
   $data = htmlspecialchars($data);
   return $data;
}
?>

<h2></h2>
<p><span class="error">* required field.</span></p>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
   Name: <input type="text" name="name" value="<?php echo $name;?>">
   <span class="error">* <?php echo $nameErr;?></span>
   <br><br>
   E-mail: <input type="text" name="phone" value="<?php echo $phone;?>">
   <span class="error">* <?php echo $phoneErr;?></span>
   <br><br>
   mis: <input type="text" name="mis" value="<?php echo $mis;?>">
   <span class="error"><?php echo $misErr;?></span>
   <br><br>
   <input type="submit" name="submit" value="Submit">
</form>

<?php
echo "<h2>Your Input:</h2>";
echo $name;
echo "<br>";
echo $phone;
echo "<br>";
echo $mis;
echo "<br>";
?>

<?php
$link = mysqli_connect("localhost", "root", "root", "info");
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
    }
$sql = "INSERT INTO user (name, phone, mis) VALUES ('$name', '$phone', '$mis')";
if(mysqli_query($link, $sql)){
    echo "Records added successfully.";
    }
else{
	echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
}
mysqli_close($link);
?>
</body>
</html>
