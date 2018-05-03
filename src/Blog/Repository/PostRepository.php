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

    public function findLastX(int $postsPerPage, int $page)
    {
        if ($postsPerPage <= 0) {
            throw new \InvalidArgumentException('The number of Articles must be a positive integer');
        }

        $offset = ($page -1) * $postsPerPage;
        $posts = [];


        $req = $this->db->prepare('SELECT * FROM Post ORDER BY id DESC LIMIT :postsPerPage OFFSET :ofset');
        $req->bindValue(':postsPerPage', $postsPerPage, \PDO::PARAM_INT);
        $req->bindValue(':ofset', $offset, \PDO::PARAM_INT);
        $req->execute();

        while ($row = $req->fetch()) {
            $posts[] = new Post($row);
        }

        return $posts;
    }

    public function getNbPages(int $postsPerPage)
    {
        $sql = 'SELECT COUNT(id) AS nbPosts FROM Post';

        $req = $this->db->query($sql);
        $data = $req->fetch();
        $nbPosts = $data['nbPosts'];

        $nbPages = (int) $nbPosts/$postsPerPage;
        $nbPages = (int) $nbPages;
        if ($nbPosts%$postsPerPage != 0) {
            $nbPages++;
        }

        return $nbPages;
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
        $req = $this->db->prepare('UPDATE Post SET title = :title, intro = :intro, content = :content, updateDate = NOW() WHERE id = :id');
        $req->bindValue(':title', $post->getTitle(), \PDO::PARAM_STR);
        $req->bindValue(':intro', $post->getIntro(), \PDO::PARAM_STR);
        $req->bindValue(':content', $post->getContent(), \PDO::PARAM_STR);
        $req->bindValue(':id', $post->getId(), \PDO::PARAM_INT);

        $req->execute();
    }

    public function delete(Post $post)
    {
        $req = $this->db->prepare('DELETE FROM Post WHERE id = :id');
        $req->bindValue(':id', $post->getId());
        $req->execute();
    }
}
