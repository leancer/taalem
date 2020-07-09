<?php 

/**
 * summary
 */
class Dataclass
{
    /**
     * summary
     */
    private $conn;
    

    public function __construct()
    {
        $this->conn = mysqli_connect("localhost","root","","academydb") or die("Connection Fails");
    }
    public function getConn()
    {
    	return $this->conn;
    }

    public function getTable($query)
    {
    	$table = mysqli_query($this->conn,$query);

    	return $table;
    }

    public function getRow($query)
    {
    	$table = mysqli_query($this->conn,$query);
    	$row = mysqli_fetch_assoc($table);
    	return $row;
    }

    public function saveRecord($query)
    {	
    	$res=mysqli_query($this->conn,$query);
	    if ($res) {
	    	return array("success" => true);
	    }else{
	    	$error = mysqli_error($this->conn);
	    	return array("success" => false,"error" => $error);
	    }
    }
    public function checkExUser($query)
    {
    	$res = mysqli_query($this->conn,$query);
    	if (mysqli_num_rows($res) > 0) {
    		return false;														
    	}else{
    		return true;
    	}
    }
    public function deleteRecord($query)
    {
    	$res=mysqli_query($this->conn,$query);
    	return $res;
    }
    public function getDp($regid,$usertype)
    {
        if ($usertype=="student") {
            $studquery = "select photo from student where regid='$regid'";
            $dp = $this->getRow($studquery);
            return $dp['photo'];
        }else{
            $insquery = "select photo from instructor where regid='$regid'";
            $dp = $this->getRow($insquery);
            return $dp['photo'];
        }
    }

    public function __destruct()
    {
    	mysqli_close($this->conn);
    }
}


class Pagination
{
    public $number_of_pages = null;

    public function getPagQuery($query,$nor,$currentpage)
    {
        $dc = new Dataclass();

        $res = $dc->getTable($query);
        $num_of_rows = mysqli_num_rows($res);

        $this->number_of_pages = ceil($num_of_rows/$nor);

        $per_page_result = ($currentpage-1)*$nor;

        $newq = $query." limit ".$per_page_result.",".$nor;
        return $newq;   
    }

    public function getPagelink($searchp,$page)
    {
        $respag="";

        if (($page-1) != 0) {
            $pp = $page-1;
            $respag =  '<li class="page-item"><a class="page-link" href="'.$searchp.'p='.$pp.'">Previous</a></li>'; 
        }else{
            $respag = '<li class="page-item disabled"><a class="page-link" href="#" tabindex="-1">Previous</a></li>';
        }

        for ($i = 1; $i <= $this->number_of_pages ; $i++) {
            if ($page == $i) {
                $respag .= '<li class="page-item active"><a class="page-link" href="'.$searchp.'p='.$i.'">'.$i.'</a></li>';    
            }else{
                $respag .= '<li class="page-item"><a class="page-link" href="'.$searchp.'p='.$i.'">'.$i.'</a></li>';
            }
        }

        if (($page+1) < $this->number_of_pages) {
            $np = $page+1;
            $respag .=  '<li class="page-item"><a class="page-link" href="'.$searchp.'p='.$np.'">Next</a></li>';
        }else{
            $respag .= '<li class="page-item disabled"><a class="page-link" href="#" tabindex="-1">Next</a></li>';
        }
        return $respag;
    }
}

    

 ?>