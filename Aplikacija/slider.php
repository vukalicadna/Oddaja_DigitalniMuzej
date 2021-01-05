<?php
$minimum_range = 1800;
$maximum_range = 2021;
?>


<html>  
    <head>  
        <title>Letnik</title>  
		<link rel="stylesheet" href="https://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" />
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
		<link rel="stylesheet" href="./styles/slider.css"> 
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>  
		<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>  
		
    </head>  
    <body>  
        <div class="container">  
		
			<h3 alaign="center">Letnik</a></h3><br />
			<br />
			<div class="row">
				<div class="col-md-2">
					<input type="text" name="minimum_range" id="minimum_range" class="form-control" value="<?php echo $minimum_range; ?>" />
				</div>
				<div class="col-md-8" style="padding-top:12px">
					<div id="year_range"></div>
				</div>
				<div class="col-md-2">
					<input type="text" name="maximum_range" id="maximum_range" class="form-control" value="<?php echo $maximum_range; ?>" />
				</div>
			</div>
			<br />
			<div class="load_product" id="load_product"></div>
			<br />
		</div>
    </body>  
</html>  
<script>  
$(document).ready(function(){  
    
	$( "#year_range" ).slider({
		range: true,
		min: 1800,
		max: 2021,
		values: [ <?php echo $minimum_range; ?>, <?php echo $maximum_range; ?> ],
		slide:function(event, ui){
			$("#minimum_range").val(ui.values[0]);
			$("#maximum_range").val(ui.values[1]);
			load_product(ui.values[0], ui.values[1]);
		}
	});
	
	load_product(<?php echo $minimum_range; ?>, <?php echo $maximum_range; ?>);
	
	function load_product(minimum_range, maximum_range)
	{
		$.ajax({
			url:"db/database.php",
			method:"POST",
			data:{minimum_range:minimum_range, maximum_range:maximum_range},
			success:function(data)
			{
				$('#load_product').fadeIn('slow').html(data);
			}
		});
	}
	
});  
</script>

