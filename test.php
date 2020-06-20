<<<<<<< HEAD
<?php
session_start();
include('database/db_config.php')
?>
<?php
       
		$query_tintuc="SELECT * from tintuc"; 
		$result_tintuc=mysqli_query($connection, $query_tintuc);
		$rows_tintuc=mysqli_fetch_array($result_tintuc);
		
	?>

		
		<h5>Danh Sách Tin Tức</h5>
        <div class="card-deck">

			<?php
			//$theloai = $result3->fetch_assoc();
			while($row=@mysqli_fetch_array($result_tintuc)) {
                $rows[] = $row;
                foreach($rows as $row1){ 
                    echo $row1['HinhAnh'];
                }
				//echo $row['HinhAnh'];
			// 	while($row_tin = $result_tintuc->fetch_assoc()) {
			// 		if($row['MaTheLoai']==$row_tin['MaTheLoai'])
			// 		{
			// 			?>
			
						<?php
					}
					
				//}
			//  }
?>
=======
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Travello</title>
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="css/animate/animate.min.css">
    <link rel="stylesheet" href="css/font-awesome-4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="css/bootstrap-4.5.0-dist/css/bootstrap.min.css">
    <link href="https://cdn.jsdelivr.net/npm/froala-editor@latest/css/froala_editor.pkgd.min.css" rel="stylesheet" type="text/css" />

    <!-- Create a tag that we will use as the editable area. -->
    <!-- You can use a div tag as well. -->


    <!-- Include Editor JS files. -->
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/froala-editor@latest/js/froala_editor.pkgd.min.js"></script>

    <!-- Initialize the editor. -->

    <!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css"> -->
</head>

<body>
<textarea></textarea>
    <script>
        new FroalaEditor('textarea');
    </script>

</body>

</html>
>>>>>>> 4525edfa2c5407c549ecb006f17a89dbf96cc8c3
