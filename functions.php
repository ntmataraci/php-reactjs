<?php
header('Access-Control-Allow-Origin: *');
include("connection.php");



class crud {

private $dbh;

function __construct($user){
    $this->dbh=$user;

}



function jsRead () {
    $reading=$this->dbh->prepare("SELECT * FROM rutin");
    $reading->execute();
    $reading=$reading->fetchAll(PDO::FETCH_ASSOC);
    $result=json_encode(($reading));
    echo $result;
}


function read() {
$reading=$this->dbh->prepare("SELECT * FROM rutin");
$reading->execute();
$reading=$reading->fetchAll(PDO::FETCH_ASSOC);

// while(($row=$reading->fetch(PDO::FETCH_ASSOC))!=false){
//     echo $row["baslik"]." ".$row["aciklama"]." ".$row["tip"]."<br>";
// }
//  }
foreach($reading as $read){
    echo "
    <tr>
<td>".$read["baslik"]."</td>
<td>".$read["aciklama"]."</td>
<td>".$read["tip"]."</td>
<td><a href=?update_id=".$read["id"].">Güncelle</a>
<td><a href=?delete_id=".$read["id"].">sil</a>
</tr>
";
}
}

function insert($baslik,$aciklama,$tip){
    $writing=$this->dbh->prepare("INSERT into rutin (baslik,aciklama,tip) values (?,?,?)");
$writing->bindParam(1,$baslik);
$writing->bindParam(2,$aciklama);
$writing->bindParam(3,$tip);
$writing->execute();
header("Location:index.php");
}


function jsInsert($baslik,$aciklama,$tip){
    $writing=$this->dbh->prepare("INSERT into rutin (baslik,aciklama,tip) values (?,?,?)");
    $writing->bindParam(1,$baslik);
    $writing->bindParam(2,$aciklama);
    $writing->bindParam(3,$tip);
    $writing->execute();

}


function delete($id){
    $delete=$this->dbh->prepare("DELETE from rutin WHERE id=".$id);
    $delete->execute();
    header("Location:index.php");
}

function jsDelete($id){
    $delete=$this->dbh->prepare("DELETE from rutin WHERE id=".$id);
    $delete->execute();
}

function update($baslik,$aciklama,$tip,$id){

    $update=$this->dbh->prepare("UPDATE rutin SET baslik=?,aciklama=?,tip=? WHERE id=?");
    $update->bindParam(1,$baslik);
    $update->bindParam(2,$aciklama);
    $update->bindParam(3,$tip);
    $update->bindParam(4,$id);
    $update->execute();

    header("Location:index.php");
 
}

function jsUpdate($baslik,$aciklama,$tip,$id){

    $update=$this->dbh->prepare("UPDATE rutin SET baslik=?,aciklama=?,tip=? WHERE id=?");
    $update->bindParam(1,$baslik);
    $update->bindParam(2,$aciklama);
    $update->bindParam(3,$tip);
    $update->bindParam(4,$id);
    $update->execute();

}




function selection ($id){
    $selection=$this->dbh->prepare("SELECT * from rutin WHERE id=".$id);
    $selection->execute();
    $selection=$selection->fetchAll(PDO::FETCH_ASSOC);

return  [$selection[0]["baslik"],$selection[0]["aciklama"],$selection[0]["tip"]];
}

}

$crud=new crud($dbh);


@$sil=$_GET["delete_id"] ;  
if (isset($sil)){
$crud->delete($_GET["delete_id"]);
}

@$update=$_GET["update_id"];

if (isset($_POST["sender"])){
        $baslik=$_POST["title"];
        $aciklama=$_POST["content"];
        $tip=$_POST["type"];
        $crud->insert($baslik,$aciklama,$tip);
        echo "eklendi";
        }
    
    
    if (isset($_POST["guncel"])){
        $baslik=$_POST["title"];
        $aciklama=$_POST["content"];
        $tip=$_POST["type"];
        $crud->update($baslik,$aciklama,$tip,$update);
        
    }

?>