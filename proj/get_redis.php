<?php
	require "init_es.php";
	$allKeys = $redis->keys('*');
	$allKeys= implode($allKeys,",");
		if(isset($_POST['submit']))
		{
			$var=trim($_POST['gr']);
			$resp=$redis->lrange($var,0,-1);
		}
?>

<html>
<center>
	<h2>Search Redis Data store</h2>
	<form action="get_redis.php" method="POST">
		<label>
			Search: 
			<input type="text" name="gr" placeholder="Enter Keys of Redis list ">&nbsp;
		</label>
		<label>
			<input type="submit" name="submit">
		</label>
	</form>
	<a href="index.php">Index more messages here</a>&nbsp;&nbsp;<a href="search.php">Search the ES data store here</a><br><br>
	<?php
		echo "<pre>Existing Keys in Redis:&nbsp</pre>".$allKeys;
			if(isset($resp)){
			echo "<h3>Results from Redis</h3>";
				foreach((array)$resp as $re){
					echo $re."<br><br>";
				}
							
			}
		
	?>
</center>
</html>