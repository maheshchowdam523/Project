<?php
	require "init_es.php";
		if(isset($_POST['submit']))
		{
			if(empty(trim($_POST['msg'])))
			{
				$fai='Message cannot be empty';
			}
			else
			{
				$values = [
					'index' => 'mydb',
					'type' => 'mytb',
					'body' => ['message' => trim($_POST['msg'])]
				];
				try{
					$response = $es->index($values);
					//print_r($response);
					$redis->lpush(trim($_POST['redis']),trim($_POST['msg']));
				if($response['created']>=1)
					$suc= 'Message indexed successfully to ES and Message added to Redis list';
				else
					print_r($response);
				}
				catch(Exception $e)
				{
					//exception $e is set
				}
			}	
		}
?>

<html>
<center>
	<h2>Index a document to ES and Redis</h2>
	<form action="index.php" method="POST">
		<label>
			Enter you message below: <br>
			<pre><?php 
					if (isset($suc))
						{echo $suc;}
					else if(isset($fai))
						echo $fai;
					else if(isset($e))
						print_r($e->getMessage());
				?></pre><br>
			<textarea name="msg" rows="4" cols="50"></textarea><br><br>
		</label>
		<label>
			Enter key for Redis List:<br><br><input type="text" name="redis">
		</label>
		<label>
			<input type="submit" name="submit">
		</label>
	</form>
	<a href="search.php">Search the ES data store here</a> &nbsp;&nbsp;
	<a href="get_redis.php">Get the Redis data</a>
	<?php
		$allKeys = $redis->keys('*');
		$allKeys= implode($allKeys,",");
		echo "<pre>Existing Keys in Redis:&nbsp</pre>".$allKeys;
	?>
</center>
</html>