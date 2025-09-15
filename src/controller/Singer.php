<?php 
require_once("Util.php");
require_once("../model/Singer.php");

$singerPath = "/view/page/addSinger.php";
$singer = new Singer();

if(isset($_GET["action"])){
    $action = $_GET["action"];
    
    // add video
    if($action == "add"){
        // check isset variable for these fields
        $requirements = ["name", "birthDate", "genre", "height", "weight"];
        $checkRequirements = checkFieldPOST($requirements);

        // if requirement variable is not defined
        if(!$checkRequirements["status"]){
            redirectWith($singerPath, [
                "err" => $checkRequirements["err"]
            ]);
        }

        // add data to DB
        $queryStatus = $singer->addSinger(
            $_POST["name"],
            $_POST["birthDate"],
            $_POST["genre"],
            $_POST["weight"],
            $_POST["height"]
        );

        if($queryStatus["success"]){
            redirectWith("/view/page/addSinger.php", [
                "msg" => $_POST["name"]." Added!!!"
            ]);
        }else{
            redirectWith($singerPath, [
                "err" => $queryStatus["err"]
            ]);
        }
    }
    
    // edit video
    else if($action == "edit"){

        // check is singer ID isset
        if(!isset($_GET["id"])){
            redirectWith($singerPath, [
                "err" => "Singer ID is not provided !"
            ]);
        }
        
        // check isset variable for these fields
        $requirements = ["name", "birthDate", "genre", "height", "weight"];
        $checkRequirements = checkFieldPOST($requirements);

        // if POST requirement isnt available -> means request edit data based on the id
        if( !$checkRequirements["status"] ){
            $singerData = $singer->getSingerById($_GET["id"]);

            if($singerData["success"]){
                redirectWith($singerPath, array_merge(
                    ["edit" => "true"],
                    $singerData["data"] ?? []
                ));
            }else{
                // singer data not found based on the given id
                redirectWith($singerPath, [
                    "err" => $singerData["err"]
                ]);
            }
        }

        $queryStatus = $singer->updateSinger(
            $_GET["id"],
            $_POST["name"],
            $_POST["birthDate"],
            $_POST["genre"],
            $_POST["height"],
            $_POST["weight"]
        );
        if($queryStatus["success"]){
            redirectWith($singerPath, [
                "msg" => $_POST["name"]." Updated !!!"
            ]);
        }else{
            redirectWith($singerPath, [
                "err" => $queryStatus["err"]
            ]);
        }
    }

    // delete video
    else if($action == "delete"){
        if(!isset($_GET["id"])){
            redirectWith($singerPath, [
                "err" => "Id is not provided !!!"
            ]);
        }

        $queryStatus = $singer->deleteSinger($_GET["id"]);
        if($queryStatus["success"]){
            redirectWith($singerPath, [
                "msg" => "Singer deleted !!!"
            ]);
        }else{
            redirectWith($singerPath, [
                "err" => "Video not available !!!"
            ]);
        }
    }

    else{
        redirectWith($singerPath, [
            "err" => "Invalid address"
        ]);
    }
}


?>