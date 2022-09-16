<?php

/**
 * Handles incident interactions within the app
 *
 * PHP version 5
 *
 * @author Mohd Faeiz
 * @copyright 2015 faeizt
 * @license   http://www.Noahstudio.org/licenses/mit-license.html  MIT License
 *
 */
class incidents
{

    /**
     * The database object
     *
     * @var object
     */
    private $_db;

    /**
     * Checks for a database object and creates one if none is found
     *
     * @param object $db
     * @return void
     */
    public function __construct($db=NULL)
    {
        if(is_object($db))
        {
            $this->_db = $db;
        }
        else
        {
            $dsn = "mysql:host=".DB_HOST.";dbname=".DB_NAME;
            $this->_db = new PDO($dsn, DB_USER, DB_PASS);
        }
    }

    public function save(){
		$client  			= mysqli_real_escape_string($con,htmlspecialchars(trim($_POST['client'])));
		$project  			= mysqli_real_escape_string($con,htmlspecialchars(trim($_POST['project'])));
		$site    			= mysqli_real_escape_string($con,htmlspecialchars(trim($_POST['site'])));
		$address			= mysqli_real_escape_string($con,htmlspecialchars(trim($_POST['address'])));
		$report_channel		= mysqli_real_escape_string($con,htmlspecialchars(trim($_POST['report_channel'])));
		$contact_person		= mysqli_real_escape_string($con,htmlspecialchars(trim($_POST['contact_person'])));
		$contact_no			= mysqli_real_escape_string($con,htmlspecialchars(trim($_POST['contact_no'])));
		$add_info			= mysqli_real_escape_string($con,htmlspecialchars(trim($_POST['add_info'])));
		$title 				= mysqli_real_escape_string($con,htmlspecialchars(trim($_POST['title'])));
		$description		= mysqli_real_escape_string($con,htmlspecialchars(trim($_POST['description'])));
		$sn					= mysqli_real_escape_string($con,htmlspecialchars(trim($_POST['sn'])));
		// $asset				= mysqli_real_escape_string($con,htmlspecialchars(trim($_POST['asset'])));
		$service_type		= mysqli_real_escape_string($con,htmlspecialchars(trim($_POST['service_type'])));
		$category			= mysqli_real_escape_string($con,htmlspecialchars(trim($_POST['category'])));
		$machine			= mysqli_real_escape_string($con,htmlspecialchars(trim($_POST['machine'])));
		$sla	 			= mysqli_real_escape_string($con,htmlspecialchars(trim($_POST['sla'])));
		$severity 			= mysqli_real_escape_string($con,htmlspecialchars(trim($_POST['severity'])));
		$recurrence 		= mysqli_real_escape_string($con,htmlspecialchars(trim($_POST['recurrence'])));

    	$sql = "INSERT INTO users(Username, ver_code)
                VALUES(:email, :ver)";

	            $stmt->bindParam(":email", $u, PDO::PARAM_STR);
	            $stmt->bindParam(":ver", $v, PDO::PARAM_STR);
	            $stmt->execute();
	            $stmt->closeCursor();   
	                         
    }

}


?>