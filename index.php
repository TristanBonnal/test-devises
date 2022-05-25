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
                    <input type="number" class="form-input" id="value1">
                </div>
                <select class="first-currency form-select" name="first-currency">
                    <option selected>Devise</option>
                    <option value="eur">EUR</option>
                    <option value="usd">USD</option>
                </select>
            </div>
            <div class="calcul">
                <div class="second-amount">
                    <label for="amount2" class="form-label">Montant n°2</label>
                    <input type="number" class="form-input" id="value2">
                </div>
                <select class="second-currency form-select" name="second-currency">
                    <option selected>Devise</option>
                    <option value="eur">EUR</option>
                    <option value="usd">USD</option>
                </select>
            </div>
        <button>Calculer</button>
        </form>
        <div class="result">
            <div class="label-result">Total :</div>
            <div class="value-result">0</div>
            <div class="currency-result">EUR</div>
        </div>
    </div>
    
</body>
</html>