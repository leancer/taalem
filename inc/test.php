<?php 

	/**
	 * summary
	 */
	class Dataclass
	{
	    /**
	     * summary
	     */
	    public function __construct()
	    {
	        
	    }
	    public function getTable($query)
	    {
	    	$conn = mysqli_connect("localhost","root","","academydb") or die("not connect");
	    	$tab=mysqli_query($query,$conn);
	    	mysql_close();
	    	echo $tab;
	    }
	    public function getRow($query)
	    {
	    	$conn = mysqli_connect("localhost","root","","academydb") or die("not connect");
	    	$tab=mysqli_query($query,$conn);
	    	$row = mysqli_fetch_assoc($tab);
	    	mysql_close();
	    	echo $row;
	    }
	    public function saveRecord($query)
	    {
	    	$conn = mysqli_connect("localhost","root","","academydb") or die("not connect");
	    	$res=mysqli_query($query,$conn);
	    	mysql_close();
	    	echo $res;
	    }

	}

 ?>