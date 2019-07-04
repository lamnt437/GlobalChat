<?php
session_start();
?>

<!DOCTYPE html>
<html>
<head>
<title>Home</title>
</head>
<body>
<?php 
if(!isset($_SESSION['user_name']))
  header('Location: index.php?controller=users&action=login');
echo $status . '</br>';
echo $_SESSION['user_name'];
?>
<a href="index.php?controller=users&action=logout">Logout</a>
</body>
</html>