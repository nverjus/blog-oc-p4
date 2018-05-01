<?php
namespace Blog\Repository;

use NV\MiniFram\Repository;
use Blog\Entity\Post;

class PostRepository extends Repository
{
    public function findAll(bool $desc = true)
    {
        $posts = [];

        $sql = "SELECT * FROM Post ORDER BY ID";
        if ($desc) {
            $sql .= " DESC";
        }

        $req = $this->db->query($sql);

        while ($row = $req->fetch()) {
            $posts[] = new Post($row);
        }
        $req->closeCursor();

        return $posts;
    }

    public function findById(int $id)
    {
        if ($id <= 0) {
            throw new \InvalidArgumentException("Id must be greater than zero");
        }

        $req = $this->db->prepare('SELECT * FROM Post WHERE id = :id');
        $req->bindValue(':id', $id, \PDO::PARAM_INT);
        $req->execute();

        if ($data = $req->fetch()) {
            return new Post($data);
        }

        return null;
    }
}
