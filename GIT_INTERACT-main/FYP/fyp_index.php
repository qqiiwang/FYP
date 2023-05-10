<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    <script src="https://cdn.bootcdn.net/ajax/libs/qs/6.11.0/qs.js"></script>
	<title>Admin Page</title>
	<style>
		.container {
			display: flex;
			flex-wrap: wrap;
		}
		.section {
			border: 1px solid black;
			padding: 20px;
			margin: 20px;
			flex: 1;
			min-width: 300px;
			min-height: 500px;
		}
		h2 {
			margin: 10px 0;
		}
		form {
			display: flex;
			flex-direction: column;
			margin-bottom: 20px;
		}
		label {
			margin-bottom: 10px;
		}
		input[type="submit"] {
			margin-top: 10px;
			align-self: center;
			padding: 10px;
			background-color: #008CBA;
			color: white;
			border: none;
			border-radius: 5px;
			font-size: 16px;
			cursor: pointer;
		}
		table {
			border-collapse: collapse;
			width: 100%;
			margin-bottom: 20px;
		}
		th, td {
			border: 1px solid black;
			padding: 10px;
			text-align: center;
		}
		th {
			background-color: #008CBA;
			color: white;
		}
	
		.bold {
			font-weight: bold;
		}
		.message {
			display: flex;
			align-items: center;
			padding: 10px;
			background-color: #4CAF50;
			color: white;
			border-radius: 5px;
			margin-bottom: 20px;
		}
		.message.success {
			background-color: #4CAF50;
			color: white;
		}
		.message.error {
			background-color: #FF5722;
			color: white;
		}
		.redis {
		    	margin: 10px 0;
		}
	</style>
</head>
<body>
    <div class="container">
	    <div class="section">
		<h2>Backup and Recovery</h2>
	 	    <button onclick="backup()" value="backup" name="backup" id="backup">Backup</button>
            <button onclick="recovery()" value="recovery" id="recovery">Recovery</button>
            <button onclick="showmysql()" value="showmysql" id="showmysql">Show Mysql</button>
            <button onclick="showredis()" value="showredis" id="showredis">Show Redis</button>
            
		<form id="my-form"method="post" action="">
		
            <label for="username" id="username1">Username:</label>
            <input type="text" id="username2" name="username"><br><br>
            <label for="password" id="password1">Password:</label>
            <input type="password" id="password2" name="password"><br><br>
            
            <label for="ip" id="ip1">IP:</label>
            <input type="text" id="ip2" name="ip"><br><br>
            <label for="port" id="port1">Port:</label>
            <input type="number" id="port2" name="port"><br><br>
      
            <label for="dbname" id="dbname1">Database_name:</label>
            <input type="dbname" id="dbname2" name="dbname"><br><br>

	        <label for="dest_user" id="dest_user">Target database Username:</label>
            <input type="text" id="dest_user1" name="dest_user"><br><br>
            <label for="dest_pwd" id="dest_pwd">Target database password:</label>
            <input type="password" id="dest_pwd1" name="dest_pwd"><br><br>
            
            <label for="dest_ip" id="dest_ip">Target database IP:</label>
            <input type="text" id="dest_ip1" name="dest_ip"><br><br>
            <label for="dest_port" id="dest_port">Target database Port:</label>
            <input type="number" id="dest_port1" name="dest_port"><br><br>

            <label for="dbname" id="type">Backup type:</label>
            <select name="type" id="option1">
                <option ></option>
                <option value="full">Full</option>
                <option value="incre">Increment</option>
             </select>
             <br><br>

           <button type="submit" name="submit1">Start !</button>
            </form>

        <?php
         session_start();
        if(!empty($_POST['username']) && !empty($_POST['password']) && !empty($_POST['ip']) && !empty($_POST['port']) && !empty($_POST['dbname'])  && !empty($_POST['type'])){

            $username = $_POST["username"];
            $password = $_POST["password"];
            $ip = $_POST["ip"];
            $port = $_POST["port"];
            $dbname = $_POST["dbname"];

	// 执行Shell脚本
            if( $_POST['type'] == "full"){
	echo "full";

	$url='http://127.0.0.1:5000/set/value';
	$data = json_encode(['db_name' => $dbname,
	'ip' => $ip,
	'port' => $port,
	'user' => $username,
	'pwd' => $password]);
	$curl = curl_init($url);
	curl_setopt($curl, CURLOPT_HEADER, false);
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($curl, CURLOPT_HTTPHEADER, array("Content-type: application/json"));
	curl_setopt($curl, CURLOPT_POST, true);
	curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
	$output = curl_exec($curl);
	curl_close($curl);
            
            }
            if( $_POST['type'] == "incre"){
	
	$url='http://127.0.0.1:5000/push/message';
	$data = json_encode(['db_name' => $dbname,
	'ip' => $ip,
	'port' => $port,
	'user' => $username,
	'pwd' => $password]);
	$curl = curl_init($url);
	curl_setopt($curl, CURLOPT_HEADER, false);
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($curl, CURLOPT_HTTPHEADER, array("Content-type: application/json"));
	curl_setopt($curl, CURLOPT_POST, true);
	curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
	$output = curl_exec($curl);
	curl_close($curl);
            }

            // session_start();
            // Set the variable value
            $_SESSION['username'] = $_POST['username'];
            $_SESSION['password'] = $_POST['password'];
            $_SESSION['host'] = $_POST['ip'];
            $_SESSION['port'] = $_POST['port'];
            $_SESSION['dbname'] = $_POST['dbname'];
            $_SESSION['type'] = $_POST['type'];
	$_SESSION['output'] = $output;
        }
             
           if(empty($_POST['username']) && empty($_POST['password']) && !empty($_POST['ip']) && !empty($_POST['port']) && !empty($_POST['dbname']) && !empty($_POST['type'])&& !empty($_POST['dest_user'])){
               echo "start recovery";
            $dbname = $_POST["dbname"];
             $ip = $_POST["ip"];
              $port = $_POST["port"];
 	$dest_user = $_POST["dest_user"];
             $dest_pwd = $_POST["dest_pwd"];
              $dest_port = $_POST["dest_port"];
 	$dest_ip = $_POST["dest_ip"];
             $type = $_POST["type"];
// 执行Shell脚本
        if( $_POST['type'] == "full"){

	$url='http://127.0.0.1:5000/rec/value';
	$old_db_name=$ip. '_' . $port . '_' . $dbname  . '_full'; 

	$data = json_encode(['old_db_name' => $old_db_name,
	'dest_ip' => $dest_ip,
	'dest_port' => $dest_port,
	'dest_user' => $dest_user,
	'dest_pwd' => $dest_pwd]);
	$curl = curl_init($url);
	curl_setopt($curl, CURLOPT_HEADER, false);
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($curl, CURLOPT_HTTPHEADER, array("Content-type: application/json"));
	curl_setopt($curl, CURLOPT_POST, true);
	curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
	$output = curl_exec($curl);
	curl_close($curl);
           
            }
            if( $_POST['type'] == "incre"){
	
	$url='http://127.0.0.1:5000/rec/queue';
	$old_db_name=$ip. '_' . $port . '_' . $dbname  . '_incre'; 

	$data = json_encode(['old_db_name' => $old_db_name,
	'dest_ip' => $dest_ip,
	'dest_port' => $dest_port,
	'dest_user' => $dest_user,
	'dest_pwd' => $dest_pwd]);
	$curl = curl_init($url);
	curl_setopt($curl, CURLOPT_HEADER, false);
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($curl, CURLOPT_HTTPHEADER, array("Content-type: application/json"));
	curl_setopt($curl, CURLOPT_POST, true);
	curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
	$output = curl_exec($curl);
	curl_close($curl);
         
            }
            
            $_SESSION['username'] = $_POST['username'];
            $_SESSION['password'] = $_POST['password'];
            $_SESSION['host'] = $_POST['ip'];
            $_SESSION['port'] = $_POST['port'];
           $_SESSION['output'] = $output;
            
        }
        if(!empty($_POST['username']) && !empty($_POST['password']) && !empty($_POST['ip']) && !empty($_POST['port']) && empty($_POST['dbname']) && empty($_POST['type'])){

            $_SESSION['username'] = $_POST['username'];
            $_SESSION['password'] = $_POST['password'];
            $_SESSION['host'] = $_POST['ip'];
            $_SESSION['port'] = $_POST['port'];
        }
        ?>
        
<script>
function backup() {
    document.getElementById("showmysql").style.backgroundColor = "#fff";
    document.getElementById("showredis").style.backgroundColor = "#fff";
    document.getElementById("backup").style.backgroundColor = "#008CBA";
    document.getElementById("recovery").style.backgroundColor = "#fff";
    
    document.getElementById("username1").hidden = false;
    document.getElementById("username2").hidden = false;
    document.getElementById("password1").hidden = false;
    document.getElementById("password2").hidden = false;
    document.getElementById("ip1").hidden = false;
    document.getElementById("ip2").hidden = false;
    document.getElementById("port1").hidden = false;
    document.getElementById("port2").hidden = false;
    document.getElementById("dbname1").hidden = false;
    document.getElementById("dbname2").hidden = false;
    document.getElementById("type").hidden = false;
    document.getElementById("option1").hidden = false;
    document.getElementById("dest_user").hidden = true;
    document.getElementById("dest_pwd").hidden = true;
    document.getElementById("dest_ip").hidden = true;
    document.getElementById("dest_port").hidden = true;
    document.getElementById("dest_user1").hidden = true;
    document.getElementById("dest_pwd1").hidden = true;
    document.getElementById("dest_ip1").hidden = true;
    document.getElementById("dest_port1").hidden = true;
}
function recovery() {
    document.getElementById("showmysql").style.backgroundColor = "#fff";
    document.getElementById("showredis").style.backgroundColor = "#fff";
    document.getElementById("backup").style.backgroundColor = "#fff";
    document.getElementById("recovery").style.backgroundColor = "#008CBA";
    
    document.getElementById("username1").hidden = true;
    document.getElementById("username2").hidden = true;
    document.getElementById("password1").hidden = true;
    document.getElementById("password2").hidden = true;
    document.getElementById("ip1").hidden = false;
    document.getElementById("ip2").hidden = false;
    document.getElementById("port1").hidden = false;
    document.getElementById("port2").hidden = false;
    document.getElementById("dbname1").hidden = false;
    document.getElementById("dbname2").hidden = false;
    document.getElementById("type").hidden = false;
    document.getElementById("option1").hidden = false;
   document.getElementById("dest_user").hidden = false;
    document.getElementById("dest_pwd").hidden = false;
    document.getElementById("dest_ip").hidden = false;
    document.getElementById("dest_port").hidden = false;
    document.getElementById("dest_user1").hidden = false;
    document.getElementById("dest_pwd1").hidden = false;
    document.getElementById("dest_ip1").hidden = false;
    document.getElementById("dest_port1").hidden = false;
     
}
function showmysql() {
    document.getElementById("showmysql").style.backgroundColor = "#008CBA";
    document.getElementById("showredis").style.backgroundColor = "#fff";
    document.getElementById("backup").style.backgroundColor = "#fff";
    document.getElementById("recovery").style.backgroundColor = "#fff";
    
    document.getElementById("username1").hidden = false;
    document.getElementById("username2").hidden = false;
    document.getElementById("password1").hidden = false;
    document.getElementById("password2").hidden = false;
    document.getElementById("ip1").hidden = false;
    document.getElementById("ip2").hidden = false;
    document.getElementById("port1").hidden = false;
    document.getElementById("port2").hidden = false;
    document.getElementById("dbname1").hidden = true;
    document.getElementById("dbname2").hidden = true;
    document.getElementById("type").hidden = true;
    document.getElementById("option1").hidden = true;
    document.getElementById("dest_user").hidden = true;
    document.getElementById("dest_pwd").hidden = true;
    document.getElementById("dest_ip").hidden = true;
    document.getElementById("dest_port").hidden = true;
    document.getElementById("dest_user1").hidden = true;
    document.getElementById("dest_pwd1").hidden = true;
    document.getElementById("dest_ip1").hidden = true;
    document.getElementById("dest_port1").hidden = true;
}

function showredis(){
    document.getElementById("showmysql").style.backgroundColor = "#fff";
    document.getElementById("showredis").style.backgroundColor = "#008CBA";
    document.getElementById("backup").style.backgroundColor = "#fff";
    document.getElementById("recovery").style.backgroundColor = "#fff";
    
    document.getElementById("username1").hidden = true;
    document.getElementById("username2").hidden = true;
    document.getElementById("password1").hidden = true;
    document.getElementById("password2").hidden = true;
    document.getElementById("ip1").hidden = false;
    document.getElementById("ip2").hidden = false;
    document.getElementById("port1").hidden = false;
    document.getElementById("port2").hidden = false;
    document.getElementById("dbname1").hidden = true;
    document.getElementById("dbname2").hidden = true;
    document.getElementById("type").hidden = true;
    document.getElementById("option1").hidden = true;
    document.getElementById("dest_user").hidden = true;
    document.getElementById("dest_pwd").hidden = true;
    document.getElementById("dest_ip").hidden = true;
    document.getElementById("dest_port").hidden = true;
    document.getElementById("dest_user1").hidden = true;
    document.getElementById("dest_pwd1").hidden = true;
    document.getElementById("dest_ip1").hidden = true;
    document.getElementById("dest_port1").hidden = true;
}

</script>   
	    </div>
		
		
	<div class="section">
		<h2>MySQL Viewer</h2>
		<?php

    if(empty($_POST['username']) && empty($_POST['password']) && !empty($_POST['ip']) && !empty($_POST['port']) && !empty($_POST['dbname']) && !empty($_POST['type'])&& !empty($_POST['dest_user'])){

	$dest_user = $_POST["dest_user"];
             $dest_pwd = $_POST["dest_pwd"];
              $dest_port = $_POST["dest_port"];
 	$dest_ip = $_POST["dest_ip"];

        $conn = mysqli_connect($dest_ip,$dest_user,$dest_pwd,'',$dest_port);

        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
            }
        $sql = "SHOW DATABASES";
        $result = mysqli_query($conn, $sql);
        echo "<h2>".'Host: ' . $_POST['dest_ip'] . "</h2>";
        echo "<h2>".'Port: ' . $_POST['dest_port'] . "</h2>";
        while ($row = mysqli_fetch_assoc($result)) {
        $dbname = $row['Database'];
    // 排除mysql、information_schema、performance_schema等默认数据库
        if ($dbname != 'mysql' && $dbname != 'information_schema' && $dbname != 'performance_schema'&& $dbname != 'sys'&& $dbname != 'phpmyadmin') {
            echo "<h2>" . 'Database: '. $dbname . "</h2>";
            mysqli_select_db($conn, $dbname);
            $sql = "SHOW TABLES";
            $tables = mysqli_query($conn, $sql);
            
            while ($table = mysqli_fetch_assoc($tables)) {
                echo "<h3>" . 'Table:' . $table['Tables_in_' . $dbname] . "</h3>";
                $sql = "SELECT * FROM " . $table['Tables_in_' . $dbname];
                $data = mysqli_query($conn, $sql);
                echo "<table>";
            // 输出表头
                echo "<tr>";
                while ($field = mysqli_fetch_field($data)) {
                    echo "<th>" . $field->name . "</th>";
                }
                echo "</tr>";
            // 输出数据
                while ($row = mysqli_fetch_assoc($data)) {
                    echo "<tr>";
                    foreach ($row as $value) {
                        echo "<td>" . $value . "</td>";
                    }
                    echo "</tr>";
                }
                echo "</table>";
            }
        }
        }
    // 关闭连接
    mysqli_close($conn);

    }
if(!empty($_POST['ip']) && !empty($_POST['port']) && !empty($_POST['username']) && !empty($_POST['password'])){
	       // 		session_start();
        $usr=$_POST['username'];
        $host = $_POST['ip'];
        $password=$_POST['password'];
        $port=$_POST['port'];

// Connect to the database
$conn = mysqli_connect($host,$usr,$password,'',$port);

// Check connection
        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
            }
        $sql = "SHOW DATABASES";
        $result = mysqli_query($conn, $sql);
        echo "<h2>".'Host: ' . $_POST['ip'] . "</h2>";
        echo "<h2>".'Port: ' . $_POST['port'] . "</h2>";
        while ($row = mysqli_fetch_assoc($result)) {
        $dbname = $row['Database'];
    // 排除mysql、information_schema、performance_schema等默认数据库
        if ($dbname != 'mysql' && $dbname != 'information_schema' && $dbname != 'performance_schema'&& $dbname != 'sys'&& $dbname != 'phpmyadmin') {
            echo "<h2>" . 'Database: '. $dbname . "</h2>";
            mysqli_select_db($conn, $dbname);
            $sql = "SHOW TABLES";
            $tables = mysqli_query($conn, $sql);
            
            while ($table = mysqli_fetch_assoc($tables)) {
                echo "<h3>" . 'Table:' . $table['Tables_in_' . $dbname] . "</h3>";
                $sql = "SELECT * FROM " . $table['Tables_in_' . $dbname];
                $data = mysqli_query($conn, $sql);
                echo "<table>";
            // 输出表头
                echo "<tr>";
                while ($field = mysqli_fetch_field($data)) {
                    echo "<th>" . $field->name . "</th>";
                }
                echo "</tr>";
            // 输出数据
                while ($row = mysqli_fetch_assoc($data)) {
                    echo "<tr>";
                    foreach ($row as $value) {
                        echo "<td>" . $value . "</td>";
                    }
                    echo "</tr>";
                }
                echo "</table>";
            }
        }
        }
    // 关闭连接
    mysqli_close($conn);
    }
?>
	</div>
	
	
	
	<div class="section">
	<h2>Redis Queue Viewer</h2>
    <?php
 
    if(!empty($_POST['ip']) && !empty($_POST['port']) && !empty($_POST['type']) && !empty($_POST['dbname'])){

    $type = $_POST['type'];
    

    if( $type == "incre" ){

$old_db_name=$_POST['ip']. '_' . $_POST['port'] . '_' . $_POST['dbname']  . '_incre'; 
echo $old_db_name;
	
    }
    if( $type == "full" ){
       echo "full";
	$url='http://127.0.0.1:5000/get/full/redis';
	$data = json_encode([
	'ip' => $_POST['ip'],
	'port' =>$_POST['port'],
	'db_name' =>$_POST['dbname']]);
	$curl = curl_init($url);
	curl_setopt($curl, CURLOPT_HEADER, false);
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($curl, CURLOPT_HTTPHEADER, array("Content-type: application/json"));
	curl_setopt($curl, CURLOPT_POST, true);
	curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
	$output = curl_exec($curl);
	curl_close($curl);
        echo "<div class='redis'>"; //格式化输出
        print_r($output); //输出Redis流中的内容
        echo "</div>";
    }
}

    if(!empty($_POST['ip']) && !empty($_POST['port']) && empty($_POST['username']) && empty($_POST['password']) && empty($_POST['type']) && empty($_POST['dbname'])){
        // session_start();
   	$url='http://127.0.0.1:5000/get/redis';
	$data = json_encode([
	'ip' => $_POST['ip'],
	'port' =>$_POST['port']]);
	$curl = curl_init($url);
	curl_setopt($curl, CURLOPT_HEADER, false);
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($curl, CURLOPT_HTTPHEADER, array("Content-type: application/json"));
	curl_setopt($curl, CURLOPT_POST, true);
	curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
	$output = curl_exec($curl);
	curl_close($curl);
        echo "<div class='redis'>"; //格式化输出
        print_r($output); //输出Redis流中的内容
        echo "</div>";

    }
    ?>
	</div>
</div>

	<div class="container">
	    <div class="section">
		<h1>Result:</h1>
        <?php
           
// Get the variable value
 if(!empty($_POST['dbname'])){
    //   session_start();
            echo $_SESSION['output']; 
    }
        ?>  
		</div>
		
		 <div class="section">
		<h1>Redis Specification:</h1>
        <?php
           
// Get the variable value
 
            echo "<h3>" . " Full backup/recovery: List " . "</h3>";
             echo "<br>";
             echo "<table>";
            // 输出表头
                echo "<tr>";
                    echo "<th>" . "Key" . "</th>";
                    echo "<th>" . "Value" . "</th>";
                echo "</tr>";
                 echo "<tr>";
                        echo "<td>" . "DBNAME_IP_PORT_full" . "</td>";
                         echo "<td>" . "/backup_file_path" . "</td>";
                echo "</tr>";
            echo "</table>";
            
            echo "<h3>" . " Incremental backup/recovery: Stream" . "</h3>"; 
             echo "<br>";
            echo "<table>";
            // 输出表头
                echo "<tr>";
                    echo "<th>" . "Key" . "</th>";
                    echo "<th>" . "Value" . "</th>";
                echo "</tr>";
                 echo "<tr>";
                        echo "<td>" . "DBNAME_IP_PORT_incre" . "</td>";
                         echo "<td>" . "/backup_file_path-1 /backup_file_path-2 /backup_file_path-3" . "</td>";
                echo "</tr>";
            echo "</table>";
            
        ?>  
		</div>

</div>
