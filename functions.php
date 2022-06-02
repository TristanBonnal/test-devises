<?php
//Convertit le montant avec la devise à gauche en entrée, celle de droite en sortie
function calculateLine(float $inputValue, string $currencyInput, string $currencyOuput): float {
    $rates = [
        'EUR' => [
            'EUR' => 1,
            'USD' => 1.1,
            'JPY' => 136
        ],
        'USD' => [
            'EUR' => 0.9,
            'USD' => 1,
            'JPY' => 127
        ],
        'JPY' => [
            'EUR' => 0.0074,
            'USD' => 0.0079,
            'JPY' => 1
        ],
    ];

    $currentRate = $rates[$currencyInput][$currencyOuput];
    return $inputValue * $currentRate;
}

//Calcule le total des deux montants dans la devise demandée
function calculateTotal(float $inputValue1, float $inputValue2, string $currencyInput1, string $currencyInput2, string $currencyOuput): float {
    $result = calculateLine($inputValue1, $currencyInput1, $currencyOuput) +
              calculateLine($inputValue2, $currencyInput2, $currencyOuput)
    ;
    return $result;
}

//Factorisation des formulaires select dans le html
function selectCurrency(int $id): string {
    $eurAttribute = isset($_GET['currency' . $id]) && $_GET['currency' . $id] == 'EUR' ? 'selected' : '';
    $dolAttribute = isset($_GET['currency' . $id]) && $_GET['currency' . $id] == 'USD' ? 'selected' : '';
    $yenAttribute = isset($_GET['currency' . $id]) && $_GET['currency' . $id] == 'JPY' ? 'selected' : '';
    return <<<HTML
        <select class="form-select" name="currency$id">
            <option $eurAttribute value="EUR">EUR</option>
            <option $dolAttribute value="USD">USD</option>
            <option $yenAttribute value="JPY">JPY</option>
        </select>
HTML;
}

// Formate les résultats d'une conversion en chaine de charactères lisible
function convertToString(
    float $amount1, 
    float $amount2, 
    string $currency1, 
    string $currency2, 
    string $currency3, 
    string $currency4, 
    string $currency5, 
    float $result1,
    float $result2,
    float $result3): string {
        $formatedString = 
            "Conversion " . (new DateTime())->format('d/m/Y H:i') . " : 
            $amount1 $currency1 = $result1 $currency3 |
            $amount2 $currency2 = $result2 $currency4 |
            Total = $result3 $currency5
            "
        ;
        return $formatedString;
}

// Conversion via l'api
function convertFromApi(float $amount, string $inputCurrency, string $outputCurrency): float {
    if ($amount == 0) return 0;

    $curl = curl_init();

curl_setopt_array($curl, array(
    CURLOPT_URL => "https://api.apilayer.com/exchangerates_data/convert?to=$outputCurrency&from=$inputCurrency&amount=$amount",
    CURLOPT_HTTPHEADER => array(
        "Content-Type: text/plain",
        "apikey: 1Z61cECQAIZMeKGDJtREUODef0O0QsMU"
    ),
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => "",
    CURLOPT_MAXREDIRS => 1,
    CURLOPT_TIMEOUT => 0,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "GET"
    ));

    $response = curl_exec($curl);

    curl_close($curl);
    $result = json_decode($response)->result;
    return round($result, 3);
}

// Additions de deux conversions faites par l'api
function calculateTotalApi(float $inputValue1, float $inputValue2, string $currencyInput1, string $currencyInput2, string $currencyOuput): float {
    $result = convertFromApi($inputValue1, $currencyInput1, $currencyOuput) +
              convertFromApi($inputValue2, $currencyInput2, $currencyOuput);
    return $result;
}