<?php


    session_start();
    if (!isset($_SESSION['auth'])) {
        header('Location: ../../login.php');
    }

    require('../database.php');

    if (isset($_GET['id']) && !empty($_GET['id'])) {
        
        $idOfTheQuestion = $_GET['id'];
 
        $checkIfQuestionsExists = $bdd->prepare('SELECT id_auteur FROM questions WHERE id = ?');
        $checkIfQuestionsExists->execute(array($idOfTheQuestion));

        if ($checkIfQuestionsExists->rowCount() > 0) {
            
            $questionInfos = $checkIfQuestionsExists->fetch();
            if ($questionInfos['id_auteur'] == $_SESSION['id']) {
                $deleteThisQuestion = $bdd->prepare('DELETE FROM QUESTIONS WHERE id = ?');
                $deleteThisQuestion->execute(array($idOfTheQuestion));

                header('Location: ../../my_questions.php');
            }else {
                echo "Vous n'avez pas le droit de supprimer une question qui ne vous appartient pas !";
            }

        }else {
            $errorMsg = "Aucune question n'a été trouvée";
        }

    }else {
        $errorMsg = "Aucune question n'a été trouvée";
    }