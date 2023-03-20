<?php
$action = $_GET['action'];
switch($action){
        case 'list' :
        // traitement du formulaire de recherche
        $nom="";
        $paysSel="Tous";
        if(!empty($_POST['nom']) || !empty($_POST['pays'])){
            $nom= $_POST['nom'];
            $paysSel= $_POST['pays'];
        }
        $lesPays=Pays::findAll();
        $lesZones=Zone::findAll($nom, $paysSel);
        include('views/zone/list.php');
        break;
    case 'add' :
        $mode="Ajouter";
        $lesContinents=Continent::findAll();
        include('vues/nationalite/formNationalite.php');
        break;
    case 'update' :
        $mode="Modifier";
        $lesContinents = Continent::findAll();
        $laNationalite=Nationalite::findById($_GET['num']);
        include('vues/nationalite/formNationalite.php');
        break;
    case 'delete' :
        $laNationalite=Nationalite::findById($_GET['num']);
        $nb=Nationalite::delete($laNationalite);
        if($nb==1){
            $_SESSION['message']=["success"=>"Le nationalite a bien été supprimé"];
        }else{
            $_SESSION['message']=["danger"=>"Le nationalite n'a pas été supprimé"];
        }
        header('location: index.php?uc=nationalites&action=list');
        exit();
        break;

    case 'validerForm' :
        $nationalite= new Nationalite();
        $continent=Continent::findById($_POST['continent']);
        $nationalite->setLibelle($_POST['libelle'])
            ->setContinent($continent);

        if(empty($_POST['num'])){ // cas d'une création
            $nb=Nationalite::add($nationalite);
            $message = "ajouté";
        }else{ //  cas d'une modif
            $nationalite->setNum($_POST['num']);
            $nb=Nationalite::update($nationalite);
            $message = "modifié";
        }
        if($nb==1){
            $_SESSION['message']=["success"=>"Le nationalite a bien été $message"];
        }else{
            $_SESSION['message']=["danger"=>"Le nationalite a bien été $message"];
        }
        header('location: index.php?uc=nationalites&action=list');
        exit();
        break;
}
?>