<?php
require_once("../head/head.php");
require "../../controllers/StrippenkaartController.php";

$strippenkaart = new strippenkaartController();
$errors = [];
// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // When the form has been submitted
    // Run the create method and check if the order was added
    $carsCreated = $strippenkaart->create($_POST["student_id"], $_POST["aantal_lessen"]);
    // Check if the order was added successfully
    if ($carsCreated) {
        // If the order is added, redirect the user to the index page
        header("Location: index.php");
    } else {
        // If an error occurred while adding the order, add an error message to the error array
        $errors[] = "<div class='alert alert-danger' role='alert'>Something went wrong when adding the strip cards</div>";
    }
}
$student = $strippenkaart->getStudent();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../../static/css/creat.css" type="text/css">

    <title>Creat</title>

</head>

<body>
    <form method="POST">
        <label for="classes">Choose a Student:</label><br>
        <select type="text" id="student_id" class="fadeIn second" name="student_id" class="form-control">
            <option type="text" value="" disabled selected>Choose a Student</option>
            <?php
            // get Student name page
            foreach ($student as $row) : ?>

                <option value="<?= $row->id ?>"><?= $row->naam ?></option>
                <!--get student's first name -->
            <?php endforeach ?>
        </select>
        <label for="classes">Choose a number of lessons:</label><br>
        <input type="text" id="aantal_lessen" class="fadeIn second" name="aantal_lessen" value="<?= $row->aantallessen ?>"><br>


        </select>

        <div class="form-group">

            <button type="submit" class="button">Save</button>
    </form>
    <!-- print error -->
    <?php if (is_array($errors)) : ?>
        <?= implode("</br>", $errors) ?>
    <?php endif ?>
    <!-- Print end error -->
</body>

</html>