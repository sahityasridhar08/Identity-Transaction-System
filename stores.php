<html>
   
   <head>
      <title>Cafeteria</title>
      <style>
ul {
    list-style-type: none;
    margin: 0;
    padding: 0;
    overflow: hidden;
    background-color: #333;
}

li {
    float: left;
}

li a {
    display: block;
    color: white;
    text-align: center;
    padding: 14px 16px;
    text-decoration: none;
}

li a:hover {
    background-color: #111;
}
.title{
    font-size:1.6em;
}
</style>
   </head>
   
   <body>
          <ul>
<li><a href="http://localhost/ct/home.php">Home</a></li>
<li><a href="http://localhost/ct/account.php">Account</a></li>
<li><a href="http://localhost/ct/library.php">Library</a></li>
<li><a href="http://localhost/ct/cafe.php">Cafeteria</a></li>
<li><a href="http://localhost/ct/stores.php">Stores</a></li>

<li><a href="http://localhost/ct/index.html">Logout</a></li>
</ul>
 <br><br>
      <?php
         $max = 150;
         $link = mysqli_connect('localhost','sahitya','babahelp','ct');
         
         if(! $link ) {
            die('Could not connect: ' . mysql_error());
         }
         $sql = "SELECT count(id) FROM stores ";
         $retval = mysqli_query( $link, $sql );
         
         if(! $retval ) {
            die('Could not get data: ' . mysql_error());
         }
         $row = mysqli_fetch_array($retval, MYSQL_NUM );
         $rec_count = $row[0];
         
         if( isset($_GET{'page'} ) ) {
            $page = $_GET{'page'} + 1;
            $offset = $max * $page ;
         }
         else {
            $page = 0;
            $offset = 0;
         }
         session_start();
         $id=$_SESSION['current_user'];
         $left_rec = $rec_count - ($page * $max);
         $sql = "SELECT * ". 
            "FROM stores ".
            "WHERE id = '$id'".
            "LIMIT $offset, $max";
            
         $retval = mysqli_query($link,$sql );
         
         if(! $retval ) {
            die('Could not get data: ' . mysql_error());
         }
         
         while($row = mysqli_fetch_array($retval, MYSQL_ASSOC)) {
            echo "Activity ID :{$row['no']}  <br> ".
               "Activity Performed : {$row['activity']} <br> ".
               "Amount Paid : {$row['price']} <br> ".
               "--------------------------------<br>";
         }
         
         /*if( $page > 0 ) {
            $last = $page - 2;
            echo "<a href = \"http://localhost/ct/library.php?page = $last\">Last 15 Books</a> |";
            echo "<a href = \"http://localhost/ct/library.php?page = $page\">Next 15 Books</a>";
         }else if( $page == 0 ) {
            echo "<a href = \"http://localhost/ct/library.php?page = $page\">Next 15 Books</a>";
         }else if( $left_rec < $max ) {
            $last = $page - 2;
            echo "<a href = \"http://localhost/ct/library.php?page = $last\">Last 15 Books</a>";
         }*/
         
         mysqli_close($link);
      ?>
      
   </body>
</html>