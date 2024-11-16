<?php
// Not implemented yet
class Borrower{
    private $borrowerTable = "borrower";      
    public $id;
    public $email;
    public $password;
    public $loanId;
    
    private $conn;
	
    public function __construct($db){
        $this->conn = $db;
    }	
}
?>