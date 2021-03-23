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
  if(isset($_REQUEST['search'])){
    $item = $_REQUEST['search'];
    $_SESSION['item'] = $item;
     $sql = "SELECT *  FROM product WHERE MATCH(name, description)  AGAINST('$item*' IN BOOLEAN MODE) LIMIT 7";
     $match = mysqli_query($conn, $sql);
      $num = mysqli_num_rows($match);
      $_SESSION['num'] = $num;
    
    while ($get = mysqli_fetch_assoc($match)){
           $name = $get["name"];
           $description = $get["description"];

        echo' 
         <div class="search-container-item">
            <div class="search-meta">
                <span><i class="fa fa-calendar-o"></i> <span class="date">15, january 2021</span></span>
            </div>
            <div class="search-body">
               <a href="content.php?check='.$name.'"> '.$name.'</a>
                <p>'.$description.'</p>
            </div>
        </div>
        
        
        ';
      }
    


} else{
  echo "nothing found on this question";
}
?>