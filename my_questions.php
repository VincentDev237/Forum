<?php

    require('action/users/securityAction.php');
    require('action/questions/myQuestionsAction.php');
    

?>

<!DOCTYPE html>
<html>
    <?php include 'includes/head.php'; ?>
    <body>
        <?php include 'includes/navbar.php'; ?>
        <br><br>
        <div class="container">

            <?php

                while ($question = $getAllMyQuestions->fetch()) {
                    ?>
                        <div class="card">
                            <h5 class="card-header">
                                <a href="question.php?id=<?= $question['id']; ?>">
                                    <?= $question['titre']; ?>
                                </a>
                            </h5>
                            <div class="card-body">
                                <p class="card-text">
                                    <?= $question['description']; ?>
                                </p>
                                <a href="question.php?id=<?= $question['id']; ?>" class="btn btn-primary">Accéder à la question</a>
                                <a href="edit_questions.php?id=<?= $question['id']; ?>" class="btn btn-warning">Modifier la question</a>
                                <a href="action/questions/deleteQuestionAction.php?id=<?= $question['id']; ?>" class="btn btn-danger">Supprimer la question</a>
                            </div>
                        </div>
                        <br>
                    <?php
                }

            ?>

        </div>

    </body>
</html>