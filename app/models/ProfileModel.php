<?php

class ProfileModel extends Model
{

    public function addImage(string $filename, string $title, string $description, int $userId): bool
    {
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
            echo("Ошибка при добавлении изображения: " . $e->getMessage());
            return false;
        }
    }

    public function getUserImages(int $userId): array
    {
        try {
            $sql = "SELECT * FROM images WHERE user_id = :user_id";
            $stmt = $this->db->prepare($sql);
            $stmt->execute(['user_id' => $userId]);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo("Ошибка при получении изображений: " . $e->getMessage());
            return [];
        }
    }

    public function editPost(string $title, string $description, int $id): bool
    {
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
            echo("Ошибка при редактировании поста: " . $e->getMessage());
            return false;
        }
    }

    public function deletePost(int $id): bool
    {
        try {
            $sql = "DELETE FROM images WHERE id = :id";
            $stmt = $this->db->prepare($sql);

            return $stmt->execute(['id' => $id]);
        } catch (PDOException $e) {
            echo("Ошибка при удалении поста: " . $e->getMessage());
            return false;
        }
    }

    public function changePostVisibility(int $id): bool
    {
        try {
            $sql = "UPDATE images SET is_shared = NOT is_shared WHERE id = :id";
            $stmt = $this->db->prepare($sql);

            return $stmt->execute(['id' => $id]);
        } catch (PDOException $e) {
            echo("Ошибка при изменении видимости поста: " . $e->getMessage());
            return false;
        }
    }

    public function getImageNameAndOwner(int $id): array{
        try {
            $sql = "SELECT filename, user_id FROM images WHERE id = :id";
            $stmt = $this->db->prepare($sql);
            $stmt->execute(['id' => $id]);
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo("Ошибка при получении имени изображения: " . $e->getMessage());
            return [];
        }
    }
}