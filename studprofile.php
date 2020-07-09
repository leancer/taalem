		<div class="titlepage">
			<div class="row">
				<div class="col-md-6">
					<h1><?= $regdt['username'] ?></h1>
				</div>
				<div class="col-md-6 text-right">
					<?php if ($_SESSION['regid'] == $regid): ?>
					<a href="editstuprofile.php" class="btn btn-custom">Edit Profile</a>
					<?php endif ?>
				</div>
			</div>
		</div> 

		<div class="container mt-5">
			<div class="row inspro">
				<div class="col-md-2">
					<img class="rounded-circle wow rollIn" src="<?= $userd['photo'] ?>">
				</div>

				<div style="border-bottom:5px solid #676767;width:750px;border-radius: 2px;">
					<h3 class="mt-5 wow flipInX" style="font-weight: bold;font-size: 32px;"><?= $userd['name'] ?></h3>
					
					
					<h5 class="text-muted">Since <?= date('Y',strtotime($regdt['regdate'])); ?></h5>
					<h5 class="text-muted fs-1-5">
						<i class="fas fa-transgender mr-2 prohead" ></i>
						<span class="mr-3">
							<?php if($userd['gender'] == 'm'){echo "Male";}else{echo "Female";} ?>
						</span>
						<i class="fas fa-globe mr-2 prohead"></i><span>Navsari</span>
					</h5>
				</div>
			</div>

			<div class="row">
				<div class="col-md-2">
					
				</div>

				<div class="col-md-10 mt-3 wow fadeIn">
					<div class="prodetail">

						<div>
							<p class="text-muted" style="font-size: 17px;vertical-align: top;margin: 0px">About Me</p>
							<div style="font-size: 20px;width:650px;">
								<?php
								if ($userd['about'] == '') {
									echo "<p>Not write Yet!</p>";
								}else{
									echo $userd['about'];
								}
								?>
							</div>
						</div>
					</div>
				</div>
				
				

			</div>
		</div>



