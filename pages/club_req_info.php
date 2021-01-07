<?php
	session_start();
	include_once("../resources/connection.php");
	$title="Club Request Info";
	$desc="Shows the club request information send by the club";
	if(!isset( $_SESSION['aid']))
	{
		header("location:login.php");
	}

	if(isset($_GET['reqres'])){
		$response=$_GET['reqres'];
		$vreqid=$_GET['vreqid'];
		$qry="update tblclubverireq set Status=$response where ClubVerificationReqID=$vreqid";
		mysqli_query($con,$qry);
		header("location:club_veri_req.php");
	}

	$cid=$_GET['cid'];
	$qry="select c.*,vr.* from tblclub c join tblclubverireq vr on vr.ClubID=c.ClubID where c.ClubID=$cid";
	$cl=mysqli_query($con,$qry) or die(mysqli_error($con));

	$qry="select cs.*,s.Description,s.SportsID from tblclubsports cs join tblsports s on s.SportsID=cs.SportID where cs.ClubID=$cid";
	$r=mysqli_query($con,$qry) or die(mysqli_error($con));
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
									<div class="col-lg-4">
										<div class="page-header-breadcrumb">
											<ul class=" breadcrumb breadcrumb-title">
												<li class="breadcrumb-item">
													<a href="index.html"><i class="feather icon-home"></i></a>
												</li>
												<li class="breadcrumb-item"><?= $link ?> </li>
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
											<div class="card">
												<div class="container">
													<div class="card-header">
														<h5>Club Verification Request Information</h5>
													</div>	
													<div class="card-block">
														<?php
															while($ROW=mysqli_fetch_array($cl)){
														?>

														<div class="row">
															<div class="col-md-6 col-lg-6" style="text-align: center;">
																<img class="img-fluid. max-width: 100%;height:auto;" src="../files/image/<?= $ROW['ProfileImage']?>" style="border-radius: 50%; height:150px; width:150px;">
																<h2 style="font-weight: 600;margin-top: 15px;"><?= $ROW['Name']  ?></h2>
															</div>
															<div class="col-md-6 col-lg-6">
																<h4 style="font-weight: 600">Address :</h4>
																<p><?= $ROW['Address']  ?></p>
																<h4 style="font-weight: 600">City :</h4>
																<p><?= $ROW['CityID']  ?></p>
																<h4 style="font-weight: 600">State :</h4>
																<p><?= $ROW['States']  ?></p>
																<h4 style="font-weight: 600">URL :</h4>
																<p><a href="<?= $ROW['LocationURL'] ?>"><?= $ROW['LocationURL']  ?></a></p>
															</div>
														</div>
														<div class="col-md-12 col-lg-12">
															<div class="card-header">
																<h5>Sports</h5>
															</div>
															<div class="card-block m-l-50">

																<?php
																	while($ROW1=mysqli_fetch_array($r)){
																?>
																	<code style="padding: 10px;margin:10px;"><?= $ROW1['Description'] ?></code>
																<?php
																	}
																?>
															</div>
														</div>
														<div class="col-md-12" style="margin-bottom: 40px;margin-top: 40px;">
															<?php
																if ($ROW['Status']==1) 
																{
															?>
																	<div class="row col-md-12">
																		<div class="col-md-12" align="center">
																			<label class="btn waves-effect waves-light btn-grd-success form-control btn-round col-md-2">Accepted</label>
																		</div>
																	</div>
															<?php
																}
																elseif($ROW['Status']==2)
																{
															?>
																	<div class="row col-md-12">
																		<div class="col-md-12" align="center">
																			<label class="btn waves-effect waves-light btn-grd-danger form-control btn-round col-md-2">Rejected</label>
																		</div>
																	</div>
															<?php
																}
																else
																{
															?>
																	<div class="row">
																		<div class="col-md-2"></div>
																		<div class="btn col-md-4">
																			<a href="club_req_info.php?reqres=1&vreqid=<?= $ROW['ClubVerificationReqID'] ?>" class="btn waves-effect waves-light btn-success btn-outline-success" style="font-weight: 600;">Verified</a>
																		</div>
																		<div class="btn col-md-4">
																			<a href="club_req_info.php?reqres=2&vreqid=<?= $ROW['ClubVerificationReqID'] ?>" class="btn waves-effect waves-light btn-danger btn-outline-danger" style="font-weight: 600;">Reject</a>
																		</div>
																	</div>
															<?php
																}
															?>
														</div>
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
							<!-- CB Ends -->
						</div>
					</div>
				</div>
			</div>
		</div>
		<?php include_once('Bottom.php') ?>
	</body>
</html>
