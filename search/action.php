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
if(isset($_REQUEST['times'])){
    $one = mysqli_real_escape_string($conn, $_REQUEST["word"]);
    $one = explode(" ", $one);
     foreach($one as $cool ){
       $sql = "SELECT * FROM product WHERE name LIKE  '$cool%' OR  description LIKE  '$cool%' LIMIT 7 ";
     }
    
      
    
   /// $sql = "SELECT * FROM product WHERE MATCH(name) AGAINST('$one')";
    $query = mysqli_query($conn,$sql);
    
   while($arrange = mysqli_fetch_assoc($query)){
    $name = $arrange['name'];

    echo "<ul>
    <li><i class='fa fa-lightbulb-o' aria-hidden='true'></i>$name</li>
    </ul>";
      
    
  }
   

}
