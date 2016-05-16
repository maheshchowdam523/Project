<?php
	require "init_es.php";
		if(isset($_POST['submit']))
		{
				$values = [
					'index' => 'mydb',
					'type' => 'mytb',
					'body' => [
						'query' => [
							'match' => [
								'message' => $_POST['search']
							]
						]
					]
				];
				$response = $es->search($values);
				$response=$response['hits']['hits'];
				//print_r($response);
		}
?>

<html>
<center>
	<h2>Search Data store</h2>
	<form action="search.php" method="POST">
		<label>
			Search: 
			<input type="text" name="search">&nbsp;
		</label>
		<label>
			<input type="submit" name="submit">
		</label>
	</form>
	<a href="index.php">Index more messages here</a>&nbsp;&nbsp;<a href="get_redis.php">Get the Redis data</a><br><br>
	<?php
		if(isset($response)){
			echo "<h3>Search results</h3>";
			foreach($response as $r){
			echo "<pre>".$r['_id']."</pre>".$r['_source']['message']."<br><br>";				
			}
		}
	?>
</center>
</html>