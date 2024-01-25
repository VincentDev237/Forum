<?php

    session_start();
    require('action/questions/showAllQuestionAction.php');
?>
<!DOCTYPE html>
<html lang="en">
<?php include 'includes/head.php'; ?>
<body>
    <?php include 'includes/navbar.php'; ?> 
    <br><br>

    <div class="container">

        <form>
            <div class="form-group row">

                <div class="col-8">
                    <input type="search" name="search" class="form-control">
                </div>
                <div class="col-4">
                    <button class="btn btn-success">Rechercher</button>
                </div>

            </div>
        </form>

        <br>

        <?php

            while ($question = $getAllQuestion->fetch()) {
                ?>

                    <div class="card">
                        <div class="card-header">
                            <a href="question.php?id=<?= $question['id']; ?>">
                                 <?= $question['titre']; ?>
                             </a>
                        </div>
                        <div class="card-body">
                            <?= $question['description']; ?>
                        </div>
                        <div class="card-footer">
                            Publié par <a href="profile.php?id=<?= $question['id_auteur']; ?>"> <?= $question['pseudo_auteur']; ?></a> le <?= $question['date_publication']; ?>
                        </div>
                    </div>
                <br>
                <?php
            }

        ?>

    </div>


</body>
</html>