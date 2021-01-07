<?php
	session_start();
	include_once("../resources/connection.php");
	$title="Club";
	$desc="Show All Clubs";
	if(!isset( $_SESSION['aid']))
	{
		header("location:login.php");
	}

	if(isset($_REQUEST['scid']))
	{
		$cid=$_REQUEST['scid'];
		$updqry="UPDATE `tblclub` SET `Status`= 1 - `Status` WHERE `ClubID`=$cid";
		mysqli_query($con,$updqry) or die(mysqli_error($con));
	}

	$qry="select * from tblclub";
	$r=mysqli_query($con,$qry) or die(mysqli_error());
	
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
											<!-- content to be written here -->
											<div class="card-block">
												<div class="dt-responsive table-responsive">
													<table id="order-table" class="table table-striped table-bordered nowrap">
														<thead>
															<tr>
																<th>Name</th>
																<th>Status</th>
																<th>City</th>
																<th>Image</th>
																<th>Address</th>
																<th>LocationURL</th>
																<th>View More</th>
															</tr>
														</thead>
														<tbody>
															<?php
																if(mysqli_num_rows($r)>0){
															        while($ROW=mysqli_fetch_array($r,MYSQLI_NUM)){
															?>
																<tr>
																	<td><?=$ROW['1']?></td>
																	<td>
																		<a href="club.php?scid=<?= $ROW[0]?>">
																		<?php 
																			if($ROW['Status'])
																				echo "Block";
																			else
																				echo "Active";
																		?>
																		</a>
																	</td>
																	<td><?=$ROW['3']?></td>
																	<td>
																		<img src="../files/image/<?= $ROW['4']?>" height="50px" width="50px"/>
																	</td>
																	<td><?=$ROW['5']?></td>
																	<td><?=$ROW['6']?></td>
																	<td><a href="club_info.php?cid=<?= $ROW['0'] ?>">view more</a></td>
																</tr>
															<?php
															        }
															    }
															?>
														</tbody>
														<tfoot>
															<tr>
																<th>Name</th>
																<th>Status</th>
																<th>City</th>
																<th>Image</th>
																<th>Address</th>
																<th>LocationURL</th>
																<th>View More</th>
															</tr>
														</tfoot>
													</table>
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
