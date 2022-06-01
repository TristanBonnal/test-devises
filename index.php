<?php
session_start();
require_once "functions.php";
require_once "vendor/autoload.php";
convertFromApi();
die;

// Conversion devises, addition, et stockage en session
if (!empty($_GET)) {
    // Récupération des valeurs entrées dans les champs par l'utilisateur
    $amount1 = (float) $_GET['amount1'] ?? 0;
    $amount2 = (float) $_GET['amount2'] ?? 0;
    $currency1 = $_GET['currency1'] ?? 'EUR';
    $currency2 = $_GET['currency2'] ?? 'EUR';
    $currency3 = $_GET['currency3'] ?? 'EUR';
    $currency4 = $_GET['currency4'] ?? 'EUR';
    $currency5 = $_GET['currency5'] ?? 'EUR';

    // Traitement des données pour les afficher ensuite dans le html
    $result1 = calculateLine($amount1, $currency1, $currency3);
    $result2 = calculateLine($amount2, $currency2, $currency4);
    $total = calculateTotal($amount1, $amount2, $currency1, $currency2, $currency5);

    // Stockage des conversions en sesssion pour les envoyer plus tard à l'utilisateur par mail
    $_SESSION['history'][]= convertToString($amount1, $amount2, $currency1, $currency2, $currency3, $currency4, $currency5, $result1, $result2, $total);
}

// Envoie d'email
if (!empty($_POST)) {
    $mailAdress = $_POST['email'];
    $subject = "Historiques de vos conversions";
    $message = implode("\n", $_SESSION['history'] ?? [] ); // Possibilité de formater plus prorement le texte

    // Si l'email a un format valide, on envoie l'historique, 
    // et on passe a true la variable qui nous permettra d'afficher un message de validation
    if (filter_var($mailAdress, FILTER_VALIDATE_EMAIL)) {
        // TODO : configurer headers + SMTP
        //mail($mailAdress, $subject, $message);
        $emailCheck = true;
    } else {
        $emailCheck = false;
    }
}
?>

<!-- html -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calculateur devises</title>
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,300;0,400;0,500;0,700;1,400&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.3/font/bootstrap-icons.css">
</head>
<body>
    <div class="container">
        <h1 class="text-center">Calcul et addition de devises</h1>
        <form class="form-main" action="" method="get">
            <div class="calcul">
                <div class="first-amount">
                    <input placeholder="Montant 1" type="number" step="0.01" class="form-input" id="amount1" name="amount1" value="<?= $amount1 ?? '' ?>">
                </div>
                <?= selectCurrency(1) ?>
                <div class="arrow">
                    <i class="bi bi-arrow-right-circle"></i>
                </div>
                <?= selectCurrency(3) ?>
                <div class="line-result"><?= $result1 ?? 0 ?></div>
            </div>
            <div class="calcul">
                <div class="second-amount">
                    <input placeholder="Montant 2" type="number" step="0.01" class="form-input" id="amount2" name="amount2" value="<?= $amount2 ?? '' ?>">
                </div>
                <?= selectCurrency(2) ?>
                <div class="arrow">
                    <i class="bi bi-arrow-right-circle"></i>
                </div>
                <?= selectCurrency(4) ?>
                <div class="line-result"><?= $result2 ?? 0 ?></div>
            </div>
            <button class="calculate-btn">Calculer</button>
            <div class="result">
                <div class="label-result">Total :</div>
                <?= selectCurrency(5) ?>
                <div class="value-result"><?= $total ?? 0 ?></div>
            </div>
        </form>
        <hr>
        <div class="history">
            <h3>Enregistrez votre historique</h3>
            <form action="" method="post">
                <input class="email-input" type="text" placeholder="exemple@gmail.com" name="email">
                <button class="send-btn">Envoyer</button>
            </form>
            <?php if (isset($emailCheck) && $emailCheck) : ?>
                <p class="success-message">Historique envoyé !</p>
            <?php elseif (isset($emailCheck) && !$emailCheck) : ?>
                <p class="error-message">Email non valide !</p>
            <?php endif ?>
        </div>
    </div>  
</body>
</html>
