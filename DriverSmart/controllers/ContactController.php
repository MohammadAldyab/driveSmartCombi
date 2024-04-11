<?php
//Header display
require_once("../head/head.php");
//Contact white contact model
require "../../models/ContactModel.php";
//Contact white contact model
class ContactController extends ContactModel
{
    public function create($naam, $email, $bericht)
    {
        // Call the insertMessage method from the parent class to insert the message
        return $this->add($naam, $email, $bericht);
    }
}
