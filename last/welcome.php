<?php 

session_start();

if (!isset($_SESSION['username'])) {
    header("Location: index.php");
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome</title>
</head>
<body>
    <?php if(isset($_SESSION['username'])):?>
    <h3>Welcome<strong><?php echo $_SESSION['username'] ?></strong></h3>
    <?php endif ?>
   
    <a href="logout.php">Logout </a>
     <?php header("Location: todolast/index.php"); ?>
</body>
</html>