<?php
function getFolders()
{
    global $PDO;
    $current_user_id = getCurrentUserId();
    try {
        $sql = "select * from folder where user_id= $current_user_id";
        $stmt = $PDO->prepare($sql);
        $stmt->execute();
    } catch (Exception $e) {
        diePage($e->getMessage(), "get Folder Faile");
    }
    $records = $stmt->fetchAll(PDO::FETCH_OBJ);
    return $records;
}

function deleteFolder($folder_id)
{
    global $PDO;
    try {
        $sql = "delete from folder where id= $folder_id";
        $stmt = $PDO->prepare($sql);
        $stmt->execute();
    } catch (Exception $e) {
        diePage($e->getMessage(), "delete Folder Faile");
    }

    return $stmt->rowCount();
}

function addFolder($folderName)
{
    $current_user_id = getCurrentUserId();

    global $PDO;
    try {
        $sql = "INSERT INTO `folder` (`name`, `user_id`) VALUES (:folderName, :current_user_id);";
        $stmt = $PDO->prepare($sql);
        $stmt->execute([':folderName' => $folderName, ':current_user_id' => $current_user_id]);
    } catch (Exception $e) {
        diePage($e->getMessage(), "add Folder Faile");
    }

    return '{"response":' . $stmt->rowCount() . ',"id":' . $PDO->lastInsertId() . '}';
}
function getTasks($folder_id = 0)
{
    $s = "";
    if ($folder_id != 0) {
        $s = " and folder_id= $folder_id";
    }
    global $PDO;
    $current_user_id = getCurrentUserId();
    try {
        $sql = "select * from tasks where user_id= $current_user_id $s";
        $stmt = $PDO->prepare($sql);
        $stmt->execute();
    } catch (Exception $e) {
        diePage($e->getMessage(), "get tasks Faile");
    }
    $records = $stmt->fetchAll(PDO::FETCH_OBJ);
    return $records;
}


function deleteTasks($task_id)
{
    global $PDO;
    try {
        $sql = "delete from tasks where id= $task_id";
        $stmt = $PDO->prepare($sql);
        $stmt->execute();
    } catch (Exception $e) {
        diePage($e->getMessage(), "delete Task Faile");
    }

    return $stmt->rowCount();
}


function addTask($title, $folderId)
{

    $current_user_id = getCurrentUserId();

    global $PDO;
    try {
        $sql = "INSERT INTO `tasks` (`title`, `user_id`,`folder_id`) VALUES (:title, :current_user_id, :folderId);";
        $stmt = $PDO->prepare($sql);
        $stmt->execute([':title' => $title, ':current_user_id' => $current_user_id, ':folderId' => $folderId]);
    } catch (Exception $e) {
        diePage($e->getMessage(), "add task Faile");
    }

    return '{"response":' . $stmt->rowCount() . ',"id":' . $PDO->lastInsertId() . '}';
}


function doneSwitch($taskId)
{
    $current_user_id = getCurrentUserId();

    global $PDO;
    try {
        $sql = "Update `tasks` set is_done = 1 - is_done where user_id = :userId and  id = :taskId;";
        $stmt = $PDO->prepare($sql);
        $stmt->execute([':taskId' => $taskId, 'userId' => $current_user_id]);
    } catch (Exception $e) {
        diePage($e->getMessage(), "Switch task Faile");
    }

    return '{"response":' . $stmt->rowCount() . ',"id":' . $PDO->lastInsertId() . '}';
}

function removeTasks()
{
    return [1, 1, 2, 3, 4];
}
