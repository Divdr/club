<?php
	session_start();
	include_once("../resources/connection.php");
	$title="State";
	$desc="This is the description of State";
	if(!isset( $_SESSION['aid']))
	{
		header("location:login.php");
	}
	if(isset($_REQUEST['btnstate']))
	{
		$state=$_REQUEST['state'];
		if($state!="")
		{
			$qry="insert into tblstate values (null,'$state')";
			mysqli_query($con,$qry)or die("Error In Insert");
			header("location:state.php");
		}
		else
		{

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
													<a class="btn btn-primary" href="state.php">View State</a>
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
											<div class="card">
												<div class="card-header">
													<h5>State Insert</h5>
												</div>
												<div class="card-block">
													<form id="main" method="post" novalidate>
														<div class="form-group row">
															<label class="col-sm-2 col-form-label">State Name</label>
															<div class="col-sm-10">
																<input type="text" class="form-control" name="state" id="state" placeholder="State Name">
																<span class="messages"></span>
															</div>
														</div>
														<div class="form-group row">
															<label class="col-sm-2"></label>
															<div class="col-sm-10">
																<button type="submit" name="btnstate" class="btn btn-primary col-sm-10">Add State</button>
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
