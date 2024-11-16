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
 // Create Loan obj
$loans = new Loans($db);
// Create Lender obj
$lender = new Lender($db);
// Get data
$data = json_decode(file_get_contents("php://input"));
// Validation checks
if(!empty($data->id) && !empty($data->LenderId) &&
        !empty($data->Amount) && !empty($data->duration) &&
        !empty($data->borrowerId) && !empty($data->Rate) &&
        !empty($data->isClosed) && !empty($data->Date)){    			
    $loans->id = $data->id;
    $loans->LenderId = $data->LenderId;
    $loans->Amount = $data->Amount;
    $loans->duration = $data->duration;	
    $loans->borrowerId = $data->borrowerId;
    $loans->Rate = $data->Rate;	
    $loans->isClosed = $data->isClosed;
    $loans->Date = $data->Date;
	
	if($lender->validateLender($loans->id, $loans->LenderId) && $loans->update()){    
		http_response_code(200);   
		echo json_encode(array("message" => "Loan was updated."));
	}else{    
		http_response_code(503);     
		echo json_encode(array("message" => "Unable to update loan."));
	}
} else {
	http_response_code(400);    
    echo json_encode(array("message" => "Unable to update loan. Data is incomplete."));
}
?>