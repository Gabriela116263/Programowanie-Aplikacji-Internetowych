<?php

function walidujNumerKonta($numerKonta) {
    $numerKonta = str_replace(' ', '', $numerKonta);
    
    if (strlen($numerKonta) !== 26) {
        return "Numer konta musi zawierać dokładnie 26 cyfr.";
    }

    if (!ctype_digit($numerKonta)) {
        return "Numer konta może zawierać tylko cyfry.";
    }

    return true;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nazwaOdbiorcy = trim($_POST['nazwa_odbiorcy']);
    $numerKonta = trim($_POST['numer_konta']);
    $tytulPrzelewu = trim($_POST['tytul_przelewu']);
    $kwota = trim($_POST['kwota']);

    $blad = walidujNumerKonta($numerKonta);

    if ($blad === true) {
        echo "<p>✅ Przelew został zrealizowany pomyślnie!</p>";
        echo "<p><strong>Odbiorca:</strong> $nazwaOdbiorcy</p>";
        echo "<p><strong>Numer konta:</strong> $numerKonta</p>";
        echo "<p><strong>Tytuł przelewu:</strong> $tytulPrzelewu</p>";
        echo "<p><strong>Kwota:</strong> $kwota PLN</p>";
    } else {
        echo "<p style='color:red;'>Błąd: $blad</p>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>System Przelewów Bankowych</title>
</head>
<body>
    <h2>Wykonaj przelew</h2>
    <form method="POST">
        <label>Odbiorca:<br>
            <input type="text" name="nazwa_odbiorcy" required>
        </label><br><br>
        
        <label>Numer konta (26 cyfr):<br>
            <input type="text" name="numer_konta" required>
        </label><br><br>
        
        <label>Tytuł przelewu:<br>
            <input type="text" name="tytul_przelewu" required>
        </label><br><br>

        <label>Kwota (PLN):<br>
            <input type="number" step="0.01" name="kwota" required>
        </label><br><br>
        
        <input type="submit" value="Wyślij przelew">
    </form>
</body>
</html>
