<?php
/**
 * This class is used for creating loans
 */
class Loans{   
    //Loan attributes
    private $loansTable = "loans";      
    public $id;
    public $LenderId;
    public $Amount;
    public $Rate;
    public $duration;
    public $borrowerId;   
    public $isClosed; 
	public $Date; 
    private $conn;
	
	/**
	 * Connects to database
	 * @param mixed $db
	 */
    public function __construct($db){
        $this->conn = $db;
    }	

	/**
	 * Read from loans database table
	 * @return mixed
	 */
	function read(){	
		if($this->id) {
			$stmt = $this->conn->prepare("SELECT * FROM ".$this->loansTable." WHERE id = ?");
			$stmt->bind_param("i", $this->id);					
		} else {
			$stmt = $this->conn->prepare("SELECT * FROM ".$this->loansTable);					
		}		
		$stmt->execute();	

		$result = $stmt->get_result();
		return $result;	
	}

	/**
	 * create a loan entry
	 * @return bool
	 */
	function create(){
		//insert query
		$stmt = $this->conn->prepare("
			INSERT INTO ".$this->loansTable."(`id`, `LenderId`, `Amount`, `Rate`, `duration`,`borrowerId`,`isClosed`,`Date`)
			VALUES(?,?,?,?,?,?,?,?)");	
		$stmt->bind_param(
			"iiddiiis",$this->id, $this->LenderId, $this->Amount, $this->Rate, $this->duration, $this->borrowerId,
        $this->isClosed,$this->Date);	
		if($stmt->execute()){
			return true;
		}
		return false;		 
	}

	/**
	 * updates the existing loan
	 * @return bool
	 */
	function update(){
	 
		$stmt = $this->conn->prepare("
			UPDATE ".$this->loansTable." 
			SET LenderId = ?, Amount = ?, Rate = ?, duration = ?, borrowerId = ?, isClosed = ?, Date = ?
			WHERE id = ?");
	 
			$this->id = htmlspecialchars(strip_tags($this->id));
			$this->LenderId = htmlspecialchars(strip_tags($this->LenderId));
			$this->Amount = htmlspecialchars(string: strip_tags($this->Amount));
			$this->Rate = htmlspecialchars(strip_tags($this->Rate));
			$this->duration = htmlspecialchars(strip_tags($this->duration));
			$this->borrowerId = htmlspecialchars(string: strip_tags($this->borrowerId));
			$this->isClosed = htmlspecialchars(string: strip_tags($this->isClosed));
			$this->Date = htmlspecialchars(string: strip_tags($this->Date));
			
		$stmt->bind_param(
			"iddiiisi", $this->LenderId, $this->Amount, $this->Rate, $this->duration, $this->borrowerId,
        $this->isClosed,$this->Date,$this->id);		
		if($stmt->execute()){
			return true;
		}
	 
		return false;
	}

	/**
	 * delete the existing loan
	 * @return bool
	 */
	function delete(){
		$stmt = $this->conn->prepare("
			DELETE FROM ".$this->loansTable." 
			WHERE id = ?");
			
		$this->id = htmlspecialchars(strip_tags($this->id));
	 
		$stmt->bind_param("i", $this->id);
	 
		if($stmt->execute()){
			return true;
		} 
		return false;		 
	}
}
?>