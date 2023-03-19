
<?php
try{
    $bdd = new PDO('mysql:host=localhost;dbname=calendrier;charset=utf8;', 'root', '');
}catch(Exception $e){
    die('Une erreur a été trouvée lors de la connection a la bdd: ' . $e->getMessage());
}

$calendriers = $bdd->prepare('SELECT * FROM examens');
$calendriers->execute(); 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        table{
            background-color: white;
        }
        td{
height: 60px;
width: 60px;
text-align: center;
padding: 10px;

        }
        body{
            background-color: #009a90;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
thead{
background-color:#2ecec6 ;
padding: 90px;
font-size: 40px;

}   
.bgmodif{
    text-align: center;
background-color: #2ecec6;
border-radius: 50%;
color: white;
}
 </style>
</head>
<body>
<table>
  <thead>
    <tr>
      <th colspan="7">Examen</th>
    </tr>
    
  </thead>
  <tbody>
<?php 
$i = 0 ;
foreach ($calendriers as $jour) {
    if($i == 0){
        echo "<tr><td class='".($jour["matiere"] ? "bgmodif" : "")."'>".$jour["numjour"]."<br>".$jour["matiére"]."<br>".$jour["matiere"]."</td>";
        $i++;
    }else if($i > 0 && $i <= 6){
    echo " <td class='".($jour["matiere"] ? "bgmodif" : "")."'>".$jour["numjour"]."<br>".$jour["matiére"]."<br>".$jour["matiere"]."</td>";

    $i++;
    if ($i == 7){
        echo "</tr>";
        $i = 0 ;
    }
}}

?>
    <!-- Ajouter plus de lignes de données ici -->
  </tbody>
</table>
</body>
</html>