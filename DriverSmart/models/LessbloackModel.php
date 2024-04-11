<?php

require_once "../../cores/Database.php";

class lessbloackModel extends Database
{
    // Get all lessbloack
    protected function index()
    {
     
        // Connect to the database
        $connection = $this->connect();
        // Prepare the SQL query
        $stmt = $connection->prepare("
        SELECT lessonblock.id, lessonblock.date, lessonblock.timeblock, lessonblock.report, instructor.first_name AS instructor_id, vehicle.brand AS vehicle_license,
        student.name AS student_id 
        FROM lessonblock AS lessonblock
        LEFT JOIN instructor AS instructor ON lessonblock.instructor_id = instructor.id 
        LEFT JOIN vehicle AS vehicle ON lessonblock.vehicle_license = vehicle.license
        LEFT JOIN student AS student ON lessonblock.student_id = student.id



    ");
        // Execute the query with the email as parameter
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


    // // Find lessbloack
    protected function find($id)
    {
        // Connect to the database
        $connection = $this->connect();
        // Prepare the SQL query
        $stmt = $connection->prepare("SELECT * FROM lessonblock WHERE id = ? ");
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
    protected function edit($report, $id)
    {
        // Connect to the database
        $connection = $this->connect();
        // Prepare the SQL query
        $stmt = $connection->prepare("UPDATE lessonblock SET report = ? WHERE id = ?");
        // Execute the query 
        $stmt->execute([$report, $id]);
        // Return true if at least one row was affected
        return $stmt->rowCount() > 0;
    }
    // Get reduceLessons
    protected function reduceLessons($id)
    {
        $connection = $this->connect(); // Connect to the database
        $stmt = $connection->prepare("UPDATE stampcard SET remaining_lessons = remaining_lessons - ? WHERE student_id  = ?");
        
        $stmt->execute([1, $id, 1]); // Execute the query with parameters
        return $stmt->rowCount(); // Return true if at least one row was affected
    }

    // Get lessbloack details for a specific lessbloack ID for validation
    protected function getDetails($lessonblockId)
    {
        //  method to connect to the database
        $connection = $this->connect();

        // Prepare the query
        $stmt = $connection->prepare("SELECT * FROM lessonblock WHERE id = ?");
        // Execute the query with the specified orderId
        $stmt->execute([$lessonblockId]);


        $lessonblockIdDetails = $stmt->fetch(PDO::FETCH_ASSOC);

        // Return the found data
        return $lessonblockIdDetails;
    }
}
