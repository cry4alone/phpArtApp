<?php
class MainModel extends Model {
    public function getImages($createdBy, $date, $search, $page, $perPage) {
        $baseSql = "FROM images
                    LEFT JOIN \"User\" as u ON images.user_id = u.id
                    WHERE 1=1";
        $params = [];
    
        if ($createdBy) {
            $baseSql .= " AND login = :createdBy";
            $params["createdBy"] = $createdBy;
        }
        if ($date) {
            $baseSql .= " AND DATE(created_at) = :date";
            $params["date"] = $date;
        }
        if ($search) {
            $baseSql .= " AND (title ILIKE :search OR description ILIKE :search)";
            $params["search"] = "%" . $search . "%";
        }

        $countSql = "SELECT COUNT(*) " . $baseSql;
        $countStmt = $this->db->prepare($countSql);
        $countStmt->execute($params);
        $totalItems = (int) $countStmt->fetchColumn();

        $dataSql = "SELECT images.*, u.login " . $baseSql .
                   " ORDER BY images.created_at DESC LIMIT :limit OFFSET :offset";
    
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
    }
}