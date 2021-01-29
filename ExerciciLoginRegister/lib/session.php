<?php
    function UpdateLastSign($row,$dbU)
    {
        $sql = "UPDATE `users` set lastSignIn = :dateU WHERE iduser = :idU";
        $update = $dbU->prepare($sql);
        $update->execute(array('dateU' => date("Y/m/d H:i:s"), 'idU' => $row['iduser']));
    }
    function verifyUser ($user,$dbU)
    {
        $sql = "SELECT * FROM `users` where mail = :namemail OR username = :namemail";
        $select = $dbU->prepare($sql);
        $select->execute(array('namemail' => $user));
        return $select;
    }
    function verifyUsername ($username, $dbU)
    {
        $sql = "SELECT * FROM users where username = ?";
        $select = $dbU ->prepare($sql);
        $select->execute(array($username));
        return $select;
    }
    function verifyEmail ($email, $dbU)
    {
        $sql = "SELECT * FROM users where mail = ?";
        $select = $dbU->prepare($sql);
        $select->execute(array($email));

        return $select;
    }
?>