<?php
function calculate(float $firstValue, float $secondValue, $firstCurrency, $secondCurrency) {

    //Selon l'énoncé, si les deux montants sont en dollars, le total sera en dollars, 
    //sinon les valeurs seront converties en euros
    $resultCurrency = ($firstCurrency == 'USD' && $secondCurrency == 'USD') ? 'USD' : 'EUR';

    //Conversion en euros si le montant rentré est en dollars, et le résultat attendu en euros
    if ($resultCurrency == 'USD') {
        $firstAmount = $firstValue;
        $secondAmount = $secondValue;
    } else {
        $firstAmount = $firstCurrency == 'USD' ? $firstValue * 0.9 : $firstValue;
        $secondAmount = $secondCurrency == 'USD' ? $secondValue * 0.9 : $secondValue;
    }

    $result = $firstAmount + $secondAmount;
    return [
        'value' => $result,
        'currency' => $resultCurrency
    ];
}