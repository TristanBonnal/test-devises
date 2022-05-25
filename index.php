<!-- logique -->
<?php
require_once "functions.php";
if (!empty($_GET)) {
    $amount1 = (float) $_GET['amount1'] ?? 0;
    $amount2 = (float) $_GET['amount2'] ?? 0;
    $currency1 = $_GET['first-currency'] ?? 'EUR';
    $currency2 = $_GET['second-currency'] ?? 'EUR';

    $results = calculate($amount1, $amount2, $currency1, $currency2);
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
</head>
<body>
    <div class="container">
        <h1 class="text-center">Calcul et addition de devises</h1>
        <form class="form-main" action="" method="get">
            <div class="calcul">
                <div class="first-amount">
                    <label for="amount1" class="form-label">Montant n°1</label>
                    <input type="number" step="0.01" class="form-input" id="amount1" name="amount1" value="<?= $amount1 ?? '' ?>">
                </div>
                <select class="first-currency form-select" name="first-currency">
                    <option <?= isset($currency1) && $currency1 != 'USD' ? 'selected' : '' ?> value="EUR">EUR</option>
                    <option <?= isset($currency1) && $currency1 == 'USD' ? 'selected' : '' ?> value="USD">USD</option>
                </select>
            </div>
            <div class="calcul">
                <div class="second-amount">
                    <label for="amount2" class="form-label">Montant n°2</label>
                    <input type="number" step="0.01" class="form-input" id="amount2" name="amount2" value="<?= $amount2 ?? '' ?>">
                </div>
                <select class="second-currency form-select" name="second-currency">
                    <option <?= isset($currency2) && $currency2 != 'USD' ? 'selected' : '' ?> value="EUR">EUR</option>
                    <option <?= isset($currency2) && $currency2 == 'USD' ? 'selected' : '' ?> value="USD">USD</option>
                </select>
            </div>
            <button>Calculer</button>
        </form>
        <div class="result">
            <div class="label-result">Total :</div>
            <div class="value-result"><?= $results['value'] ?? 0 ?></div>
            <div class="currency-result"><?= $results['currency'] ?? 'EUR' ?></div>
        </div>
    </div>  
</body>
</html>
