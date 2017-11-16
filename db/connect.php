<?php
  	try
	{
		$conn = new PDO("sqlsrv:Server=sqlsv-cs667auth.cbpyuvpamt0n.us-east-2.rds.amazonaws.com,1430;Database=sqlauth", "admin", "sqlsv-cs667auth!");
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	}
	catch(PDOException $e)
	{
		echo $e->getMessage();
	}

?>