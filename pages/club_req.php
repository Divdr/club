<?php
	session_start();
	include_once("../resources/connection.php");
	$title="Club Request";
	$desc="This is the description of Club Request";
	if(!isset( $_SESSION['aid']))
	{
		header("location:login.php");
	}
	/*if(isset($_REQUEST['craid']))
	{
		$pid=$_REQUEST['craid'];
		$updqry="UPDATE `tblclubreqapp` SET `Status`= 1 - `Status` WHERE `ClubReqAppID`=$pid";
		mysqli_query($con,$updqry) or die(mysqli_error($con));
		header("location:club_req.php");
	}*/
	$qry="select * from tblclubreq cq join tblclub c join tblcity tc on c.ClubID=cq.ClubID and tc.CityID=c.CityID";
	$sel=mysqli_query($con,$qry)or die(mysqli_error($con));
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
												<li class="breadcrumb-item"> </li>
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
											<?php while($row=mysqli_fetch_array($sel)) { ?>
											<div class="card">
												<div class="card-block">
													<div class="row">
														<div class="col-md-6">
															<div class="row">
																<div class="col-md-4">
																	<img src="../files/image/<?= $row['ProfileImage']?>" width="150px" height="150px" class="img-radius">
																</div>
																<div class="col-md-8">
																	<h4 style="text-decoration: underline;"><?= $row['Name'] ?></h4>
																	<div class="col-md-12">
																		<b style="font-size:20px">Address:-</b>
																		<b style="font-size: 17px"><?= $row['CityName']." . ".$row['Address']   ?></b>
																	</div>
																	<div class="col-md-12">
																		<b style="font-size:20px">URL:-</b>
																		<b style="font-size: 17px"><a href="<?= $row['LocationURL'] ?>"><?= $row['LocationURL'] ?></a></b>
																	</div>	 
																</div>
															</div>
														</div>
														<div class="col-md-6">
															<div class="row">
																<div class="col-md-12">
																	<center class="alert alert-primary"><u>Club Request Details</u></center>
																</div>
																<div class="col-md-12">
																	<b style="font-size:20px">Description:-</b>
																	<b style="font-size: 17px"><?= $row['Description']   ?></b>
																</div>
																<div class="col-md-6">
																	<b style="font-size:20px">Created Date:- </b>
																	<b style="font-size: 17px"><?php echo date('d-m-Y',strtotime($row['CreatedDate'])); ?></b>
																</div>
																<div class="col-md-6">
																	<b style="font-size:20px">Last Date :-</b>
																	<b style="font-size: 17px"><?php echo date('d-m-Y',strtotime($row['LastDate'])); ?></b>
																</div>
															</div>
														</div>
													</div>
												</div>
												<div class="card">
													<div class="card-header">
														<center class="alert alert-primary"><u>Club Requested Player</u></center>
													</div>
													<?php
														$craqry="select p.Name,cra.Resume,cra.Status,cra.ClubReqAppID from tblclubreqapp cra join tblclubreq cr join tblplayer p on p.PlayerID=cra.PlayerID and cr.ClubReqID=cra.ClubReqID where cra.ClubReqID=".$row['ClubReqID'];
														$crasel=mysqli_query($con,$craqry) or die(mysqli_error($con)); 
														while($crarow=mysqli_fetch_array($crasel)){
													?>
													<div class="card-block row">
														<div class="col-md-4">Name :- <?= $crarow['Name'] ?></div>
														<div class="col-md-4">
															Resume :- <a href="../files/PDF/<?= $crarow['Resume'] ?>"><?= $crarow['Resume'] ?></a>		
														</div>
														<div class="col-md-4">  
															<!-- <a href="club_req.php?craid=<?= $crarow['ClubReqAppID'] ?>"> -->
															<?php 
																if($crarow['Status']=="0")
																	echo "Unresponded";
																else if($crarow['Status']=="1")
																	echo "Selected";
																else
																	echo "Rejected";
															?>
															<!-- </a> -->
														</div>
													</div>
													<?php }	?>
												</div>
											</div>
											<?php } ?>
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
