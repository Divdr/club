<?php
	session_start();
	include_once("../resources/connection.php");
	$title="Player";
	$desc="This is the description of Player";
	if(!isset( $_SESSION['aid']))
	{
		header("location:login.php");
	}
	if(isset($_REQUEST['spid']))
	{
		$pid=$_REQUEST['spid'];
		$updqry="UPDATE `tblplayer` SET `Status`= 1 - `Status` WHERE `PlayerID`=$pid";
		mysqli_query($con,$updqry) or die(mysqli_error($con));
	}
	if(isset($_REQUEST['pid']))
	{
		$qry="select PlayerID,Name,UserName,ProfileImage,Status,RegistrationDate,CityName,StateName from tblplayer p join tblcity c join tblstate s on p.CityID=c.CityID and s.StateID=c.StateID where PlayerID=".$_REQUEST['pid'];
		$sel=mysqli_query($con,$qry) or die(mysqli_error($con));
		$row=mysqli_fetch_array($sel);
		$arqry="select * from tblachievements where PlayerID=".$_REQUEST['pid'];
		$arsel=mysqli_query($con,$arqry) or die(mysqli_error($con));
		$psqry="select Description from tblplayersports ps join tblsports s on s.SportsID=ps.SportsID";
		$pssel=mysqli_query($con,$psqry) or die(mysqli_error($con));
	}
	
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<title><?= $title?></title>

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

							<!-- <div class="page-header card">
								<div class="row align-items-end">
									<div class="col-lg-8">
										<div class="page-header-title">
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
												</li>
											</ul>
										</div>
									</div>
								</div>
							</div> -->
						
							<!-- CB starts -->
							<div class="pcoded-inner-content">
								<div class="main-body">
									<div class="page-wrapper">
										<div class="page-body">
											<div class="card">
												<div class="card-header">
													<div class="row">
														<div class="col-md-10">
															<h3>Player More Details</h3>
														 </div>
														
														 <a href="">
													 	<h3>
														<?php
															
														?>
														</h3>
														</a> 
													</div>
												</div>
											</div>
											<div class="card">
												<div class="card-block">
													<div class="row">
														<div class="col-md-6">
															<div class="col-lg-4">
																<img src="../files/image/<?= $row[3]?>" width="150px" height="150px" class=img-radius>
															</div>
														</div>
														<div class="col-md-6">
															<div class="col-md-12">
																<b style="font-size: 20px">Player Name:-</b>
																<b style="font-size: 17px"><?= $row['Name'] ?></b>	 
															</div>
															<div class="col-md-12">
																<b style="font-size:20px">UserName:-</b>
																<b style="font-size: 17px"><?= $row['UserName']   ?></b>
															</div>
															<div class="col-md-12">
																<b style="font-size:20px">Registration Date:- </b>
																<b style="font-size: 17px"><?php echo date('d-m-Y',strtotime($row['RegistrationDate'])); ?></b>
															</div>
															<div class="col-md-12"><b style="font-size:20px">City/State:- </b>
																<b style="font-size: 17px"><?= $row['CityName']." / ".$row['StateName'] 
																	 ?>
																</b>
															</div>
														</div>
													</div>
												</div>
											</div>
											<div class="page-body">
												<div class="row">
													<div class="col-md-8">
														<div class="card">
															<div class="card-block">
																<div class="col-md-12">
																	<div class="row">
																		<div class="card-header col-md-12" >
																			<h4>Player Achievements</h4>
																		</div>

																		<div class="col-md-12" style="padding:5px" > 
																			<?php while($arrow=mysqli_fetch_array($arsel)) { ?>
																			<div class="row">
																				<div class="col-md-8">
																					<div class="card-header col-md-12">
																						<h5>Title</h5>
																					</div>
																					<div class="col-md-12">
																						<b style="font-size: 19px; margin-left: 10px;"><?= $arrow['Title']  ?></b><hr>
																					</div>
																					<div class="card-header col-md-12">
																						<h5>Description</h5>
																					</div>
																					<div class="col-md-12">
																						<b style="font-size: 19px; margin-left: 10px;"><?= $arrow['Description']  ?></b><hr>
																					</div>
																				</div>
																				<div class="col-md-4">
																					<img src="../files/image/<?= $arrow[3]?>" width="200px" height="250px" class=img-radius>
																				</div>
																			</div>
																			<hr style="border:solid 1px;">
																			<?php } ?>
																		</div>
																	</div>
																</div>
															</div>
														</div>
													</div>
													<div class="col-md-4">
														<div class="card">
															<div class="card-block">
																<div class="col-md-12">
																	<div class="row">
																		<div class="card-header col-md-12">
																			<h4>Player Sports:-</h4><hr style="border:solid 1px;">
																			<?php while($psrow=mysqli_fetch_array($pssel)){ ?>
																			<b style="font-size: 19px; margin-left: 10px;" class="alert alert-danger"><?= $psrow['Description']  ?></b>
																			<?php } ?>
																		</div>
																	</div>
																</div>
															</div>
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
		<script type="text/javascript">
			$(document).ready(function () {
				$('#order-tables').DataTable();
			});
		</script>
	</body>
</html>
