<?php
require_once("../head/head.php");

require "../../controllers/strippenkaartController.php";
require "../../controllers/lessbloackController.php";
$stampcardController = new strippenkaartController();
$stampcard = $stampcardController->get();





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
  <title>stampcard</title>
</head>

<body>
  <div class="table-container">
    <label class="control-label col-sm-4" id="serchtext" for="email"><b>Find a strip card</b>:</label>
    <div class="col-sm-4">
      <input type="text" id="myInput" onkeyup="myFunction()" placeholder="Serch.." title="Type in a name">
    </div>
    <div class="table-responsive">
      <table class="table" id="contractTable">

        <thead>
          <tr>
            <th scope="col">Student Name</th>
            <th scope="col">Number of lessons</th>
            <th scope="col">Lessons taken</th>
            <th scope="col">Remaining lessons</th>
            <th scope="col"></th>
            <th scope="col"></th>

          </tr>
        </thead>
        <tbody>
          <?php if (is_array($stampcard)) : ?>
            <?php foreach ($stampcard as $row) : ?>
              <tr>
                <?php $result = $row->amount_lessons + $row->remaining_lessons ?>
                <td><?= $row->student_id ?></td>
                <td><?= $row->amount_lessons ?></td>
                <td><?= $row->remaining_lessons ?></td>
                <td><?= $result ?></td>
                <td>
                  <form action="delete.php?id=<?= $row->id ?>" onsubmit="return confirm('Are you sure you want to remove?');" method="post">
                    <button type="submit" class="btn btn-danger">Cancel</button>
                  </form>
                </td>
                <td>
                  <a href="edit.php?id=<?= $row->id ?>">
                    <button type="button" id="txtedit" class="btn btn-warning">Edit</button>
                  </a>
                </td>
              </tr>
            <?php endforeach; ?>
          <?php else : ?>
            <tr>
              <td colspan="9">No Strip card</td>
            </tr>
          <?php endif; ?>



        </tbody>
        <div class="row justify-content-end mb-3">
          <div class="col-vehicle">
            <a href="create.php">
              <button type="submit" id="button" class="btn btn-warning">Create</button>
            </a>
          </div>
        </div>
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


</body>

</html>