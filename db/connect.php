<?php
  	try
	{
		// uncomment below for local user
		//$conn = new PDO("sqlsrv:Server=sqlsv-cs667auth.cbpyuvpamt0n.us-east-2.rds.amazonaws.com,1430;Database=sqlauth", "admin", "sqlsv-cs667auth!");

		// uncomment below for EB deployment
		$dbhost = $_SERVER['RDS_HOSTNAME'];
		$dbport = $_SERVER['RDS_PORT'];
		$dbname = $_SERVER['RDS_DB_NAME'];
		$charset = 'utf8' ;
		//sqlsrv:Server=
		$dsn = "sqlsrv:Server={$dbhost};port={$dbport};dbname={$dbname};charset={$charset}";
		$username = $_SERVER['RDS_USERNAME'];
		$password = $_SERVER['RDS_PASSWORD'];
		$conn = new PDO($dsn, $username, $password);
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	}
	catch(PDOException $e)
	{
		echo $e->getMessage();
	}

?>