<?php

include("functions.php");

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        table,th,td{
            border:1px solid black;
            text-align: center;
        }
        
        </style>
</head>
<body>
    
<h1>RUTİNLER</h1>
<table>
    <thead >
    <tr >
        <th style="width:300px;">Başlık</th>
        <th style="width:500px;">Açıklama</th>
        <th style="width:100px;">Tip</th>
    </tr>
    </thead>


<?php

$crud->read();
?>

</table>

<?php
if (isset($_GET["update_id"])){
    $myArray=$crud->selection($_GET["update_id"]);

    echo "
    <form  method=post>
Başlık: <input type=text name=title value=".$myArray[0]."></input>
Açıklama: <input type=text name=content value=".$myArray[1]."></input>
Tip: <input type=text name=type value=".$myArray[2]."></input>
<input type=submit value=Güncelle name=guncel></input>
</form>
"; 


}else{
    echo "
    <form action=functions.php method=post>
Başlık: <input type=text name=title></input>
Açıklama: <input type=text name=content></input>
Tip: <input type=text name=type></input>
<input type=submit value=Gönder name=sender></input>
</form>
"; 
}
?>



</body>
</html>