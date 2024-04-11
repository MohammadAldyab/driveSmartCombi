<?php
require_once "../../cores/Database.php";

class ContactModel extends Database
{
    public function add($naam, $email, $bericht)
    {
        try {
            // Connect to the database
            $connection = $this->connect();

            // Prepare the SQL query
            $stmt = $connection->prepare("INSERT INTO contact (naam, email, bericht) VALUES (?, ?, ?)");

            // Execute the query with the given parameters
            $stmt->execute([$naam, $email, $bericht]);

            // Check if the query was executed successfully
            return $stmt->rowCount() > 0;
        } catch (PDOException $e) {
            // Handle any database errors
            echo "Error: " . $e->getMessage();
            return false;
        }
    }
}
