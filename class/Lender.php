<?php
/**
 * Lender class holds the lender information
 */
class Lender{
    //Lender attributes
    private $lenderTable = "lender";      
    public $id;
    public $email;
    public $password;
    public $loanId;
    private $conn;
    
    /**
     * Connects to Database
     * @param mixed $db
     */
    public function __construct($db){
        $this->conn = $db;
    }	

    /**
     * Validates the lender
     * @param mixed $lenderId
     * @param mixed $loanId
     * @return bool
     */
    public function validateLender($lenderId,$loanId):bool{	
		$stmt = $this->conn->prepare("SELECT loanid FROM ".$this->lenderTable." WHERE id = ? and loanid = ? ");
		$stmt->bind_param("ii", $lenderId,$loanId);						
		$stmt->execute();	
		$result = $stmt->get_result();
        if($result->num_rows > 0){ 
           return true;
            }
            else{
                echo "Please check your loan and lender information";
            }
        $stmt->close();
		return false;	
	}	
}
?>