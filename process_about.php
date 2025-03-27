<?php
require_once __DIR__ . "/config.php";

class AboutController {
    private $conn;

    public function __construct() {
        global $pdo;
        $this->conn = $pdo; 
    }

    public function showAboutPage() {
        require_once __DIR__ . "/about.php";
    }

    public function getAllContents() {
        header("Content-Type: application/json");
        try {
            $stmt = $this->conn->prepare("SELECT * FROM about_us");
            $stmt->execute();
            $content = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
            echo json_encode(["success" => true, "content" => $content]);
        } catch (PODException $e) {
            echo $e->getMessage();
        }
    }

    public function insertContent() {
        header("Content-Type: application/json");

        $input = json_decode(file_get_contents("php://input"), true);

        $title = $input["title"] ?? '';
        $content = $input["content"] ?? '';

        if (empty($title) || empty($content)) return;

        try {
            $stmt = $this->conn->prepare("INSERT INTO about_us (title, content) VALUES (:title, :content)");
            $stmt->execute([":title" => $title, ":content" => $content]);
            echo json_encode(["success" => true]);
        } catch (PDOException $e) {
            echo json_encode(["error" => $e->getMessage()]);
        }
    }

    public function getContent() {
        header("Content-Type: application/json");

        $input = json_decode(file_get_contents("php://input"), true);

        $id = $input["id"];

        try {
            $stmt = $this->conn->prepare("SELECT * FROM about_us WHERE id = :id");
            $stmt->execute([":id" => $id]);

            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            echo json_encode(["success" => true, "row" => $row]);
        } catch (PDOException $e) {
            echo json_encode(["error" => $e->getMessage()]);
        }
    }

    public function updateContent() {
        header("Content-Type: application/json");

        $input = json_decode(file_get_contents("php://input"), true);

        $id = $input["id"];
        $title = $input["title"];
        $content = $input["content"];

        try {
            $stmt = $this->conn->prepare("UPDATE about_us SET title = :title, content = :content WHERE id = :id");
            $stmt->execute([":title" => $title, ":content" => $content, ":id" => $id]);
            echo json_encode(["success" => true]);
        } catch (PDOException $e) {
            echo json_decode(["error" => $e->getMessage()]);
        }
    }

    public function deleteContent() {
        header("Content-Type: application/json");

        $input = json_decode(file_get_contents("php://input"), true);

        $id = $input["id"];

        try {
            $stmt = $this->conn->prepare("DELETE FROM about_us WHERE id = :id");
            $stmt->execute([":id" => $id]);
            echo json_encode(["success" => true]);
        } catch (PDOException $e) {
            echo json_decode(["error" => $e->getMessage()]);
        }
    }
}
?>