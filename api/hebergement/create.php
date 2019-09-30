<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

// get database connection
include_once '../config/database.php';

// instantiate hebergement object
include_once '../entity/hebergement.php';

$database = new Database();
$db = $database->getConnection();

$hebergement = new Hebergement($db);

// get posted data
$data = json_decode(file_get_contents("php://input")); // decoding the received JSON and store into $obj variable.
$obj = json_decode($data, true);

// Populate User name from JSON $obj array and store into $name.
$name = $obj['nom'];

// Populate User email from JSON $obj array and store into $email.
$email = $obj['email'];

// Populate Password from JSON $obj array and store into $password.
$password = $obj['password'];

//Checking Email is already exist or not using SQL query.
$CheckSQL = "SELECT * FROM hebergement WHERE email='$email'";

// Executing SQL Query.
$check = mysqli_fetch_array(mysqli_query($db, $CheckSQL));


if (isset($check)) {

    $EmailExistMSG = 'Email Already Exist, Please Try Again !!!';

    // Converting the message into JSON format.
    $EmailExistJson = json_encode($EmailExistMSG);

    // Echo the message.
    echo $EmailExistJson;
} else {

    // Creating SQL query and insert the record into MySQL database table.
    $Sql_Query = "insert into UserRegistrationTable (
    codeHebergement,
    nom,
    paye,
    ville,
    adress,
    adressMap,
    responsable,
    description,
    logo,
    telephon,
    email,
    password
    )
    values (
    '$codeHebergement',
    '$nom',
    '$paye',
    '$ville',
    '$adress',
    '$adressMap',
    '$responsable',
    '$description',
    '$logo',
    '$telephon',
    '$email',
    '$password',
    )";


    if (mysqli_query($db, $Sql_Query)) {

        // If the record inserted successfully then show the message.
        $MSG = 'User Registered Successfully';

        // Converting the message into JSON format.
        $json = json_encode($MSG);

        // Echo the message.
        echo $json;
    } else {

        echo 'Try Again';
    }
}
mysqli_close($db);
















 
// // make sure data is not empty
// if(
//     !empty($data->codeHebergement) &&
//     !empty($data->nom) &&
//     !empty($data->paye) &&
//     !empty($data->ville)&&
//     !empty($data->adress)&&
//     !empty($data->adressMap)&&
//     !empty($data->responsable)&&
//     !empty($data->description)&&
//     !empty($data->logo)&&
//     !empty($data->telephon)&&
//     !empty($data->email)&&
//     !empty($data->password)
// ){
 
//     // set hebergement property values
//     $hebergement->codeHebergement = $data->codeHebergement;
//     $hebergement->nom = $data->nom;
//     $hebergement->paye = $data->paye;
//     $hebergement->ville = $data->ville;
//     $hebergement->adress = $data->adress;
//     $hebergement->adressMap = $data->adressMap;
//     $hebergement->responsable = $data->responsable;
//     $hebergement->description = $data->description;
//     $hebergement->logo = $data->logo;
//     $hebergement->telephon = $data->telephon;
//     $hebergement->email = $data->email;
//     $hebergement->password = $data->password;
 
//     // create hebergement
//     function create(){
    
//         // query to insert record
//         $query = "INSERT INTO
//                     " . $this->table_name . "
//                 SET
//                 codeHebergement=:codeHebergement, nom=:nom, paye=:paye, ville=:ville, adress=:adress ,adressMap=:adressMap, responsable=:responsable, description=:description, logo=:logo, telephon=:telephon, email=:email, password=:password";
    
//         // prepare query
//         $stmt = $this->conn->prepare($query);
    
//         // sanitize
//         $this->codeHebergement=htmlspecialchars(strip_tags($this->codeHebergement));
//         $this->nom=htmlspecialchars(strip_tags($this->nom));
//         $this->paye=htmlspecialchars(strip_tags($this->paye));
//         $this->ville=htmlspecialchars(strip_tags($this->ville));
//         $this->adress=htmlspecialchars(strip_tags($this->adress));
//         $this->adressMap=htmlspecialchars(strip_tags($this->adressMap));
//         $this->responsable=htmlspecialchars(strip_tags($this->responsable));
//         $this->description=htmlspecialchars(strip_tags($this->description));
//         $this->logo=htmlspecialchars(strip_tags($this->logo));
//         $this->telephon=htmlspecialchars(strip_tags($this->telephon));
//         $this->email=htmlspecialchars(strip_tags($this->email));
//         $this->password=htmlspecialchars(strip_tags($this->password));

//         // bind values
//         $stmt->bindParam(":codeHebergement", $this->codeHebergement);
//         $stmt->bindParam(":nom", $this->nom);
//         $stmt->bindParam(":paye", $this->paye);
//         $stmt->bindParam(":ville", $this->ville);
//         $stmt->bindParam(":adress", $this->adress);
//         $stmt->bindParam(":adressMap", $this->adressMap);
//         $stmt->bindParam(":responsable", $this->responsable);
//         $stmt->bindParam(":description", $this->description);
//         $stmt->bindParam(":logo", $this->logo);
//         $stmt->bindParam(":telephon", $this->telephon);
//         $stmt->bindParam(":email", $this->email);
//         $stmt->bindParam(":password", $this->password);
    
//         // execute query
//         if($stmt->execute()){
//             return true;
//         }
    
//         return false;
        
//     }


//     if($hebergement->create()){
 
//         // set response code - 201 created
//         http_response_code(201);
 
//         // tell the user
//         echo json_encode(array("message" => "hebergement was created."));
//     }
 
//     // if unable to create the hebergement, tell the user
//     else{
 
//         // set response code - 503 service unavailable
//         http_response_code(503);
 
//         // tell the user
//         echo json_encode(array("message" => "Unable to create hebergement."));
//     }
// }
 
// // tell the user data is incomplete
// else{
 
//     // set response code - 400 bad request
//     http_response_code(400);
 
//     // tell the user
//     echo json_encode(array("message" => "Unable to create hebergement. Data is incomplete."));
// }
