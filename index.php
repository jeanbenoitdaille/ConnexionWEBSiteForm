<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8"/>
</head>
<body>
<?php
session_start();

if (!isset($_COOKIE['countVisits'])) {
    setcookie('countVisits', 1, time() + 86400);
} else {
    $countVisits = (int)$_COOKIE['countVisits'] + 1;

    setcookie('countVisits', $countVisits, time() + 86400);
}

echo sprintf("Vous avez visité cette page %s fois <br/>", $_COOKIE['countVisits']);

if ('GET' === $_SERVER['REQUEST_METHOD']) {
    if (isset($_SESSION['name']) && isset($_SESSION['email'])) {
        echo sprintf('Bienvenue %s, votre adresse e-mail est la suivante %s <br/>', $_SESSION['name'], $_SESSION['email']);
        echo sprintf('Votre adresse IP est la suivante : %s <br/>', $_SERVER['REMOTE_ADDR']);
    } else {
        ?>
        <form method="post" action="">
            <label for="name">Votre nom</label>
            <input type="text" name="name" id="name" required placeholder="Saisissez votre nom">

            <label for="email">Votre adresse e-mail</label>
            <input type="email" name="email" id="email" required placeholder="Saisissez votre e-mail">

            <button type="submit">Soumettre le formulaire</button>
        </form>
        <?php
    }
} elseif ('POST' === $_SERVER['REQUEST_METHOD']) {
    $_SESSION['name'] = $_POST['name'];
    $_SESSION['email'] = $_POST['email'];
}

?>

</body>
<style>
/**
    Attention, ce CSS est là uniquement pour rendre le formulaire "agréable" à la lecture sans que vous n'ayez
    à récupérer deux fichiers distincts.
    Dans un cas d'usage "réel", ces éléments doivent être externalisés
     */
    body {
        font-family: Calibri, serif;
    }

    form {
        max-width: 50%;
    }

    form label {
        display: block;
        font-weight: bold;
        margin-bottom: 10px;
    }

    form input, form select, form textarea {
        display: inline-block;
        margin-bottom: 10px;
        padding: 10px;
        width: 80%;
    }

    form input[type="radio"],
    form input[type="checkbox"],
    form input[type="submit"] {
        width: auto;
    }

    button[type=submit], button[type=reset] {
        padding: 10px;
        margin-top: 15px;
    }
</style>
</html>
