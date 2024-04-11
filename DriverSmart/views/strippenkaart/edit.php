<?php
require_once("../head/head.php");
require "../../controllers/strippenkaartController.php";
// get the class
$stampcard = new strippenkaartController();
$find = $stampcard->findorfail();
// get the stampcard details
$stampcardten = $stampcard->getOneDetails($_GET['id']);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // update the class
    $update = $stampcard->update($_POST["amount_lessons"], $_POST["remaining_lessons"], $_GET['id']);
}
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
    <title>Edit</title>
</head>

<body>
    <form method="POST">
        <label for="amount_lessons">Number of lessons:</label><br>
        <input type="text" id="amount_lessons" name="amount_lessons" value="<?= $stampcardten['amount_lessons'] ?>" required><br>

        <label for="remaining_lessons">Remaining lessons:</label><br>
        <input type="text" id="remaining_lessons" name="remaining_lessons" value="<?= $stampcardten['remaining_lessons'] ?>" required><br>

        <div class="form-group">
            <br>
            <button type="submit" class="button">Save</button>
        </div>
    </form>
</body>

</html>