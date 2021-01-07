<?php
	session_start();
	include_once("../resources/connection.php");
	$title="Club verifivation request";
	$desc="Shows all the verifivation reuestion are send by the club";
	if(!isset( $_SESSION['aid']))
	{
		header("location:login.php");
	}

	$qry="select req.*,c.*,a.AdminID,a.Username from tblclubverireq req join tblclub c on c.ClubID=req.ClubID join tbladmin a on req.AdminId=a.AdminID where req.Status!=1";  
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
											<div class="card-block">
												<div class="dt-responsive table-responsive">
													<table id="order-table" class="table table-striped table-bordered nowrap">
														<thead>
															<tr>
																<th>Club Name</th>
																<th>Status</th>
																<th>Respondend Admin</th>
																<th>Proof</th>
																<th>View More</th>
															</tr>
														</thead>
														<tbody>
															<?php
																if(mysqli_num_rows($r)>0){
															        while($ROW=mysqli_fetch_array($r)){
															?>
																<tr>
																	<td><?=$ROW['Name']?></td>
																	<td>
																		<?php
																			if($ROW['Status']==0)
																				echo "Unseen";
																			else
																				echo "Rejected";
																		?>
																	</td>
																	<td><?=$ROW['Username']?></td>
																	<td>
																		<img src="../files/image/<?= $ROW['Proof']?>" height="50px" width="50px"/>
																	</td>
																	<td><a href="club_req_info.php?cid=<?= $ROW['0'] ?>">view more</a></td>
																</tr>
															<?php
															        }
															    }
															?>
														</tbody>
														<tfoot>
															<tr>
																<th>Club Name</th>
																<th>Status</th>
																<th>Respondend Admin</th>
																<th>Proof</th>
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
