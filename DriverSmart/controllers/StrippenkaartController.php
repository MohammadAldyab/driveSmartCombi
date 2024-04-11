<?php

require "../../models/StrippenkaartModel.php";

class strippenkaartController extends stampcardModel
{
    // Get all the strip cards
    public function get()
    {
        // Execute the method to retrieve the strip cards
        return $this->index();
    }
    public function getStudent()
    {
        // Execute the method to retrieve the student data
        return $this->getOne();
    }

    // Find a strip of cards
    public function findorfail()
    {
        // Make sure the ID is set before trying to find
        return ($this->find($_GET["id"])) ? $this->find($_GET["id"]) : false;
    }


    // Remove a strip of cards
    public function remove()
    {

        // Make sure the ID is set before attempting to delete
        if (isset($_GET["id"]) && $this->findorfail()) {
            return ($this->delete($_GET["id"])) ? header("Location: index.php?message=Successfully removed") :
                header("Location: index.php?message=The ID was not found.");
        } else {
            // Return an error if the ID is not set
            return header("Location: index.php?message=The ID was not found.");
        }
    }



    // Add a new strip of cards
    public function create($student_id, $amount_lessons)
    {
        // Execute the method to add a new strip or cards with the specified data
        $result = $this->add($student_id, $amount_lessons);

        // Check if the addition was successful
        if ($result) {
            // If successful, redirect with success message
            header("Location: index.php?message=Added successfully");
        } else {
            // If unsuccessful, redirect with error
            header("Location: index.php?message=An error occurred while adding.");
        }
        // Exit to prevent further execution
        exit();
    }


    public function getOneDetails($id)
    {
        return $this->getDetails($id);
    }

    // Edit a strip of cards
    public function update()
    {

        // Check if ID is set and exists
        // isset means the variable is set and not null
        if (isset($_GET["id"]) && $this->findorfail($_GET["id"])) {
            // Get the original strip or cards data
            $carsData = $this->getDetails($_GET["id"]);
            // Check if the new data is different from the original data
            if (

                $_POST["amount_lessons"] == $carsData['amount_lessons'] &&
                $_POST["remaining_lessons"] == $carsData['remaining_lessons']

            ) {
                // No changes made, send an error message
                header("Location: index.php?message=No changes made.");
                exit();
            }

            // Call the edit function and handle the result
            $result = $this->edit($_POST["amount_lessons"], $_POST["remaining_lessons"], $_GET["id"]);

            // Check if the operation was successful
            if ($result) {
                // If successful, redirect with success message
                header("Location: index.php?message=Updated successfully");
                // Exit to prevent further execution
                exit();
            } else {
                // If unsuccessful, redirect with error
                header("Location: index.php?message=An error occurred while updating.");
                // Exit to prevent further execution
                exit();
            }
        } else {
            // If ID is not set or does not exist, you will be redirected with an error
            header("Location: index.php?message=The ID was not found.");
            // Exit to prevent further execution
            exit();
        }
    }
}
