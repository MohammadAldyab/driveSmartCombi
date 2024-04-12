<?php

require_once "../../cores/Database.php";


class UserModel extends Database
{
    protected function authenticate($email, $wachtwoord)
    {
        $connection = $this->connect();
        $stmt = $connection->prepare("SELECT * FROM instructeur WHERE email = ? AND wachtwoord = ?");
        $stmt->execute([$email, md5($wachtwoord)]);

        if ($stmt->rowCount() > 0) {
            $user = $stmt->fetch(PDO::FETCH_ASSOC);
            // Check whether the specified password matches the saved password
            if (md5($wachtwoord) === $user['wachtwoord']) {
                // User found and password is correct
                return $user;
            }
        }

        // Search student table if user not found in instructor table
        $stmt = $connection->prepare("SELECT * FROM leerling WHERE email = ? AND wachtwoord = ?");
        $stmt->execute([$email, md5($wachtwoord)]);

        if ($stmt->rowCount() > 0) {
            $user = $stmt->fetch(PDO::FETCH_ASSOC);
            // Check whether the specified password matches the saved password
            if (md5($wachtwoord) === $user['wachtwoord']) {
                // User found and password is correct
                return $user;
            }
        }
        // User not found or password is incorrect
        return false;
    }

    protected function register($email, $wachtwoord)
    {
        //  a secure hash method in production
        $hashedPassword = md5($wachtwoord);
        $connection = $this->connect();
        // Check if username already exists in instructor table
        $stmtCheck = $connection->prepare("SELECT COUNT(*) AS count FROM instructeur WHERE email = ?");
        $stmtCheck->execute([$email]);
        $result = $stmtCheck->fetch(PDO::FETCH_ASSOC);

        if ($result['count'] > 0) {
            // Username already exists, return false for failed registration
            echo '<div style="background-color: #ffcccc; color: #cc0000; border: 1px solid #cc0000; padding: 10px; margin-bottom: 20px;">Username/Email already exists</div>';
            return false;
        }

        // Check if username already exists in student table

        $stmtCheck = $connection->prepare("SELECT COUNT(*) AS count FROM leerling WHERE email = ?");
        $stmtCheck->execute([$email]);
        $result = $stmtCheck->fetch(PDO::FETCH_ASSOC);

        if ($result['count'] > 0) {
            // Username already exists, return false for failed registration
            echo '<div style="background-color: #ffcccc; color: #cc0000; border: 1px solid #cc0000; padding: 10px; margin-bottom: 20px;">Username/Email already exists</div>';
            return false;
        }

        // Username does not exist in both tables, add the new user to instructor table
        $stmt = $connection->prepare("INSERT INTO leerling (naam,adres,postcode,woonplaats,telefoon,email,wachtwoord) VALUES ('testnaam','Bredeweg','500NV','Roermond','0632456789',?,?)");
        $stmt->execute([$email, $hashedPassword]);

        if ($stmt->rowCount() > 0) {
            // Registration successful
            return true;
        } else {
            // Registration failed
            return false;
        }
    }
}
