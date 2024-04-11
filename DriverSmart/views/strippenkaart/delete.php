<?php

require "../../controllers/strippenkaartController.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    (new strippenkaartController())->remove();
}
