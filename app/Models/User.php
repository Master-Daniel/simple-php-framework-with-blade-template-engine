<?php
class User
{
    private $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function getUserById($id)
    {
        $stmt = $this->db->prepare("SELECT * FROM tbl_users WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch();
    }
}
