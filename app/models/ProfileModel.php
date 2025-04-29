<?php

class ProfileModel extends Model {
    
    public function addImage(string $filename, string $title, string $description, int $userId): bool {
        try {
            $sql = "INSERT INTO images (filename, user_id, title, description) 
                    VALUES (:filename, :user_id, :title, :description)";
            $stmt = $this->db->prepare($sql);

            return $stmt->execute([
                "filename" => $filename,
                "user_id" => $userId,
                "title" => $title,
                "description" => $description
            ]);
        } catch (PDOException $e) {
            error_log("Ошибка при добавлении изображения: " . $e->getMessage());
            return false;
        }
    }

    public function getUserImages(int $userId): array {
        try {
            $sql = "SELECT * FROM images WHERE user_id = :user_id";
            $stmt = $this->db->prepare($sql);
            $stmt->execute(['user_id' => $userId]);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Ошибка при получении изображений: " . $e->getMessage());
            return [];
        }
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
            error_log("Ошибка при редактировании поста: " . $e->getMessage());
            return false;
        }
    }
}