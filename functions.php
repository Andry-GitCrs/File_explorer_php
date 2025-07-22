<?php 

//---------- Manipulation des fichiers

// Créer un fichier
function createFile($filePath) {
    if (!file_exists($filePath)) { // Vérifie si le fichier n'existe pas
        $file = fopen($filePath, 'w'); // Ouvre le fichier en mode écriture pour le créer
        if ($file) {
            fclose($file); // Ferme le fichier après l'avoir créé
            return "Fichier créé avec succès.";
        }
        return "Erreur lors de la création du fichier."; // Retourne un message si la création échoue
    }
    return "Le fichier existe déjà."; // Retourne un message si le fichier existe déjà
}

// Fonction pour lire le contenu d'un fichier
function readFileContent($filePath) { 
    if (file_exists($filePath)) { // Vérifie si le fichier existe
        if (!is_readable($filePath)) { // Vérifie si le fichier est lisible
            return "Le fichier n'est pas lisible.";
        }
        return file_get_contents($filePath); // Lit le contenu du fichier et le retourne
    }
    return "Le fichier n'existe pas."; // Retourne un message si le fichier n'existe pas
}

// Fonction pour écrire du contenu dans un fichier
function writeFileContent($filePath, $content) { // Fonction pour écrire du contenu dans un fichier
    if (is_writable(dirname($filePath))) { // Vérifie si le répertoire du fichier est inscriptible
        file_put_contents($filePath, $content); // Écrit le contenu dans le fichier
        return "Contenu écrit avec succès.";
    }
    return "Le fichier n'est pas inscriptible."; // Retourne un message si le fichier n'est pas inscriptible
}

// Ajouter du contenu dans un fichier
function appendFileContent($filePath, $content) {
    if (is_writable($filePath)) { // Vérifie si le fichier est inscriptible
        file_put_contents($filePath, $content, FILE_APPEND); // Ajoute le contenu à la fin du fichier
        return "Contenu ajouté avec succès.";
    }
    return "Le fichier n'est pas inscriptible."; // Retourne un message si le fichier n'est pas inscriptible
}

// Fonction pour supprimer un fichier
function deleteFile($filePath) {
    if (file_exists($filePath)) { // Vérifie si le fichier existe
        if (unlink($filePath)) { // Supprime le fichier
            return "Fichier supprimé avec succès.";
        }
        return "Erreur lors de la suppression du fichier."; // Retourne un message si la suppression échoue
    }
    return "Le fichier n'existe pas."; // Retourne un message si le fichier n'existe pas
}

// Fonction pour renommer un fichier
function renameFile($oldName, $newName) {
    if (file_exists($oldName)) { // Vérifie si le fichier existe
        if (rename($oldName, $newName)) { // Renomme le fichier
            return $newName; // Retourne le nouveau nom du fichier
        }
        return "Erreur lors du renommage du fichier."; // Retourne un message si le renommage échoue
    }
    return "Le fichier n'existe pas."; // Retourne un message si le fichier n'existe pas
}

// Fonction pour créer un répertoire
function createDirectory($dirPath) {
    if (!file_exists($dirPath)) { // Vérifie si le répertoire n'existe pas
        if (mkdir($dirPath)) { // Créer le répertoire
            return "Répertoire créé avec succès.";
        }
        return "Erreur lors de la création du répertoire."; // Retourne un message si la création du répertoire échoue
    }
    return "Le répertoire existe deja."; // Retourne un message si le répertoire existe deja
}

// Fonction pour copier un fichier
function copyFile($source, $destination) {
    if (file_exists($source)) { // Vérifie si le fichier source existe
        if (copy($source, $destination)) { // Copie le fichier vers la destination
            return "Fichier copié avec succès.";
        }
        return "Erreur lors de la copie du fichier."; // Retourne un message si la copie échoue
    }
    return "Le fichier source n'existe pas."; // Retourne un message si le fichier source n'existe pas
}

// Fonction pour déplacer un fichier
function moveFile($source, $destination) {
    if (file_exists($source)) { // Vérifie si le fichier source existe
        if (rename($source, $destination)) { // Déplace le fichier vers la destination
            return "Fichier déplacé avec succès.";
        }
        return "Erreur lors du déplacement du fichier."; // Retourne un message si le déplacement échoue
    }
    return "Le fichier source n'existe pas."; // Retourne un message si le fichier source n'existe pas
}