<?php 
	$title = "Categories | Taalem Admin";
	include "header.php";
	$msg;
	$upst;
	$dc= new Dataclass();
	$opmd="";
	
	// add category
	if (isset($_POST['btnaddcat'])) {
		$catname = $_POST['catname'];
		$pcatid = $_POST['parentcat'];

		$addct = $dc->saveRecord("insert into category(catname,catparentid) values('$catname','$pcatid')");
		if ($addct['success']) {
			$msg="Category Add Successfully";
			$upst=true;
		}else{
			$msg="Category Add unsuccessfully";
			$upst=false;
		}

	}

	//get category fro update
	if (isset($_GET['action']) and $_GET['action'] == "update") {
		$catidforup = $_GET['id'];
		$singlecat = $dc->getRow("select catname,catparentid from category where catid='$catidforup'");
		$opmd = "$('#upcat').modal('show');";
	}

	// update category
	if (isset($_POST['btnupcat'])) {
		$ccatid = $_POST['currentcatid'];
		$catname = $_POST['catname'];

		$upct = $dc->saveRecord("update category set catname='$catname' where catid='$ccatid'");
		if ($upct['success']) {
			$msg="Category update Successfully";
			$upst=true;
			// header("refresh: 2,categories.php");
		}else{
			$msg="Category update unsuccessfully";
			$upst=false;
		}

	}

	$cattab = $dc->getTable("SELECT c.catid, c.catname, c.catparentid, p.catname parent_title FROM category c LEFT JOIN category p ON c.catparentid = p.catid");
	$pcat = $dc->getTable("Select catid,catname from category where catparentid=0");
?>

<div class="content-wrapper">
	<div class="container-fluid">
		<ol class="breadcrumb">
	        <li class="breadcrumb-item">
	          <a href="index.php">Dashboard</a>
	        </li>
	        <li class="breadcrumb-item active ">Categories</li>
	    </ol>
	    <div class="row text-center">
				<div class="col-md-6 offset-md-3" id="stmsgbox">
					<?php if (isset($msg) and $upst == false): ?>
						<div class="alert alert-danger" role="alert">
						  <?= $msg ?>
						</div>
						<?php endif ?>
					<?php if (isset($msg) and $upst == true): ?>
						<div class="alert alert-success" role="alert">
						  	<?= $msg ?>
						</div>
					<?php endif ?>
				</div>
			</div>
      	<div class="row">
        	<div class="col-12">
          		<div class="card mb-3">
			        <div class="card-header">
			        	<div class="row">
			        		<div class="col-md-6 pt-2">
			        			<i class="fa fa-table"></i> <b>Categories</b>
			        		</div>
			        		<div class="col-md-6 text-right">
			        			<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addcat">Add New</button>
			        		</div>
			        	</div>
			          </div>
			        <div class="card-body">
			          <div class="table-responsive">
			            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
			              <thead>
			                <tr class="text-center tblheading">
			                  <th>Category Name</th>
			                  <th>Parent Category Name</th>
			                  <th>Associated Course</th>
			                  <th>Action</th>
			                </tr>
			              </thead>
			              <tbody class="text-center">
			              	<?php 
			              		while ($rw=mysqli_fetch_assoc($cattab)) {
			              	 ?>
			                <tr>
			                	<td><?= $rw['catname'] ?></td>
			                	<?php if ($rw['parent_title'] == '') {
			                		echo '<td> No Parent</td>';
			                	}else{
			                		echo '<td>'.$rw['parent_title'].'</td>';
			                	} ?>

			                	<td>
			                		<?php 
			                			$ac = $dc->getRow("select count(courseid) as totalc from course where catid='$rw[catid]'");
			                			echo $ac['totalc'];
			                		 ?>

			                	</td>
			                	<td class="text-center" style="font-size: 20px"><a href="categories.php?id=<?= $rw['catid'] ?>&action=update" class="mx-1 a-black" title="Update"><i class="fa fa-pencil"></i></a> </td>
			                </tr>
			                <?php } ?>
			              </tbody>
			            </table>
			          </div>
			        </div>
			    </div>
        	</div>
      	</div>
	</div>
</div>

<!-- Add Category Modal -->
<div class="modal fade" id="addcat" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add New Categories</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
       <form action="" method="post">
       	
       	<div class="form-group">
       		<label for="">Category Name</label>
       		<input type="text" name="catname" class="form-control" required />
       	</div>
       	<div class="form-group">
       		<label for="">Parent Category</label>
       		<select name="parentcat" id="" class="form-control">
       			<option value="0">No Parent</option>
				<?php 
					while ($catrw = mysqli_fetch_assoc($pcat)) {
					    echo '<option value="'.$catrw['catid'].'">'.$catrw['catname'].'</option>';
					}

				 ?>
       		</select>
       	</div>
       
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" name="btnaddcat" class="btn btn-primary">Add</button>
        </form>
      </div>
    </div>
  </div>
</div>

<?php if (isset($_GET['action']) and $_GET['action'] == "update") { ?>
<!-- Update Category Modal -->
<div class="modal fade" id="upcat" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Update Categories</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
       <form action="categories.php" method="post">
       	<input type="hidden" name="currentcatid" value="<?= $catidforup ?>">
       	<div class="form-group">
       		<label for="">Category Name</label>
       		<input type="text" value="<?= $singlecat['catname'] ?>" name="catname" class="form-control" required />
       	</div>
       	<div class="form-group">
       		<label for="">Parent Category</label>
       		<select name="parentcat" id="" class="form-control" disabled>
       			<option value="0" <?php if($singlecat['catparentid'] == 0){echo 'selected'; } ?>>No Parent</option>
				<?php
					$pcat2 = $dc->getTable("Select catid,catname from category where catparentid=0");
					while ($catrw = mysqli_fetch_assoc($pcat2)) {
						$selected="";
						if ($singlecat['catparentid'] == $catrw['catid']) {
							$selected = 'selected';
						}
					    echo '<option value="'.$catrw['catid'].'" '.$selected.'>'.$catrw['catname'].'</option>';
					}

				 ?>
       		</select>
       	</div>
       
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" name="btnupcat" class="btn btn-primary">Update</button>
        </form>
      </div>
    </div>
  </div>
</div>
<?php } ?>

<?php 
	include "footer.php";
?>
<script>
	$(document).ready(function(){
		<?php echo $opmd; ?>
		$("#stmsgbox").fadeOut(5000);
	});
</script>
</body>
</html>