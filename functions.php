<?php 

//---------- Manipulation des fichiers

// Créer un fichier
function createFile($filePath) {
    try {
        if (!file_exists($filePath)) {
            $file = fopen($filePath, 'w');
            if ($file) {
                fclose($file);
                return ['status' => 'success', 'msg' => 'Fichier créé avec succès.'];
            }
            throw new Exception('Erreur lors de la création du fichier.');
        }
        throw new Exception('Le fichier existe déjà.');
    } catch (Exception $e) {
        return ['status' => 'error', 'msg' => $e->getMessage()];
    }
}

function readFileContent($filePath) {
    try {
        if (!file_exists($filePath)) {
            return [
                'status' => 'error',
                'msg' => 'Le fichier n\'existe pas.',
                'content' => ''
            ];
        }
        if (!is_readable($filePath)) {
            return [
                'status' => 'error',
                'msg' => 'Le fichier n\'est pas lisible.',
                'content' => ''
            ];
        }

        return [
            'status' => 'success',
            'msg' => 'Contenu du fichier:',
            'content' => file_get_contents($filePath)
        ];
    } catch (Exception $e) {
        return ['status' => 'error', 'msg' => $e->getMessage()];
    }
}

function writeFileContent($filePath, $content) {
    try {
        if (!is_writable(dirname($filePath))) {
            throw new Exception('Le fichier n\'est pas inscriptible.');
        }
        file_put_contents($filePath, $content);
        return ['status' => 'success', 'msg' => 'Contenu modifié avec succès.'];
    } catch (Exception $e) {
        return ['status' => 'error', 'msg' => $e->getMessage()];
    }
}

function appendFileContent($filePath, $content) {
    try {
        if (!is_writable($filePath)) {
            throw new Exception('Le fichier n\'est pas inscriptible.');
        }
        file_put_contents($filePath, $content, FILE_APPEND);
        return ['status' => 'success', 'msg' => 'Contenu ajouté avec succès.'];
    } catch (Exception $e) {
        return ['status' => 'error', 'msg' => $e->getMessage()];
    }
}

function deleteFile($filePath) {
    try {
        if (!file_exists($filePath)) throw new Exception('Le fichier ou dossier n\'existe pas.');

        if (is_file($filePath)) {
            if (!unlink($filePath)) throw new Exception('Erreur lors de la suppression du fichier.');
            return ['status' => 'success', 'msg' => 'Fichier supprimé avec succès.'];
        }

        if (is_dir($filePath)) {
            $files = array_diff(scandir($filePath), ['.', '..']);
            foreach ($files as $file) {
                $result = deleteFile($filePath . DIRECTORY_SEPARATOR . $file);
                if ($result['status'] === 'error') return $result;
            }
            if (!rmdir($filePath)) throw new Exception('Erreur lors de la suppression du dossier.');
            return ['status' => 'success', 'msg' => 'Dossier supprimé avec succès.'];
        }

        throw new Exception('Type de fichier non pris en charge.');
    } catch (Exception $e) {
        return ['status' => 'error', 'msg' => $e->getMessage()];
    }
}

function renameFile($oldName, $newName) {
    try {
        if (!file_exists($oldName)) throw new Exception('Le fichier n\'existe pas.');
        if (!rename($oldName, $newName)) throw new Exception('Erreur lors du renommage du fichier.');
        return ['status' => 'success', 'msg' => 'Fichier renommé avec succès.'];
    } catch (Exception $e) {
        return ['status' => 'error', 'msg' => $e->getMessage()];
    }
}

function createDirectory($dirPath) {
    try {
        if (file_exists($dirPath)) throw new Exception('Le dossier existe déjà.');
        if (!mkdir($dirPath)) throw new Exception('Erreur lors de la création du répertoire.');
        return ['status' => 'success', 'msg' => 'Répertoire créé avec succès.'];
    } catch (Exception $e) {
        return ['status' => 'error', 'msg' => $e->getMessage()];
    }
}

function copyFile($source, $destination) {
    try {
        if (!file_exists($source)) throw new Exception('Le fichier source n\'existe pas.');
        if (!copy($source, $destination)) throw new Exception('Erreur lors de la copie du fichier.');
        return ['status' => 'success', 'msg' => 'Fichier copié avec succès.'];
    } catch (Exception $e) {
        return ['status' => 'error', 'msg' => $e->getMessage()];
    }
}

function moveFile($source, $destination) {
    try {
        if (!file_exists($source)) throw new Exception('Le fichier source n\'existe pas.');
        if (!rename($source, $destination)) throw new Exception('Erreur lors du déplacement du fichier.');
        return ['status' => 'success', 'msg' => 'Fichier déplacé avec succès.'];
    } catch (Exception $e) {
        return ['status' => 'error', 'msg' => $e->getMessage()];
    }
}
