<?php
namespace Blog\Repository;

use NV\MiniFram\Repository;
use Blog\Entity\User;

class UserRepository extends Repository
{
    public function findAll(bool $desc = true)
    {
        $users = [];

        $sql = "SELECT * FROM User ORDER BY ID";
        if ($desc) {
            $sql .= " DESC";
        }

        $req = $this->db->query($sql);

        while ($row = $req->fetch()) {
            $users[] = new User($row);
        }
        $req->closeCursor();

        return $users;
    }

    public function findById(int $id)
    {
        if ($id <= 0) {
            throw new \InvalidArgumentException("Id must be greater than zero");
        }

        $req = $this->db->prepare('SELECT * FROM User WHERE id = :id');
        $req->bindValue(':id', $id, \PDO::PARAM_INT);
        $req->execute();

        if ($data = $req->fetch()) {
            return new User($data);
        }

        return null;
    }
}
