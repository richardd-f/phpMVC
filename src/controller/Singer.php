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

        if( $checkRequirements["status"] ){
            $queryStatus = $singer->addSinger(
                $_POST["name"],
                $_POST["birthDate"],
                $_POST["genre"],
                $_POST["weight"],
                $_POST["height"]
            );

            if($queryStatus["success"]){
                redirectWith("/view/page/addSinger.php", [
                    "msg" => "Singer Saved!!!"
                ]);
            }else{
                redirectWith($singerPath, [
                    "err" => $queryStatus["err"]
                ]);
            }
        }else{
            redirectWith($singerPath, [
                "err" => $checkRequirements["err"]
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

        if( !$checkRequirements["status"] ){
            redirectWith($singerPath, [
                "err" => $checkRequirements["err"]
            ]);
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
                "msg" => "Singer Updated !!!"
            ]);
        }else{
            redirectWith($singerPath, [
                "err" => $queryStatus["err"]
            ]);
        }
    }

    // delete video
    else if($action == "delete"){

    }

    else{
        redirectWith($singerPath, [
            "err" => "Page is Restricted"
        ]);
    }
}


?>