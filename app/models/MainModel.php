<?php
class MainModel extends Model {
    public function getImages($createdBy, $date, $search) {
        $sql = "SELECT images.*, u.login
                FROM images
                LEFT JOIN \"User\" as u ON images.user_id = u.id
                WHERE 1=1";
        $params = [];

        if ($createdBy) {
            $sql .= " AND login = :createdBy";
            $params["createdBy"] = $createdBy;
        }
        if ($date) {
            $sql .= " AND DATE(created_at) = :date";
            $params["date"] = $date;
        }
        if ($search) {
            $sql .= " AND (title ILIKE :search OR description ILIKE :search)";
            $params["search"] = "%" . $search . "%";
        }

        $stmt = $this->db->prepare($sql);
        $stmt->execute($params);
        $images = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $images;
    }
}