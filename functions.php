<?php
require('connection.class.php');

if (isset($_POST["action"]))
{
    $dbh = new DBHandler();
    if($dbh->getInstance() === null){
        die("no db conn");
    }

    if($_POST["action"] == 'del')
    {
        $pdo = $dbh->getInstance();

        $count = $pdo->exec('DELETE FROM tblNews WHERE newsId ='.$_POST["id"]);
    }
}