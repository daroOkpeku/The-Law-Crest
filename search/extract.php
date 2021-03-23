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
$error = " ";
function clean($string){
  $string = stripslashes($string);
  $string  = strip_tags($string);
  $string = trim($string);
  return $string;
}
    if(isset($_POST["click"])){
     $name = $_POST['name'];
     $user_name = $_POST['username'];
     $email = $_POST['email'];
     $phone = $_POST['phone'];
     $password = $_POST['userPass'];

     $name = clean($name);
     $user_name = clean($user_name);
     $email = clean($email);
     $phone = clean($phone);
     $password = clean($password);

      $name = mysqli_real_escape_string($conn, $name);
     $email = mysqli_real_escape_string($conn, $email);
    $password = mysqli_real_escape_string($conn, $password);
    $phone = mysqli_real_escape_string($conn, $phone);
    $user_name = mysqli_real_escape_string($conn, $user_name);

    $user_name = preg_replace("/[^A-Za-z0-9]/", " ", $user_name);
    $email = preg_replace("/[^A-Za-z0-9]/", " ", $email);
    $password = preg_replace("/[^A-Za-z0-9]/", " ", $password);
    $phone = preg_replace("/[^0-9]/", " ", $phone);


        $sql= "SELECT * FROM users WHERE name='$name' OR userPass='$password' ";
        $run =  mysqli_query($conn, $sql);
        $num = mysqli_num_rows($run);

        if($num > 0){
            header("location:error.php?name and password Already exist");
              
           exit();
        }

            $sql_me = "insert into  users(name, email, userPass, phoneNumber, username) values( '$name', '$email', '$password', '$phone', '$user_name')";
        if (!mysqli_query($conn, $sql_me)) {
        printf("d% failed to insert". mysqli_affected_rows($conn));
        mysqli_close($conn);
        } else {
        header("location:login.php");
        echo "<script>window.open('login.php', '_self')<script>";
            }
    }

?>