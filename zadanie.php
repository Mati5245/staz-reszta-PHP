<?php

// Inicjalizacja stanu kasy drobnych
$coins = array(
    "5 zł" => 1,
    "2 zł" => 3,
    "1 zł" => 5,
    "50 gr" => 10,
    "20 gr" => 20,
    "10 gr" => 200,
    "5 gr" => 100,
    "2 gr" => 100,
    "1 gr" => 10000
);

// Funkcja wydająca resztę
function giveChange($amount, &$coins)
{
    echo "Wydawanie reszty dla $amount zł:\n";

    foreach ($coins as $coin => $quantity) {
        // Zamiana nazwy monety na wartość liczbową
        $coinValue = getValue($coin);

        if ($coinValue <= $amount && $quantity > 0) {
            // Obliczanie ilości monet potrzebnej do wydania
            $numCoins = min(floor($amount / $coinValue), $quantity);

            // Aktualizacja stanu kasy drobnych
            $coins[$coin] -= $numCoins;

            // Obliczanie reszty po wydaniu monet
            $amount -= $numCoins * $coinValue;

            // Wyświetlanie informacji o wydanych monetach
            echo "$numCoins x $coin\n";
        }

        if ($amount == 0) {
            break; // Wydano całą resztę
        }
    }

    if ($amount > 0) {
        echo "Nie można wydać całej reszty.\n";
    }
}

// Funkcja pomocnicza do zamiany nazwy monety na wartość liczbową
function getValue($coin)
{
    switch ($coin) {
        case "5 zł":
            return 500;
        case "2 zł":
            return 200;
        case "1 zł":
            return 100;
        case "50 gr":
            return 50;
        case "20 gr":
            return 20;
        case "10 gr":
            return 10;
        case "5 gr":
            return 5;
        case "2 gr":
            return 2;
        case "1 gr":
            return 1;
        default:
            return 0;
    }
}

// Wczytanie reszt do wydania ze standardowego wejścia
$change = readline("Podaj resztę do wydania (oddzielając wartości spacją): ");
$changeValues = explode(" ", $change);

$totalChange = 0;

foreach ($changeValues as $value) {
    $totalChange += intval($value);
}

giveChange($totalChange, $coins);
