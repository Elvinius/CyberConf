<?php 

// Validate POST-Request if false, go back to its html
function validatePOST($redirect) {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        header("location:./$redirect");
    }
}

// Validate username
//Starting char _ or __ or . or .. or _. or ._ is not allowed
function usernameValidity($username) {    
    if (empty($username) or !preg_match("/^(?![_.])(?!.*[_.]{2}).*[\w]$/", $username)) {
        return "Initial letters can't be '.' or '_'";
    }
}

// Validate password
// It must contain alphabets, both upper and lower case and numericals
function passwordValidity($password) {
    if (empty($password) or preg_match("^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$/",$password)){
        return 'It must contain both upper/lower case alphabets and numericals';
    }
}


//excute SQL 
function register($username, $password, $birthdate, $gender, $country, $occupation) {

    try {

    $SQLuser = 'root';
    $SQLpassword = 'root';
    $SQLdns = 'mysql:dbname=Test;host=localhost';
    
    //logging into SQL database.
    $dbh = new PDO($SQLdns,$SQLuser,$SQLpassword);
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    //SQL Statement.
    $sql = "INSERT INTO Users (username, password, birthdate, gender, country, occupation) VALUES(:username, :password, :birthdate, :gender, :country, :occupation)";
    
    //Preparing the sql statement
    $stmt = $dbh->prepare($sql);
    
    //Binding the values to sql statement
    $stmt->bindParam(":username", $username, PDO::PARAM_STR);
    $stmt->bindParam(":password", password_hash($password, PASSWORD_DEFAULT), PDO::PARAM_STR);
    $stmt->bindValue(":birthdate", date("Y-m-d", strtotime($birthdate)), PDO::PARAM_STR);
    $stmt->bindParam(":gender", $gender, PDO::PARAM_STR);
    $stmt->bindParam(":country", $country, PDO::PARAM_STR);
    $stmt->bindParam(":occupation", $occupation, PDO::PARAM_STR);
    
    //Excute sql 
    $stmt->execute();

    //close connection to sqldb
    unset($stmt);
    unset($dbh);
    
    //exit
    exit();
    }

    catch (PDOException $err) {
        echo  $err->getMessage(); /// THIS IS FOR DEBUGGING
    }

    //header("location:./register.html");
}
