

<?php 

include 'dataclass.php';
$dc = new Dataclass();
if (isset($_POST['parct'])) {

	$parct = $_POST['parct'];

	$subcat = $dc->getTable("select catid,catname from category where catparentid='$parct'");
	$res = "<label>SubCategory</label><select name='subcat' class='form-control'><option value='no'>No SubCategory</option>";

	while ($subcatrw = mysqli_fetch_assoc($subcat)) {
	    $res .= "<option value='".$subcatrw['catid']."'>".$subcatrw['catname']."</option>";
	}
	$res .= "</select>";

	echo $res;
	
}

 ?>