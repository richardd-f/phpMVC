<?php 
require_once("Util.php");
require_once("../model/Music.php");

$viewPath = "/view/page/assignMusicSinger.php";
$music = new Music();

if(isset($_GET["action"])){
    $action = $_GET["action"];
    // ADD
    if($action == "add"){
        // check requirements
        $requirements = ["music", "singer"];
        $requirementStatus = checkFieldPOST($requirements);

        if(!$requirementStatus["status"]){
            redirectWith($viewPath, [
                "err" => $requirementStatus["err"]
            ]);
        }

        $queryStatus = $music->assignSinger($_POST["music"], $_POST["singer"]);

        if($queryStatus["success"]){
            redirectWith($viewPath, [
                "msg" => "Singer assigned !!!"
            ]);
        }else{
            redirectWith($viewPath, [
                "err" => "Failed to assign !!!"
            ]);
        }

    }

    // EDIT
    else if($action == "edit"){

    }

    // DELETE
    else if($action == "delete"){

    }
}
?>