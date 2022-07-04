<?php
$search =$result["data"]["search"];
$search2 =$result["data"]["search2"];
$search3 =$result["data"]["search3"];
var_dump($search);die;
var_dump($search2);die;
var_dump($search3);die;
?>


<h1>resultat recherche</h1>

<?php foreach ($search as $s){
    echo "<P>".$s."</br></p>";
}
?>
<?php foreach ($search2 as $s){
    echo "<P>".$s."</br></p>";
}
?>
<?php foreach ($search3 as $s){
    echo "<P>".$s."</br></p>";
}
?>