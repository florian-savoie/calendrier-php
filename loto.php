<?php
try {
    $bdd = new PDO('mysql:host=localhost;dbname=lotto;charset=utf8;', 'root', '');
} catch (Exception $e) {
    die('Une erreur a été trouvée lors de la connection a la bdd: ' . $e->getMessage());
}

if (isset($_POST['jouer'])) {

    // Générer un nouveau tirage
    $numbers = array(rand(1, 7), rand(1, 7), rand(1, 7));
    sort($numbers);
    $tirage = implode("", $numbers);

    // Vérifier si le tirage a déjà été effectué auparavant
    $precedentirage = $bdd->prepare("SELECT * FROM tirage");
    $precedentirage->execute();
    $comparaison = false;
    foreach ($precedentirage as $resultat) {
        $verif = $resultat["num1"] . $resultat["num2"] . $resultat["num3"];
        if ($verif == $tirage) {
            echo "Ce numéro a déjà été tiré.<br>";
            $comparaison = false;
            break;
        }else{
            $comparaison = true;

        }
    }

    // Si le tirage n'a jamais été effectué, l'enregistrer dans la base de données
    if ($comparaison) {
        echo "Votre résultat a bien été enregistré.<br>";
        $jeux = $bdd->prepare("INSERT INTO tirage (num1, num2, num3) VALUES (?, ?, ?)");
        $jeux->execute(array($tirage[0], $tirage[1], $tirage[2]));
        $comparaison = false;
    }
} 

$verifdoublon = true;
?>
<table> 
<?php
 $z = 1 ;
    for ($i = 1; $i <= 7; $i++) {
        for ($e = 1; $e <= 7; $e++) {
                   

            if ( $i == $e && $i == $z){
                echo "<tr><td>".$z . $e . $i . "</td></tr>";
                $z += 1;
            }
            else if ($i == $e) {
                if ($verifdoublon == true) {
                    echo "<tr><td>1" . $e . $i . "</td></tr>";
                    $verifdoublon = false;
                } else {
                    $verifdoublon = true;
                }
            } else {
                echo "<tr><td>1" . $e . $i . "</td></tr>";
            }
        }
        $verifdoublon = true;
    }
    
?>
</tr></table>
<?php
?>
<!DOCTYPE html>
<html lang="en">


<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>

    <form method="post">
        <input type="submit" name="jouer" value="lancerlejeux">
    </form>

    <form action="lotoreset.php" method="post">
        <input type="submit" name="submit" value="Réinitialiser le loto">
    </form>
</body>

</html>
