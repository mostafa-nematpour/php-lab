<?php

function insertLocation($data)
{
    global $PDO;

    //validation here ...
    $sql = "INSERT INTO `locations` (`title`, `lat`, `lng`, `type`) VALUES ( :title, :lat, :lng, :typ);";
    $stmt = $PDO->prepare($sql);
    $stmt->execute(['title' => $data['title'], 'lat' => $data['lat'], 'lng' => $data['lng'], 'typ' => $data['type']]);

    return $stmt->rowCount();
}


function getLocations($params = [])
{
    global $PDO;
    $condition = '';

    if (isset($params['verified']) and in_array($params['verified'], ['0', '1'])) {
        $condition = "where verified = {$params['verified']}";
    } else if (isset($params['keyword'])) {
        $condition = "where verified=1 and title like '%{$params['keyword']}%'";
    }

    $sql = "SELECT * FROM `locations` $condition ";
    $stmt = $PDO->prepare($sql);
    $result = $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_OBJ);
}


function getRangeLocations($params = [])
{
    global $PDO;
    $condition = '';

    if (
        isset($_GET['northLine']) and
        isset($_GET['westLine']) and
        isset($_GET['southLine']) and
        isset($_GET['eastLine'])
    ) {

        $condition = "where verified=1 and lat < :northLine AND" .
            " lat > :southLine AND lng < :eastLine AND lng > :westLine";
        $sql = "SELECT * FROM `locations` $condition ";
        $stmt = $PDO->prepare($sql);
        $result = $stmt->execute(
            [
                'northLine' => $params['northLine'],
                'westLine'  => $params['westLine'],
                'southLine' => $params['southLine'],
                'eastLine'  => $params['eastLine']
            ]
        );
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }
}

function getLocation($id)
{
    global $PDO;
    $sql = "SELECT * FROM `locations` where id = :id";
    $stmt = $PDO->prepare($sql);
    $result = $stmt->execute(['id' => $id]);
    return $stmt->fetch(PDO::FETCH_OBJ);
}


function toggleStatus($id)
{
    global $PDO;
    $sql = "UPDATE `locations` SET verified = 1 - verified WHERE id = :id";
    $stmt = $PDO->prepare($sql);
    $result = $stmt->execute(['id' => $id]);
    return $stmt->rowCount();
}
