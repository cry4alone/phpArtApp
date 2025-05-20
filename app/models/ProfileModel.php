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

    public function getUserImages(int $userId, $search, $page, $perPage): array
    {
        try {
            $baseSql = "FROM images
                        WHERE user_id = :user_id";
            $params = [];
            $params["user_id"] = $userId;

            if ($search) {
                $baseSql .= " AND (title ILIKE :search OR description ILIKE :search)";
                $params["search"] = "%" . $search . "%";
            }

            $countSql = "SELECT COUNT(*) " . $baseSql;
            $countStmt = $this->db->prepare($countSql);
            $countStmt->execute($params);
            $totalItems = (int) $countStmt->fetchColumn();

            $dataSql = "SELECT * " . $baseSql .
            " ORDER BY created_at DESC LIMIT :limit OFFSET :offset";

            $offset = ($page - 1) * $perPage;
            $params["limit"] = (int) $perPage;
            $params["offset"] = (int) $offset;

            $dataStmt = $this->db->prepare($dataSql);
            $dataStmt->execute($params);
            $images = $dataStmt->fetchAll(PDO::FETCH_ASSOC);

            $lastPage = max(1, (int) ceil($totalItems / $perPage));

            return [
                'images' => $images,
                'lastPage' => $lastPage
            ];

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

    public function addXMLImport(string $email, string $login, string $password, string $admin): bool
    {
        try {
            $sql = "INSERT INTO \"User\" (email, login, password, admin) VALUES (:email, :login, :password, :admin)";
            $stmt = $this->db->prepare($sql);

            return $stmt->execute([
                'email' => $email,
                'login' => $login,
                'password' => $password,
                'admin' => $admin
            ]);
            
        }catch(Exception $e) {
            echo("Ошибка при импорте XML: " . $e->getMessage());
            return false;
        }

    }
}