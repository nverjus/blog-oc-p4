<?php
namespace Blog\Repository;

use NV\MiniFram\Repository;
use Blog\Entity\Comment;

class CommentRepository extends Repository
{
    public function findAll(bool $desc = true)
    {
        $comments = [];

        $sql = "SELECT * FROM Comment ORDER BY ID";
        if ($desc) {
            $sql .= " DESC";
        }

        $req = $this->db->query($sql);

        while ($data = $req->fetch()) {
            $users[] = new Comment($data);
        }
        $req->closeCursor();

        return $commentts;
    }

    public function findById(int $id)
    {
        if ($id <= 0) {
            throw new \InvalidArgumentException("Id must be greater than zero");
        }

        $req = $this->db->prepare('SELECT * FROM Comment WHERE id = :id');
        $req->bindValue(':id', $id, \PDO::PARAM_INT);
        $req->execute();

        if ($data = $req->fetch()) {
            return new Comment($data);
        }

        return null;
    }

    public function findByPost(int $postId)
    {
        $comments = [];

        if ($postId <= 0) {
            throw new \InvalidArgumentException("postId must be greater than zero");
        }

        $req = $this->db->prepare('SELECT * FROM Comment WHERE postID = :postId');
        $req->bindValue(':postId', $postId, \PDO::PARAM_INT);
        $req->execute();

        while ($data = $req->fetch()) {
            $comments[] = new Comment($data);
        }

        return $comments;
    }

    public function findByPostValidated(int $postId)
    {
        $comments = [];

        if ($postId <= 0) {
            throw new \InvalidArgumentException("postId must be greater than zero");
        }

        $req = $this->db->prepare('SELECT * FROM Comment WHERE postID = :postId AND isValidated = 1');
        $req->bindValue(':postId', $postId, \PDO::PARAM_INT);
        $req->execute();

        while ($data = $req->fetch()) {
            $comments[] = new Comment($data);
        }

        return $comments;
    }

    public function save(Comment $comment)
    {
        if ($comment->isNew()) {
            $this->add($comment);
        } elseif (!$comment->isNew()) {
            $this->edit($comment);
        }
    }

    private function add($comment)
    {
        $req = $this->db->prepare('INSERT INTO Comment SET author = :author, content = :content, publicationDate = NOW(), postId = :postId');
        $req->bindValue(':author', $comment->getAuthor(), \PDO::PARAM_STR);
        $req->bindValue(':content', $comment->getContent(), \PDO::PARAM_STR);
        $req->bindValue(':postId', $comment->getPostId(), \PDO::PARAM_INT);
        $req->execute();
    }

    private function edit($comment)
    {
        $req = $this->db->prepare('UPDATE Comment SET author = :author, content = :content WHERE id = :id');
        $req->bindValue(':author', $comment->getAuthor(), \PDO::PARAM_STR);
        $req->bindValue(':content', $comment->getContent(), \PDO::PARAM_STR);
        $req->bindValue(':id', $comment->getId(), \PDO::PARAM_INT);

        $req->execute();
    }

    public function delete(Comment $comment)
    {
        $req = $this->db->prepare('DELETE FROM Comment WHERE id = :id');
        $req->bindValue(':id', $comment->getId());
        $req->execute();
    }
}
