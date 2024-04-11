<?php

require_once "../../cores/Database.php";

class stampcardModel extends Database
{
    // Get all the strip card
    protected function index()
    {
        // Connect to the database
        $connection = $this->connect();
        // Prepare the SQL query
        $stmt = $connection->prepare("
        SELECT stampcard.id, stampcard.amount_lessons, stampcard.remaining_lessons,
         student.name AS student_id FROM stampcard AS stampcard
           LEFT JOIN student AS student ON stampcard.student_id = student.id
           
          
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
        $stmt = $connection->prepare("SELECT * FROM stampcard WHERE id = ? ");
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
            $stmt = $connection->prepare("DELETE * FROM stampcard  WHERE id = ?");
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
        $stmt = $connection->prepare("SELECT * From student");
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
    protected function add($student_id, $amount_lessons)
    {
        // Connect to the database
        $connection = $this->connect();

        // Prepare the SQL query
        $stmt = $connection->prepare("INSERT INTO  stampcard (student_id, amount_lessons,remaining_lessons) VALUES (?, ?,0)");

        // Execute the query
        $stmt->execute([$student_id, $amount_lessons]);

        // Check if the query was executed successfully
        return $stmt->rowCount();
    }


    protected function getDetails($id)
    {
        // Connect to the database
        $connection = $this->connect();
        // Prepare the SQL query
        $stmt = $connection->prepare("
        SELECT stampcard.id, stampcard.amount_lessons, stampcard.remaining_lessons, student.name AS student_name
        FROM stampcard 
        LEFT JOIN student ON stampcard.student_id = student.id 
        WHERE stampcard.id = ?
        ");
        // Execute the query
        $stmt->execute([$id]);
        // Return the results as an array of objects
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    // edit strip card
    protected function edit($amount_lessons, $remaining_lessons, $id)
    {
        // Connect to the database
        $connection = $this->connect();
        // Prepare the SQL query 
        $stmt = $connection->prepare("UPDATE stampcard SET amount_lessons = ?, remaining_lessons = ? WHERE id = ?");

        // Execute the query
        $stmt->execute([$amount_lessons, $remaining_lessons, $id]);

        if ($stmt->rowCount() > 0) {
            // Update succesvol
            return true;
        } else {
            // Update mislukt
            return false;
        }
    }
}
