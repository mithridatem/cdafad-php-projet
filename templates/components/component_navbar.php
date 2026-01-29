<header class="container-fluid">
    <nav>
        <ul>
            <li><strong>Quizz CDA</strong></li>
        </ul>
        <ul>
            <li><a href="/">Accueil</a></li>
            <!-- Menu Utilisateur connecté (ROLE_USER ou ROLE_ADMIN) -->
            <?php
            if (
                isset($_SESSION["user"]["roles"]) &&
                (in_array("ROLE_USER", $_SESSION["user"]["roles"]) ||
                    in_array("ROLE_ADMIN", $_SESSION["user"]["roles"]))
            ) :
            ?>
                <li><a href="/category/add">Ajouter une categorie</a></li>
                <li><a href="/quizz/add">Ajouter un quizz</a></li>
                <li><a href="/logout">Déconnexion</a></li>
                <!-- Menu Utilisateur déconnecté (VISITEUR) -->
            <?php else : ?>
                <li><a href="/register">Inscription</a></li>
                <li><a href="/login">Connexion</a></li>
            <?php endif ?>
        </ul>
    </nav>
</header>