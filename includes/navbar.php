<nav class="navbar navbar-expand-lg bg-dark navbar-dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">Forum</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="index.php">Les questions</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="publish_question.php">Publier une question</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="my_questions.php">Mes questions</a>
        </li>

          <?php

              if (isset($_SESSION['auth'])) {
                ?>
                  <li class="nav-item">
                      <a class="nav-link" href="profile.php?id=<?= $_SESSION['id']; ?>">Mon Profil</a>
                  </li>
                  <li class="nav-item">
                     <a class="nav-link" href="action/users/logoutAction.php">Déconnexion</a>
                  </li>
                <?php
              }

          ?>
      </ul>
    </div>
  </div>
</nav>