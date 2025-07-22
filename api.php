<?php
header("Content-Type: application/json");
require_once "functions.php";          
date_default_timezone_set('Africa/Nairobi');
$action = $_GET['action'] ?? '';
$path   = $_GET['path']   ?? '';
$target = $_GET['target'] ?? '';       // for copy / move / rename destination
$content= file_get_contents("php://input");

try {
    switch ($action) {
        case 'ls':      // list directory
            $real = realpath($path) ?: realpath('data');
            if (!is_dir($real)) throw new Exception("Invalid dir");
            $items = array_map(function ($f) use ($real) {
                return [
                    'name' => basename($f),
                    'type' => is_dir($f) ? 'dir' : 'file',
                    'size' => is_file($f) ? filesize($f) : 0,
                    'path' => $f,
                    'date' => date("F d Y H:i:s", filemtime($f))
                ];
            }, glob($real . '/*'));
            echo json_encode($items);
            break;

        case 'read':
            echo json_encode(['content' => readFileContent($path)]);
            break;

        case 'write':
            echo json_encode(['msg' => writeFileContent($path, $content)]);
            break;

        case 'append':
            echo json_encode(['msg' => appendFileContent($path, $content)]);
            break;

        case 'createFile':
            echo json_encode(['msg' => createFile($path)]);
            break;

        case 'createDir':
            echo json_encode(['msg' => createDirectory($path)]);
            break;

        case 'delete':
            echo json_encode(['msg' => is_dir($path)
                ? (rmdir($path) ? "Répertoire supprimé" : "Erreur suppression répertoire")
                : deleteFile($path)]);
            break;

        case 'rename':
            echo json_encode(['msg' => renameFile($path, $target)]);
            break;

        case 'copy':
            echo json_encode(['msg' => copyFile($path, $target)]);
            break;

        case 'move':
            echo json_encode(['msg' => moveFile($path, $target)]);
            break;

        default:
            throw new Exception("Action inconnue");
    }
} catch (Exception $e) {
    http_response_code(400);
    echo json_encode(['error' => $e->getMessage()]);
}