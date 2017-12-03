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
	  <h3>Submit Seminar</h3>
      <form class="form-horizontal" enctype="multipart/form-data">
      <div class="form-group">

        <div class="col-sm-offset-2 col-sm-10">

          <input type="text" class="form-control" id="title" placeholder="title..">
        </div>
      </div>


	  <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
          <input type="file" name="fileToUpload" id="fileToUpload">
        </div>
      </div>
      <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
			<button type="button" class="btn btn-primary" onclick="location.href='board.php'";;>Back</button>
            <button type="submit" class="btn btn-default">Submit</button>

        </div>
      </div>
    </form>

    </div>
	<div class="col-sm-2 sidenav">

    <?php include("../import/right_side_menu.html"); ?>

	</div>
	</div>

  </div>
</div>

<?php include("../import/footer.html"); ?>
<script>

</script>
</body>
</html>
