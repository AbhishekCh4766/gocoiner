if(isset($_POST["from_date"], $_POST["to_date"]))  
 {  
      $dbHost = RL_DBHOST;
      $dbUsername = RL_DBUSER;
      $dbPassword = RL_DBPASS;
      $dbName = RL_DBNAME;
      $conn = new mysqli($dbHost, $dbUsername, $dbPassword, $dbName);
      $conn->query('SET CHARACTER SET utf8');
      $output = '';  
      $query = "  
           SELECT * FROM tbl_order  
           WHERE order_date BETWEEN '".$_POST["from_date"]."' AND '".$_POST["to_date"]."'  
      ";  
      $result = mysqli_query($connect, $query);  
  
 ?>