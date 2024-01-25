<?php
    session_start();
    require('action/database.php');

    //Validation du formulaire

    if (isset($_POST['validate'])) {

        //Vérification des données entrer par le users
        
        if (!empty($_POST['pseudo']) && !empty($_POST['password'])) {

            //Les données de users
            $user_pseudo = htmlspecialchars($_POST['pseudo']);
            $user_password = htmlspecialchars($_POST['password']);

            #... vérifier si l'utilisateur existe
            $checkIfUserExists = $bdd->prepare('SELECT * FROM users WHERE pseudo = ?');
            $checkIfUserExists->execute(array($user_pseudo));

            if ($checkIfUserExists->rowCount() > 0) {
                #... Récupere les données de l'utilisateur
                $usersInfos = $checkIfUserExists->fetch();
                if (password_verify($user_password, $usersInfos['mdp'])) {
                    
                    //Authentifier l'utlisateur sur le site
                $_SESSION['auth'] = true;
                $_SESSION['id'] = $usersInfos['id'];
                $_SESSION['lastname'] = $usersInfos['nom'];
                $_SESSION['firstname'] = $usersInfos['prenom'];
                $_SESSION['pseudo'] = $usersInfos['pseudo'];

                    //rediriger le user vers la page d'acceuil
                header('Location: index.php');

                }else{
                    $errorMsg = "Votre mot de passe est incorrect...";
                }
            }else{
                $errorMsg = "Votre pseudo est incorrect...";
            }
            
        }else {
            $errorMsg = "Veuillez compléter tous les champs...";
        }

    }