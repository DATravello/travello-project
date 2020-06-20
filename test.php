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