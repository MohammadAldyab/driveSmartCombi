<?php

require_once "../../cores/Database.php";

class lessbloackModel extends Database
{
    // Get all lessbloack
    protected function index()
    {
        $email = $_SESSION['email']['email'];
        // Connect to the database
        $connection = $this->connect();
        // Prepare the SQL query
        $stmt = $connection->prepare("
        SELECT lesblok.id, lesblok.datum, lesblok.tijdblok, lesblok.verslag, instructeur.voornaam AS instructeur_id, auto.kenteken AS auto_kenteken,
leerling.naam AS leerling_id 
FROM lesblok AS lesblok
LEFT JOIN instructeur AS instructeur ON lesblok.instructeur_id = instructeur.id 
LEFT JOIN auto AS auto ON lesblok.auto_kenteken = auto.id
LEFT JOIN leerling AS leerling ON lesblok.leerling_id = leerling.id
WHERE lesblok.datum >= CURDATE() AND lesblok.datum <= CURDATE() + INTERVAL 1 MONTH
AND instructeur.id = (SELECT id FROM instructeur WHERE email = ?)


    ");
        // Execute the query with the email as parameter
        $stmt->execute([$email]);
        // Check if any rows were found
        if ($stmt->rowCount() > 0) {
            // Return the results as an array of objects
            return $stmt->fetchAll(PDO::FETCH_OBJ);
        } else {
            // Return false if no rows were found
            return false;
        }
    }


    // // Find lessbloack
    protected function find($id)
    {
        // Connect to the database
        $connection = $this->connect();
        // Prepare the SQL query
        $stmt = $connection->prepare("SELECT * FROM lesblok WHERE id = ? ");
        // Execute the query with the specified parameters
        $stmt->execute([$id]);
        // Check if any rows were found
        if ($stmt->rowCount() > 0) {
            // Return the results as an object
            return $stmt->fetch(PDO::FETCH_OBJ);
        } else {
            // Return false if no rows were found
            return false;
        }
    }

    // Update lessbloack
    protected function edit($verslag, $id)
    {
        // Connect to the database
        $connection = $this->connect();
        // Prepare the SQL query
        $stmt = $connection->prepare("UPDATE lesblok SET verslag = ? WHERE id = ?");
        // Execute the query 
        $stmt->execute([$verslag, $id]);
        // Return true if at least one row was affected
        return $stmt->rowCount() > 0;
    }
    // Get reduceLessons
    protected function reduceLessons($id)
    {
        $connection = $this->connect(); // Connect to the database
        $stmt = $connection->prepare("UPDATE strippenkaart SET resterende_lessen = resterende_lessen - ? WHERE student_id  = ? AND status = ?");
        $stmt->execute([1, $id, 1]); // Execute the query with parameters
        return $stmt->rowCount(); // Return true if at least one row was affected
    }
    // Get lessbloack details for a specific lessbloack ID for validation
    protected function getDetails($lesblokId)
    {
        //  method to connect to the database
        $connection = $this->connect();

        // Prepare the query
        $stmt = $connection->prepare("SELECT * FROM lesblok WHERE id = ?");
        // Execute the query with the specified orderId
        $stmt->execute([$lesblokId]);


        $lesblokIdDetails = $stmt->fetch(PDO::FETCH_ASSOC);

        // Return the found data
        return $lesblokIdDetails;
    }
}
