<?php
class ProfileModel extends Model {
    public function addImage($filename, $title, $description) {
        try {
            $sql = "INSERT INTO images (filename, user_id, title, description) VALUES (:filename, :user_id, :title, :description);";
            $stmt = $this->db->prepare($sql);
            $stmt->execute([
                "filename" => $filename,
                "user_id" => $_SESSION['id'],
                "title" => $title,
                "description" => $description
            ]);

            $_SESSION['success'] = 'Изображение успешно загружено';
        } catch (PDOException $e) {
            $_SESSION['error'] = 'Ошибка при загрузке изображения';
            echo $e->getMessage();
        }
        header("Location: /profile");
    }

    public function getUserImages() {
        $sql = "SELECT * FROM images WHERE user_id = :user_id";
        $stmt = $this->db->prepare($sql);
        $stmt->execute(['user_id' => $_SESSION['id']]);
        $images = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $images;
    }

    public function editPost(string $title, string $description, int $id): bool {
        try {
            $sql = "UPDATE images SET title = :title, description = :description WHERE id = :id";
            $stmt = $this->db->prepare($sql);
            $result = $stmt->execute([
                'title' => $title,
                'description' => $description,
                'id' => $id
            ]);

            return $result && $stmt->rowCount() > 0;
        } catch (PDOException $e) {
            error_log($e->getMessage());
            return false;
        }
    }
}