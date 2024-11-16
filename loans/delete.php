<?php
/** headers */
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
//includes 
include_once '../config/Database.php';
include_once '../class/Loans.php';
include_once '../class/Lender.php';

// Create DB obj
$database = new Database();
// Get connection
$db = $database->getConnection();
//create a Loan obj
$loans = new Loans($db);
//create a Lender obj
$lender = new Lender($db);
//Get data
$data = json_decode(file_get_contents("php://input"));
//validation checks
if(!empty($data->id) && !empty($data->LenderId)) {
	$loans->id = $data->id;
	$loans->LenderId = $data->LenderId;
	if($lender->validateLender($loans->id, $loans->LenderId) && $loans->delete()){    
		http_response_code(200); 
		echo json_encode(value: array("message" => "Loan was deleted."));
	} else {    
		http_response_code(503);   
		echo json_encode(array("message" => "Unable to delete Loan."));
	}
} else {
	http_response_code(response_code: 400);    
    echo json_encode(array("message" => "Unable to delete Loan. Data is incomplete."));
}
?>