<?php
/** headers */
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
//includes 
include_once '../config/Database.php';
include_once '../class/loans.php';
// Create DB obj
$database = new Database();
// Get connection
$db = $database->getConnection();
 // Create Loan obj
$loans = new Loans(db: $db);
$loans->id = (isset($_GET['id']) && $_GET['id']) ? $_GET['id'] : '0';
$result = $loans->read();
if($result->num_rows > 0){    
    $loanRecords=array();
    $loanRecords["loans"]=array(); 
	while ($loan = $result->fetch_assoc()) { 	
        extract($loan); 
        $loanDetails=array(
            "id" => $id,
            "LenderId" => $LenderId,
            "Amount" => $Amount,
            "Rate" => $Amount,
            "duration" => $Amount,
			"borrowerId" => $borrowerId,
            "isClosed" => $isClosed,
            "Date"=> $Date			
        ); 
       array_push($loanRecords["loans"], $loanDetails);
    }    
    http_response_code(response_code: 200);     
    echo json_encode(value: $loanRecords);
}else{     
    http_response_code(response_code: 404);     
    echo json_encode(
        array("message" => "No loan found.")
    );
} 