<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
 
// database connection will be here
// include database and object files
include_once '../config/database.php';
include_once '../entity/hebergement.php';
 
// instantiate database and hebergement object
$database = new Database();
$db = $database->getConnection();
 
// initialize object
$hebergement = new Hebergement($db);
 
// read hebergement will be here
// query hebergement
$stmt = $hebergement->read();
$num = $stmt->rowCount();
 
// check if more than 0 record found
if($num>0){
 
    // hebergement array
    $hebergement_arr=array();
    $hebergement_arr["records"]=array();
 
    // retrieve our table contents
    // fetch() is faster than fetchAll()
    // http://stackoverflow.com/questions/2770630/pdofetchall-vs-pdofetch-in-a-loop
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        // extract row
        // this will make $row['name'] to
        // just $name only
        extract($row);
 
        $hebergements_item=array(
            "id" => $id,
            "codeHebergement" => $codeHebergement,
            "nom" => $nom,
            "paye" => $paye,
            "ville" => $ville,
            "adress" => $adress,
            "adressMap" => $adressMap,
            "responsable" => $responsable,
            "description" => $description,
            "logo" => $logo,
            "telephon" => $telephon,
            "email" => $email,
            "password" => $password,
        );
 
        array_push($hebergement_arr["records"], $hebergements_item);
    }
 
    // set response code - 200 OK
    http_response_code(200);
 
    // show hebergement data in json format
    echo json_encode($hebergement_arr);
}
 
// no hebergement found will be here

else{
 
    // set response code - 404 Not found
    http_response_code(404);
 
    // tell the user no hebergements found
    echo json_encode(
        array("message" => "No hebergements found.")
    );
}
?>