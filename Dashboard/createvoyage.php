<?php

require("../global.php");
if (isset($_SESSION['login'])) {
    if(isset($_POST['nomVoyage']) && isset($_POST['date']) && isset($_POST['heuredepart'])) {
        $nomVoyage = $_POST['nomVoyage'];
        $date = $_POST['date'];
        $hdp = $_POST['heuredepart'];
        $hda = $_POST['heurearrive'];
        $bateau = $_POST['bateau'];
        $capitaine = $_POST['capitaine'];
        $liaison = $_POST['liaison'];


        $nomQui = $_SESSION['login'];
        $Libelle = "Voyage : " . $nomVoyage . " créé";


        $req = $db->connection()->prepare('INSERT INTO traverse (nomTraverse, date, heureDepart, heureArrive, idBateau, idCapitaine, idLiaison) VALUE (?,?,?,?,?,?,?)');
        $req->execute([$nomVoyage, $date, $hdp, $hda, $bateau, $capitaine, $liaison]);

        $req2 = $db->connection()->prepare('INSERT INTO notifications (nomQui, Libelle) VALUE (?,?)');
        $req2->execute([$nomQui, $Libelle]);

        header('Location: voyage.php?success=1');


    }
    else {


        header('Location: voyage.php?success=0');


    }

} else {
    header('Location: login.php?success=2');
}