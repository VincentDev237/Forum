<?php
    session_start();
    require('action/database.php');

    //Validation du formulaire

    if (isset($_POST['validate'])) {

        //Vérification des données entrer par le users
        
        if (!empty($_POST['pseudo']) && !empty($_POST['lastname']) && !empty($_POST['firstname']) && !empty($_POST['password'])) {

            //Les données de users
            $user_pseudo = htmlspecialchars($_POST['pseudo']);
            $user_lastname = htmlspecialchars($_POST['lastname']);
            $user_firstname = htmlspecialchars($_POST['firstname']);
            $user_password = password_hash($_POST['password'], PASSWORD_DEFAULT);//password_default permet de crypter le mdp grâce à un algorithme de cryptage

            //vérifier si le user existe deja sur le site
            $checkIfUserAlreadyExists = $bdd->prepare('SELECT pseudo FROM users WHERE pseudo = ?');
            $checkIfUserAlreadyExists->execute(array($user_pseudo));

            if ($checkIfUserAlreadyExists->rowCount() == 0) {

                //insérer le user dans la bdd
                
                $insertUserOnWebsite = $bdd->prepare('INSERT INTO users(pseudo, nom, prenom, mdp)VALUES(?, ?, ?, ?)');
                $insertUserOnWebsite->execute(array($user_pseudo, $user_lastname, $user_firstname, $user_password));


                //récuperer les données du users
                $getInfosOfThisUsersReq = $bdd->prepare('SELECT id, pseudo, nom, prenom FROM users WHERE nom = ? && prenom = ? && pseudo = ?');
                $getInfosOfThisUsersReq->execute(array($user_pseudo, $user_lastname, $user_firstname));
                $usersInfos = $getInfosOfThisUsersReq->fetch();

                //Authentifier l'utlisateur sur le site
                $_SESSION['auth'] = true;
                $_SESSION['id'] = $usersInfos['id'];
                $_SESSION['lastname'] = $usersInfos['nom'];
                $_SESSION['firstname'] = $usersInfos['prenom'];
                $_SESSION['pseudo'] = $usersInfos['pseudo'];

                    //rediriger le user vers la page d'acceuil
                header('Location: index.php');
            }else {
                $errorMsg = "L'utilisateur existe déjà sur le site";
            }
            
        }else {
            $errorMsg = "Veuillez compléter tous les champs...";
        }

    }