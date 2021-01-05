<?php

$connect = new PDO("mysql:host=localhost;dbname=konacno", "root", "");

$query = "SELECT * FROM muzej WHERE category !=2 and year BETWEEN '".$_POST["minimum_range"]."' AND '".$_POST["maximum_range"]."' ORDER BY year ASC";

$statement = $connect->prepare($query);

$statement->execute();

$result = $statement->fetchAll();

$total_row = $statement->rowCount();

$output = '
<h4 align="center">Total Item - '.$total_row.'</h4>
<div class="row">
';
if($total_row > 0)
{
	foreach($result as $row)
	{
		$output .= '
		<div class="col-md-2">
			<div >
				<img src="images/'.$row["cover_photo"].'" class="img-responsive img-thumnai img-circle" />
				<h4 align="center">'.$row["title"].'</h4>
				<h3 align="center" class="text-danger">'.$row["year"].'</h3>
				<br />
			</div>
		</div>
		';
	}
}
else
{
	$output .= '
		<h3 align="center"></h3>
	';
}

$output .= '
</div>
';

echo $output;

?>
