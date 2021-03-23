<!DOCTYPE html>
<html lang="en">
<?php 
$cleardb_url = parse_url(getenv("CLEARDB_DATABASE_URL"));
$cleardb_server = $cleardb_url["host"];
$cleardb_username = $cleardb_url["user"];
$cleardb_password = $cleardb_url["pass"];
$cleardb_db = substr($cleardb_url["path"],1);
$active_group = 'default';
$query_builder = TRUE;
// Connect to DB
$conn = mysqli_connect($cleardb_server, $cleardb_username, $cleardb_password, $cleardb_db);
    if(mysqli_errno($conn)){
        echo "failed to connect to DB".mysqli_errno($conn);
        mysqli_close($conn);
    }
     if (isset($_REQUEST['check'])){
       $check =  $_REQUEST['check'];
    $sql = "SELECT *  FROM product WHERE name='$check' ";
    $query = mysqli_query($conn, $sql);
        $show = mysqli_fetch_array($query);
        $name = $show['name'];
        $price =  $show['price'];
        $gender = $show['gender'];
        $des =  $show['description'];
     }else{
         header("location:error.php");
     }


?>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>The Law Crest</title>
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <link rel="stylesheet" href="./css2/error.css?v=<?php echo time(); ?>">

</head>

<body>
 <header>
        <h1 class="search-heading">The Law Crest</h1>
        </header>

           <aside class="main">
           <div class="display">
             <h2><?php echo $name; ?></h2>
             <div class="des"> 
              <?php echo $des; ?>
             </div>
                  <ul>
                      <li><?php echo $gender ?></li>
                      <li><?php echo $price; ?></li>
                      <li>login to chat with a lawyer for forward explanation</li>
                  </ul>

           </div>
           <a href="signup.php"><button type="button"><i class="fa fa-comment" aria hidden="true"></i>Login page</button></a>
        </aside>
    
</body>

</html>