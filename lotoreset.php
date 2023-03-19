
<?php
try{
    $bdd = new PDO('mysql:host=localhost;dbname=lotto;charset=utf8;', 'root', '');
}catch(Exception $e){
    die('Une erreur a été trouvée lors de la connection a la bdd: ' . $e->getMessage());
}
$reset = $bdd->prepare("drop table tirage");
$reset->execute() ;
$createtable = $bdd->prepare("CREATE TABLE tirage (
    num1 INT NOT NULL,
    num2 INT NOT NULL,
    num3 INT NOT NULL
);");
$createtable->execute() ;

header('Location: loto.php');
exit;

