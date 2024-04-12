<?php

require "../../models/LessbloackModel.php";

class lessbloackController extends lessbloackModel
{
    // Get all lessbloack
    public function get()
    {
        // Execute the method to retrieve the lessbloack
        return $this->index();
    }


    // Find a lessblock
    public function findorfail()
    {
        // Make sure the ID is set before trying to find
        return ($this->find($_GET["id"])) ? $this->find($_GET["id"]) : false;
    }


    // Edit a lessonblock
    public function update()
    {
        // Check if ID is set and exists
        // isset means the variable is set and not null
        if (isset($_GET["id"]) && $this->findorfail($_GET["id"])) {
            // Retrieve the original lesson block data
            $originalData = $this->getDetails($_GET["id"]);

            // Check if the new data is different from the original data
            if ($_POST["verslag"] == $originalData['verslag']) {
                // No changes made, send an error message
                header("Location: index.php?message=No changes made.");
                // Exit to prevent further execution
                exit();
            }


            // Call the edit function and handle the result
            $result = $this->edit($_POST["verslag"], $_GET["id"]);
            $reduceLessons = $this->reduceLessons($originalData['leerling_id']);
            if ($result && $reduceLessons) {
                // Indien succesvol, omleiding met succesbericht
                header("Location: index.php?message=Succesvol bijgewerkt");
                  // Exit to prevent further execution
                exit(); 
            } else {
                // Indien niet succesvol, redirect met foutmelding
                header("Location: index.php?message=Er is een fout opgetreden bij het bijwerken.");
                  // Exit to prevent further execution
                exit(); 
            }
        } else {
          // If ID is not set or does not exist, you will be redirected with an error
            header("Location: index.php?message=De id is niet gevonden.");
              // Exit to prevent further execution
            exit();
        }
    }

}
