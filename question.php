<?php 
    session_start();
    require('action/questions/showQuestionContentAction.php');
    require('action/questions/postAnswerAction.php');
    require('action/questions/showAllAnswerOfQuestionAction.php');
?>
<!DOCTYPE html>
<html lang="en">
<?php include 'includes/head.php'; ?>
<body>
    <?php include 'includes/navbar.php'; ?>
    <br><br>

    <div class="container">
        <?php

                if (isset($errorMsg)) { echo $errorMsg; }

                if (isset($question_publication_date)) {
                    ?>

                    <session class="show-content">
                        <h3><?= $question_title; ?></h3>
                        <hr>
                        <p><?= $question_content; ?></p>
                        <hr>
                        <small> <?= '<a href="profile.php?id='.$question_id_author.'">'.$question_pseudo_author. '</a> '. $question_publication_date; ?></small>
                    </session>

                    <br>

                    <session class="show-answers">
                        <form class="form-group" method="POST">
                            <div class="mb-3">
                                <br>
                                <label for="exampleInputEmail1" class="form-label">Réponse: </label>
                                <textarea name="answer" class="form-control"></textarea>
                                <br>
                                <button class="btn btn-primary" type="submit" name="validate">Répondre</button>
                            </div>
                           
                        </form>

                        <?php

                            while ($answer = $getAllAnswersOfThisQuestion->fetch()) {
                                ?>
                                    <div class="card">
                                        <div class="card-header">
                                            <a href="profile.php?id=<?= $answer['id_auteur']; ?>">
                                                <?= $answer['pseudo_auteur']; ?>
                                            </a>
                                        </div>
                                        <div class="card-body">
                                            <?= $answer['contenu']; ?>
                                        </div>
                                    </div>
                                    <br>
                                <?php
                            }
                        ?>
                    </session>
                    <?php
                }

        ?>
    </div>
</body>
</html>