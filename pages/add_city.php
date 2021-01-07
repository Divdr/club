<?php
	session_start();
	include_once("../resources/connection.php");
	$title="City";
	$desc="This is the description of City";
	if(!isset( $_SESSION['aid']))
	{
		header("location:login.php");
	}
	$err="";
	$qry="select * from tblstate";
	$data=mysqli_query($con,$qry) or die(mysqli_error());
	if(isset($_REQUEST['btncity']))
	{
		$city=$_REQUEST['city'];
		$state=$_REQUEST['state'];
		if($city!="" && $state>0)
		{
			$qry="insert into tblcity values (null,'$city',$state)";
			mysqli_query($con,$qry)or die("Error In Insert");
			header("location:city.php");
		}
		else
		{
			$err="Please Fill Add The Fields";
		}
	}
?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<title><?=$title?></title>

		<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
		<meta http-equiv="X-UA-Compatible" content="IE=edge" />
		
		<?php include_once('topscript.php'); ?>
	</head>
	<body>
		<div class="loader-bg">
			<div class="loader-bar"></div>
		</div>
		<div id="pcoded" class="pcoded">
			<div class="pcoded-overlay-box"></div>
			<div class="pcoded-container navbar-wrapper">
				<?php include_once('nav.php');?>
				<div class="pcoded-main-container">
					<div class="pcoded-wrapper">
						<?php include_once('sidebar.php') ?>
						<div class="pcoded-content">

							<div class="page-header card">
								<div class="row align-items-end">
									<div class="col-lg-8">
										<div class="page-header-title">
											<!-- <i class="feather icon-home bg-c-blue"></i> -->
											<div class="d-inline">
											<h5><?= $title?></h5>
											<span><?= $desc ?></span>
											</div>
										</div>
									</div>
									<div class="col-lg-4">
										<div class="page-header-breadcrumb">
											<ul class=" breadcrumb breadcrumb-title">
												<li class="breadcrumb-item">
													<a class="btn btn-primary" href="city.php">View City</a>
												</li>
											</ul>
										</div>
									</div>
								</div>
							</div>
						
							<!-- CB starts -->
							<div class="pcoded-inner-content">
								<div class="main-body">
									<div class="page-wrapper">
										<div class="page-body">
											<!-- content to be written here -->
											<div class="card col-sm-10">
												<div class="card-header">
													<h5>City Insert</h5>
												</div>
												<div class="card-block">
													<form id="main" method="post">
														<div class="form-group row">
															<label class="col-sm-2 col-form-label">City Name</label>
															<div class="col-sm-10">
																<input type="text" class="form-control" name="city" id="city" placeholder="City Name" required>
																<span class="messages"></span>
															</div>
														</div>
														<div class="form-group row">
															<label class="col-sm-2 col-form-label">State</label>
															<div class="col-sm-10">
																<select name="state" class="form-control" required> 
																	<option value="">Select State</option>
																<?php while($row=mysqli_fetch_array($data)){ ?>
																	<option value="<?= $row[0]?>"><?= $row[1] ?></option>
																<?php } ?>
																</select>
																<span class="messages  alert-warning"><?php if(isset($err)) echo $err;?></span>
															</div>
														</div>
														<div class="form-group row">
															<label class="col-sm-2"></label>
															<div class="col-sm-10">
																<button type="submit" name="btncity" class="btn btn-primary col-sm-10">Add City</button>
															</div>
														</div>
													</form>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
							<!-- CB Ends -->
						</div>
					</div>
				</div>
			</div>
		</div>
		<?php include_once('Bottom.php') ?>
	</body>
</html>
