<?php
require_once __DIR__ . "/process_about.php";

$aboutController = new AboutController();

$request = $_SERVER["REQUEST_URI"];

switch ($request) {
    case "":
    case "/":
    case "/home":
        echo "Welcome home";
        break;
    case "/about":
        $aboutController->showAboutPage();
        break;
    case "/about/contents":
        $aboutController->getAllContents();
        break;
    case "/about/contents/add":
        $aboutController->insertContent();
        break;
    case "/about/contents/get":
        $aboutController->getContent();
        break;
    case "/about/contents/update":
        $aboutController->updateContent();
        break;
    
    case "/about/contents/delete":
        $aboutController->deleteContent();
        break;
    
    default:
        echo "404";
        break;
}

?>