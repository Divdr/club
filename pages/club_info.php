<?php
	session_start();
	include_once("../resources/connection.php");
	$title="Club Info";
	$desc="Shows the club's all info";

	if(!isset($_SESSION['aid']))
	{
		header("location:login.php");
	}

	if(isset($_GET['cid'])){
		$cid=$_GET['cid'];
		$qry="select * from tblclub where ClubID=$cid";
		$arr=mysqli_query($con,$qry)or die(mysqli_error($con));
		$data=mysqli_fetch_row($arr);

		$qry1="select * from tblclubimages where ClubID=$cid";
		$arr1=mysqli_query($con,$qry1) or die(mysqli_error($con));

	}else
		header("location:club.php");
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
											<i class="feather icon-home bg-c-blue"></i>
											<div class="d-inline">
												<h5><?= $title?></h5>
												<span><?= $desc ?></span>
											</div>
										</div>
									</div>
								</div>
							</div>
						
							<!-- CB starts -->
							<div class="pcoded-inner-content">
								<div class="main-body">
									<div class="page-wrapper">
										<div class="page-body">
											<div class="card">
												<div class="card-header">
													
												</div>
												<div class="card-body">
													<div class="m-l-50 col-md-12">
														<img src="../files/image/<?= $data['4'] ?>" class="img-450"><br>
														<span class="m-l-50"><h2 style="font-weight: 600"><?= $data['1'] ?></h2></span>
													</div>
												</div>
												<div class="m-l-50 m-t-20 col-sm-12 col-xl-8">
													<dl class="dl-horizontal row">
														<dt class="col-sm-3 m-t-5">Address</dt>
														<dd class="col-sm-9 m-t-5"><?= $data['5'] ?></dd>
														<dt class="col-sm-3 m-t-5">City</dt>
														<dd class="col-sm-9 m-t-5"><?= $data['4'] ?></dd>
														<dt class="col-sm-3 m-t-5">State</dt>
														<dd class="col-sm-9 m-t-5"><?= $data['3'] ?></dd>
														<dt class="col-sm-3 m-t-5">URL</dt>
														<dd class="col-sm-9 m-t-5"><a href="http://<?=$data['6']?>" target="_blank"><?= $data['6'] ?></a></dd>
													</dl>
												</div>
												<div class="m-l-50">
													<div class="card-header">
														<h5 style="font-size: 1.5em">Images</h5>
													</div>
													<div class="card-block">
														<div class="row">
															<?php
																while($data1=mysqli_fetch_array($arr1)){
															?>
																<div class="col-md-4 col-lg-4">
																	<img src="../files/image/<?= $data1['ImageURL'] ?>"class="img-fluid">
																</div>
															<?php
																}
															?>
														</div>
													</div>
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
