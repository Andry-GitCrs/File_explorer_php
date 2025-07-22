<?php 

//---------- Manipulation des fichiers

// Créer un fichier
function createFile($filePath) {
    if (!file_exists($filePath)) { // Vérifie si le fichier n'existe pas
        $file = fopen($filePath, 'w'); // Ouvre le fichier en mode écriture pour le créer
        if ($file) {
            fclose($file); // Ferme le fichier après l'avoir créé
            return [
                'status' => 'success',
                'msg' => 'Fichier créé avec succès.'
            ];
        }
        return [
            'status' => 'error',
            'msg' => 'Erreur lors de la creation du fichier'
        ]; // Retourne un message si la création échoue
    }
    return [
        'status' => 'error',
        'msg' => 'Le fichier existe déjà.'
    ]; // Retourne un message si le fichier existe déjà
}

// Fonction pour lire le contenu d'un fichier
function readFileContent($filePath) { 
    if (file_exists($filePath)) { // Vérifie si le fichier existe
        if (!is_readable($filePath)) { // Vérifie si le fichier est lisible
            return [
                'status' => 'error',
                'msg' => 'Le fichier n\'est pas lisible.'
            ];
        }
        return [
            'status' => 'success',
            'content' => file_get_contents($filePath) // Lit le contenu du fichier
        ]; // Lit le contenu du fichier et le retourne
    }
    return [
        'status' => 'error',
        'msg' => 'Le fichier n\'existe pas.'
    ]; // Retourne un message si le fichier n'existe pas
}

// Fonction pour écrire du contenu dans un fichier
function writeFileContent($filePath, $content) { // Fonction pour écrire du contenu dans un fichier
    if (is_writable(dirname($filePath))) { // Vérifie si le répertoire du fichier est inscriptible
        file_put_contents($filePath, $content); // Écrit le contenu dans le fichier
        return [
            'status' => 'success',
            'msg' => 'Contenu modifié avec succès.'
        ];
    }
    return [
        'status' => 'error',
        'msg' => 'Le fichier n\'est pas inscriptible.'
    ]; // Retourne un message si le fichier n'est pas inscriptible
}

// Ajouter du contenu dans un fichier
function appendFileContent($filePath, $content) {
    if (is_writable($filePath)) { // Vérifie si le fichier est inscriptible
        file_put_contents($filePath, $content, FILE_APPEND); // Ajoute le contenu à la fin du fichier
        return [
            'status' => 'success',
            'msg' => 'Contenu ajouté avec succès.'
        ];
    }
    return [
        'status' => 'error',
        'msg' => 'Le fichier n\'est pas inscriptible.'
    ]; // Retourne un message si le fichier n'est pas inscriptible
}

// Fonction pour supprimer un fichier
function deleteFile($filePath) {
    if (file_exists($filePath)) { // Vérifie si le fichier existe
        if (unlink($filePath)) { // Supprime le fichier
            return [
                'status' => 'success',
                'msg' => 'Fichier supprimé avec succès.'
            ];
        }
        return [
            'status' => 'error',
            'msg' => 'Erreur lors de la suppression du fichier.'
        ]; // Retourne un message si la suppression échoue
    }else if(is_dir($filePath)) {
        if(rmdir($filePath)){
            return [
                'status' => 'success',
                'msg' => 'Dossier supprimé avec succès.'
            ];
        }
        return [
            'status' => 'error',
            'msg' => 'Erreur lors de la suppression du dossier'
        ];        
    }
    return [
        'status' => 'error',
        'msg' => 'Le fichier n\'existe pas.'
    ]; // Retourne un message si le fichier n'existe pas
}

// Fonction pour renommer un fichier
function renameFile($oldName, $newName) {
    if (file_exists($oldName)) { // Vérifie si le fichier existe
        if (rename($oldName, $newName)) { // Renomme le fichier
            return [
                'status' => 'success',
                'msg' => 'Fichier renomé avec succès'
            ]; // Retourne le nouveau nom du fichier
        }
        return [
            'status' => 'error',
            'msg' => 'Erreur lors du renommage du fichier.'
        ]; // Retourne un message si le renommage échoue
    }
    return [
        'status' => 'error',
        'msg' => 'Le fichier n\'existe pas.'
    ]; // Retourne un message si le fichier n'existe pas
}

// Fonction pour créer un répertoire
function createDirectory($dirPath) {
    if (!file_exists($dirPath)) { // Vérifie si le répertoire n'existe pas
        if (mkdir($dirPath)) { // Créer le répertoire
            return [
                'status' => 'success',
                'msg' => 'Répertoire créé avec succès.'
            ];
        }
        return [
            'status' => 'error',
            'msg' => 'Erreur lors de la création du répertoire.'
        ]; // Retourne un message si la création du répertoire échoue
    }
    return [
        'status' => 'error',
        'msg' => 'Le dossier existe deja.'
    ]; // Retourne un message si le répertoire existe deja
}

// Fonction pour copier un fichier
function copyFile($source, $destination) {
    if (file_exists($source)) { // Vérifie si le fichier source existe
        if (copy($source, $destination)) { // Copie le fichier vers la destination
            return [
                'status' => 'success',
                'msg' => 'Fichier copié avec succès.'
            ];
        }
        return [
            'status' => 'error',
            'msg' => 'Erreur lors de la copie du fichier.'
        ]; // Retourne un message si la copie échoue
    }
    return [
        'status' => 'error',
        'msg' => 'Le fichier source n\'existe pas.'
    ]; // Retourne un message si le fichier source n'existe pas
}

// Fonction pour déplacer un fichier
function moveFile($source, $destination) {
    if (file_exists($source)) { // Vérifie si le fichier source existe
        if (rename($source, $destination)) { // Déplace le fichier vers la destination
            return [
                'status' => 'success',
                'msg' => 'Fichier déplacé avec succès.'
            ];
        }
        return [
            'status' => 'error',
            'msg' => 'Erreur lors du déplacement du fichier.'
        ]; // Retourne un message si le déplacement échoue
    }
    return [
        'status' => 'error',
        'msg' => 'Le fichier source n\'existe pas.'
    ]; // Retourne un message si le fichier source n'existe pas
}