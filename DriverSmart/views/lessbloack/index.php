<?php
require_once("../head/head.php");

require "../../controllers/lessbloackController.php";
$lessbloackController = new lessbloackController();
$lessbloack = $lessbloackController->get();
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
  <script src="../../static/js/index.js"></script>
  <link rel="stylesheet" href="../../static/css/index.css">
  <title>LessbloackIndex</title>
</head>

<body>

  <div class="table-container">
    <label class="control-label col-sm-4" id="serchtext" for="email"><b>Find a lessblock</b>:</label>
    <div class="col-sm-4">
      <input type="text" id="myInput" onkeyup="myFunction()" placeholder="Search.." title="Type in a name">
    </div>
    <div class="table-responsive">
      <table class="table" id="contractTable">

        <thead>
          <tr>
            <th scope="col">Instructor</th>
            <th scope="col">Car license plate</th>
            <th scope="col">Date</th>
            <th scope="col">Start time</th>
            <th scope="col"></th>
            <th scope="col">Eind time</th>
            <th scope="col">Student</th>
            <th scope="col">Report</th>
            <th scope="col"></th>
          </tr>
        </thead>
        <tbody>
          <?php if (is_array($lessbloack)) : ?>
            <?php foreach ($lessbloack as $row) : ?>
              <tr>

                <td><?= $row->instructeur_id ?></td>
                <td><?= $row->auto_kenteken ?></td>
                <td><?= $row->datum ?></td>
                <td><?= $row->tijdblok ?></td>
                <td>
                </td>
                <!-- Add 1 hour to the Time Block -->
                <td><?= date('H:i', strtotime('+1 hour', strtotime($row->tijdblok))) ?></td>
                <td><?= $row->leerling_id ?></td>
                <td><?= isset($row->verslag) ? $row->verslag : "unknown" ?></td>
                <!-- Check that the report is empty and that the date is today -->
                <?php if (empty($row->verslag) && $row->datum == date("Y-m-d")) : ?>
                  <td>
                    <a href="edit.php?id=<?= $row->id ?>">
                      <button type="button" name="bewerken" id="txtedit" class="btn btn-warning">Edit</button>
                    </a>
                  </td>
                <?php else : ?>
                  <!-- Empty cell if the report is not empty or the date is not today -->
                  <td></td>
                <?php endif; ?>
              </tr>
            <?php endforeach; ?>
          <?php else : ?>
            <tr>
              <td colspan="9">No Less Block</td>
            </tr>
          <?php endif; ?>
        </tbody>
      </table>
    </div>

    <script>
      // Get the value of the 'message' parameter from the URL
      const message = new URLSearchParams(window.location.search).get('message');
      if (message) {
        alert(message);
        // Remove the 'message' parameter from the URL
        window.history.replaceState({}, document.title, window.location.pathname);
      }
    </script>

  </div>
</body>

</html>