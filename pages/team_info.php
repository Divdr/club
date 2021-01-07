<?php
	session_start();
	include_once("../resources/connection.php");
	$title="Tournament Info";
	$desc="Shows the tournament's all info";

	if(!isset($_SESSION['aid']))
	{
		header("location:login.php");
	}

	if(isset($_GET['trid'])){
		$trid=$_GET['trid'];
		$qry="select * from tblteamreg where TeamRegID=$trid";
		$r=mysqli_query($con,$qry);
		$ROW=mysqli_fetch_row($r);

		$qry1="select p.*,tp.* from tblteamplayer tp join tblplayer p on tp.PlayerID=p.PlayerID where tp.TeamID=$trid";
		$r1=mysqli_query($con,$qry1);
	}else
		header("location:team.php");
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
													<h5 style="font-weight: 400;font-size: 2em"><?=  $ROW['2'] ?></h5>
												</div>
												<div class="card-body">
													<div class="card-header">
														<h5 style="font-size: 1.2em;margin-bottom: 10px;">Players</h5>
													</div>
													<div class="card-block row">
														<?php
															while($data=mysqli_fetch_array($r1)){
																// print_r($data);
														?>
															<div class="col-md-2">
																<img src="../files/image/<?= $data['ProfileImage'] ?>" height="200px" width="180px">
																<h4 class="p-l-40"><?= $data['UserName'] ?></h4>
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
