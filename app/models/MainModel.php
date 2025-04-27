<?php
class MainModel extends Model {
    public function getImages() {
        $sql = "SELECT * FROM images";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        $images = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $images;
    }
}