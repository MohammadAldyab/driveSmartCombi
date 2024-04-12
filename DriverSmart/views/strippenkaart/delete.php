<?php

require "../../controllers/StrippenkaartController.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    (new strippenkaartController())->remove();
}
