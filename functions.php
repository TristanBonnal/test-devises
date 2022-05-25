<?php
function calculateLine(float $inputValue, string $currencyInput, string $currencyOuput) {
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

function calculateTotal(float $inputValue1, float $inputValue2, string $currencyInput1, string $currencyInput2, string $currencyOuput) {
    $result = calculateLine($inputValue1, $currencyInput1, $currencyOuput) +
              calculateLine($inputValue2, $currencyInput2, $currencyOuput)
    ;
    return $result;
}
