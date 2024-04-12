<?php

require_once "../../cores/Database.php";

class strippenkaartModel extends Database
{
    // Get all the strip card
    protected function index()
    {
        // Connect to the database
        $connection = $this->connect();
        // Prepare the SQL query
        $stmt = $connection->prepare("
        SELECT strippenkaart.id, strippenkaart.aantal_lessen, strippenkaart.resterende_lessen,
         leerling.naam AS student_id FROM strippenkaart AS strippenkaart
           LEFT JOIN leerling AS leerling ON strippenkaart.student_id = leerling.id
           WHERE status = 1
          
           ;

    ");
        // Execute the query
        $stmt->execute();
        // Check if any rows were found
        if ($stmt->rowCount() > 0) {
            // Return the results as an array of objects
            return $stmt->fetchAll(PDO::FETCH_OBJ);
        } else {
            // Return false if no rows were found
            return false;
        }
    }


    // Find strip card
    protected function find($id)
    {
        // Connect to the database
        $connection = $this->connect();
        // Prepare the SQL query
        $stmt = $connection->prepare("SELECT * FROM strippenkaart WHERE id = ? ");
        // Execute the query
        $stmt->execute([$id]);
        // Check if any rows were found
        if ($stmt->rowCount() > 0) {
            // Return false if no rows were found
            return $stmt->fetch(PDO::FETCH_OBJ);
        } else {
            // Return false if no rows were found
            return false;
        }
    }


    // Delete strip card
    protected function delete($id)
    {
        // Try running the following code
        try {
            // Connect to the database
            $connection = $this->connect();
            // Prepare the SQL query
            $stmt = $connection->prepare("UPDATE strippenkaart SET status = 0 WHERE id = ?");
            // Execute the query
            $stmt->execute([$id]);


            if ($stmt->rowCount() > 0) {
                // Record has been deleted
                return true;
            } else {
                // Record has not been deleted
                return false;
            }
        } catch (PDOException $e) {
            // Handle database query error
            // Log or display the error message if necessary
            return false;
        }
    }


    protected function getOne()
    {
        // Connect to the database
        $connection = $this->connect();
        // Prepare the SQL query
        $stmt = $connection->prepare("SELECT * From leerling");
        // Execute the query
        $stmt->execute();
        // Check if any rows were found
        if ($stmt->rowCount() > 0) {
            // Return the results as an array of objects
            return $stmt->fetchAll(PDO::FETCH_OBJ);
        } else {
            // Return false if no rows were found
            return false;
        }
    }


    // Add strip card
    protected function add($student_id, $aantal_lessen)
    {
        // Connect to the database
        $connection = $this->connect();

        // Prepare the SQL query
        $stmt = $connection->prepare("INSERT INTO  strippenkaart (student_id, aantal_lessen,resterende_lessen,status) VALUES (?, ?,0,1)");

        // Execute the query
        $stmt->execute([$student_id, $aantal_lessen]);

        // Check if the query was executed successfully
        return $stmt->rowCount();
    }


    protected function getDetails($id)
    {
        // Connect to the database
        $connection = $this->connect();
        // Prepare the SQL query
        $stmt = $connection->prepare("
        SELECT strippenkaart.id, strippenkaart.aantal_lessen, strippenkaart.resterende_lessen, leerling.naam AS student_name
        FROM strippenkaart 
        LEFT JOIN leerling ON strippenkaart.student_id = leerling.id 
        WHERE strippenkaart.id = ?
        ");
        // Execute the query
        $stmt->execute([$id]);
        // Return the results as an array of objects
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    // edit strip card
    protected function edit($aantal_lessen, $resterende_lessen, $id)
    {
        // Connect to the database
        $connection = $this->connect();
        // Prepare the SQL query 
        $stmt = $connection->prepare("UPDATE strippenkaart SET aantal_lessen = ?, resterende_lessen = ? WHERE id = ?");

        // Execute the query
        $stmt->execute([$aantal_lessen, $resterende_lessen, $id]);

        if ($stmt->rowCount() > 0) {
            // Update succesvol
            return true;
        } else {
            // Update mislukt
            return false;
        }
    }
}
