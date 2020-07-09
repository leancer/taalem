<p id="regid" style="display: none;"><?php echo $_SESSION['regid']; ?></p>

<script src="../assests/libs/jquery/jquery-3.2.1.min.js"></script>
	<script src="../assests/libs/bootstrap/js/umd/popper.min.js"></script>
	<script src="../assests/libs/bootstrap/js/bootstrap.min.js"></script>
	<script src="../assests/libs/jqueryui/jquery-ui.min.js"></script>
	<script src="../assests/libs/animatecss/wow.min.js"></script>
	<script src="../assests/libs/tinymce/tinymce.min.js"></script>
	<script src="../assests/libs/tinymce/init-tinymce.js"></script>
	<script src="../assests/libs/chartjs/Chart.min.js"></script>
	<script src="../assests/libs/datatable/datatables.min.js"></script>
	<script src="../assests/js/bar.js"></script>
	<!-- <script src="assests/libs/particles/particles.min.js"></script> -->
	<script src="../assests/js/main.js"></script>
	<script src="../admin/js/buttons.bootstrap4.min.js"></script>
      <script src="../admin/js/buttons.flash.min.js"></script>
      <script src="../admin/js/buttons.html5.min.js"></script>
      <script src="../admin/js/buttons.print.min.js"></script>
      <script src="../admin/js/pdfmake.min.js"></script>
      <script src="../admin/js/vfs_fonts.js"></script>
      <script src="../admin/js/buttons.colVis.min.js"></script>
      <script src="../admin/js/dataTables.buttons.min.js"></script>

	<script type="text/javascript">
		function showMsg() {
		$.ajax({
			url: "../inc/view_notification.php",
			type: "POST",
			data:{ regid : '<?php echo $_SESSION['regid'] ?>' },
			success: function(data){
				$("#indi").remove();
				$("#amsgbox").html(data);
			},
			error: function(){}           
		});
	 }
	</script>