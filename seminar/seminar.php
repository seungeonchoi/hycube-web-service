<!DOCTYPE html>
<html lang="en">

<head>
	<?php include("../import/config.php"); ?>


</head>

<body>


<?php include("../import/header.php"); ?>



<div class="container-fluid text-center">


  <div class="row content">
	<div class="col-sm-2 sidenav">

			<?php include("../import/left_side_menu.html"); ?>
	</div>



    <div class="col-sm-8 text-left">
		<div class="row" >

		  	<div class="col-sm-12 text-left">
				<h3>
					세미나자료입니다.
				</h3>
			</div>
		</div>
		<div class="row" >
			<div class="col-sm-12 text-right">
				<button type="button" class="btn btn-primary" onclick="location.href='seminar_write.php'";;>Write</button>
			</div>
		</div>

		<div class="row" >
			<div class="col-sm-2 text-left">

			</div>
			<div class="col-sm-10 text-right">
				&nbsp;
				<div class="input-group">
      				<input type="text" class="form-control" 					placeholder="Search for...">
      				<div class="input-group-btn">
      				<button class="btn btn-default" type="submit">
        				<i class="glyphicon glyphicon-search">							</i>
      				</button>
    				</div>
    			</div>
			</div>
		</div>
		<div class="row">
			&nbsp;
			<div class="col-sm-12 text-left">

				<div class="list-group">

    					<a href="images/emma.png" download class="list-group-item">
							<div class="row">
									<div class="col-sm-8 text-left">
      									<h4 class="list-group-item-heading">Hycube에 오신것을 환영합니다.</h4>
      									<p class="list-group-item-text">최승언</p>
									</div>
									<div class="col-sm-4 text-right">
							     		<p class="list-group-item-text">emma.jpg</p>
									</div>
							    </div>


    					</a>

    					<a href="#" class="list-group-item">
      						<h4 class="list-group-item-heading">Second List Group Item Heading</h4>
      						<p class="list-group-item-text">List Group Item Text</p>
    					</a>
    					<a href="#" class="list-group-item">
      						<h4 class="list-group-item-heading">Third List Group Item Heading</h4>
      						<p class="list-group-item-text">List Group Item Text</p>
    				</a>
  					</div>
				</div>
			</div>
		<div class="row">
			<div class="col-sm-12 text-center">
				<ul class="pagination">
					<li class="prev"><a href="#"><<</a></li>
  					<li class="active"><a href="#">1</a></li>
 					<li><a href="#">2</a></li>
  					<li><a href="#">3</a></li>
  					<li><a href="#">4</a></li>
  					<li><a href="#">5</a></li>
					<li class="next"><a href="#">>></a></li>
				</ul>
			</div>
		</div>

    </div>
	<div class="col-sm-2 sidenav">

		<?php include("../import/right_side_menu.php"); ?>

	</div>
	</div>

  </div>
</div>


<?php include("../import/footer.html"); ?>
<script>

</script>
</body>
</html>
