<?php
include 'config/connection.php';
?>
<table class="data">
	<tr>
		<th>Item Name</th>
		<th>Item Name</th>
        <th>Item Name</th>
	</tr>
	<?php 
    $query="SELECT a.*, b.itemName 
    FROM temp_order a 
    INNER JOIN item b ON a.itemID=b.itemID 
    WHERE 1 ";
    $result = mysqli_query($dbc, $query);
	while($d = mysqli_fetch_array($result)){
	?>
	<tr>
		<td><?php echo $d['itemName'] ?></td>
		<td><?php echo $d['itemName'] ?></td>
		<td><?php echo $d['itemName'] ?></td>
	</tr>
	<?php } ?>
</table>