<?php 
require_once("Util.php");
require_once("../model/Music.php");

$viewPath = "/view/page/assignMusicSinger.php";
$music = new Music();

if(isset($_GET["action"])){
    $action = $_GET["action"];
    // ADD - Create & Update
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

    // DELETE
    else if($action == "delete"){
        try {
            $sql = "DELETE FROM Music WHERE music_id = :music_id";
            $stmt = $this->conn->prepare($sql);
            $success = $stmt->execute([':music_id' => $music_id]);

            return [
                "success" => $success,
                "data" => null, // delete biasanya ga return data
                "err" => $success ? null : "Failed to delete music"
            ];
        } catch (PDOException $e) {
            return [
                "success" => false,
                "data" => null,
                "err" => $e->getMessage()
            ];
        }
    }

    // DELETE ASSIGNED SINGER
    else if($action == "unassign"){
        // check requirements
        $requirements = ["music"];
        $requirementStatus = checkFieldGET($requirements);

        if(!$requirementStatus["status"]){
            redirectWith($viewPath, [
                "err" => $requirementStatus["err"]
            ]);
        }

        $queryStatus = $music->unassignSinger($_GET["music"]);

        if($queryStatus["success"]){
            redirectWith($viewPath, [
                "msg" => "Singer unassigned !!!"
            ]);
        }else{
            redirectWith($viewPath, [
                "err" => "Failed to unassign !!!"
            ]);
        }
    }

    else {
        redirectWith($viewPath, [
            "err" => "Invalid address !"
        ]);
    }
}
?>