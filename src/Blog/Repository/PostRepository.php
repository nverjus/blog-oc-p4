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

    public function save(Post $post)
    {
        if ($post->isNew()) {
            $this->add($post);
        } elseif (!$post->isNew()) {
            $this->edit($post);
        }
    }

    private function add($post)
    {
        $req = $this->db->prepare('INSERT INTO Post SET title = :title, intro = :intro, content = :content, updateDate = NOW(), userId = :userId');
        $req->bindValue(':title', $post->getTitle(), \PDO::PARAM_STR);
        $req->bindValue(':intro', $post->getIntro(), \PDO::PARAM_STR);
        $req->bindValue(':content', $post->getContent(), \PDO::PARAM_STR);
        $req->bindValue(':userId', $post->getUserId(), \PDO::PARAM_INT);
        $req->execute();
    }

    private function edit($post)
    {
        $req = $this->db->prepare('UPDATE Post SET title = :title, intro = :intro, content = :content, updateDate = NOW()');
        $req->bindValue(':title', $post->getTitle(), \PDO::PARAM_STR);
        $req->bindValue(':intro', $post->getIntro(), \PDO::PARAM_STR);
        $req->bindValue(':content', $post->getContent(), \PDO::PARAM_STR);
        $req->execute();
    }
}
