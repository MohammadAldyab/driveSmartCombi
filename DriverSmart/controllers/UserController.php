<?php

require "../../models/UserModel.php";

require_once "../../models/UserModel.php";

class UserController extends UserModel
{
    public function login($email, $password)
    {
        $user = $this->authenticate($email, $password);
        if ($user) {
            session_start();
            $_SESSION['email'] = $user;

            if ($user['is_admin'] === '1') {
                //redirect to a instructure dashboard
                header("Location: ../dashboards/instructure_dashboard.php");

                exit();
            } else {
                // Unknown role, redirect to a default dashboard or display an error message
                header("Location: ../dashboards/student_dashboard.php");
                exit();
            }
        } else {
            // Login failed, display an error message to the user or take some other action
            return false;
        }
    }

    public function signup($email, $password)
    {
        return $this->register($email, $password);
    }
}
