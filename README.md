# PHP File Explorer

A simple, web-based file explorer built with PHP and vanilla JavaScript. It provides a user-friendly interface to manage files and directories on a web server.

## Features

- **File and Directory Listing:** Browse files and directories in a structured manner.
- **File Operations:**
    - Create new files and directories.
    - Read and edit text-based files.
    - Rename, copy, move, and delete files and directories.
- **Navigation:**
    - Breadcrumb navigation to easily track your location.
    - Clickable folders to navigate the directory tree.
- **User Interface:**
    - A clean and intuitive interface built with Bootstrap.
    - A modal-based text editor for file content.
    - Context menu (right-click) for quick access to file operations.

## Requirements

- A web server with PHP support (e.g., Apache, Nginx).
- The `data` directory in the project root must be writable by the web server user.

## Installation

1.  Clone or download the project files to your web server's document root.
2.  Make sure the `data` directory is writable. You might need to set the appropriate permissions (e.g., `chmod -R 775 data` and set the owner to the web server user).
3.  Open your web browser and navigate to the `index.html` file (e.g., `http://localhost/File_explorer/`).

## API Endpoints

The application uses a simple API located in `api.php`. All actions are controlled via the `action` URL parameter.

- `GET /api.php?action=ls&path=<path>`: List the contents of a directory.
- `GET /api.php?action=read&path=<path>`: Read the content of a file.
- `POST /api.php?action=write&path=<path>`: Write content to a file. The content should be in the request body.
- `GET /api.php?action=createFile&path=<path>`: Create a new empty file.
- `GET /api.php?action=createDir&path=<path>`: Create a new directory.
- `GET /api.php?action=delete&path=<path>`: Delete a file or directory.
- `GET /api.php?action=rename&path=<path>&target=<newpath>`: Rename a file or directory.
- `GET /api.php?action=copy&path=<path>&target=<destination>`: Copy a file.
- `GET /api.php?action=move&path=<path>&target=<destination>`: Move a file or directory.
