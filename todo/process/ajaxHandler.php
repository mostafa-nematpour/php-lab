<?php
include_once "../bootstrap/init.php";

if (!isAjaxRequest()) {
    diePage("Invalid Request", "Access denied");
}
if (!isset($_POST['action']) || empty($_POST['action'])) {
    diePage("Invalid Action", "Access denied");
}
switch ($_POST['action']) {
    case 'addFolder':

        if (!isset($_POST['folderName']) || strlen($_POST['folderName']) < 3) {
            echo "Folder name must be longer than two letters";
            die();
        }
        echo addFolder($_POST['folderName']);
        break;
    case 'addTask':
        $taskTitle = $_POST['taskTitle'] ?? "";
        $folderId = $_POST['folderId'];
        if (!isset($taskTitle) || strlen($taskTitle) < 3) {
            die();
        }
        if (!isset($folderId) || empty($folderId)) {
            die();
        }
        echo addTask($taskTitle, $folderId);
        break;

        case 'doneSwitch':
            $taskId=$_POST['taskId'];
            if (!isset($taskId) || !is_numeric($taskId)) {
                echo "id is invalid";
                die();
            }
            echo doneSwitch($taskId);
            // dd($_POST);
            break;
    default:
        diePage("Invalid Action", "Access denied");
}
