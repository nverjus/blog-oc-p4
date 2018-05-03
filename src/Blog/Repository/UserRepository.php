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

    public function findByEmail($email)
    {
        if (!is_string($email)) {
            throw new \InvalidArgumentException("Email must be a string");
        }

        $req = $this->db->prepare('SELECT * FROM User WHERE email = :email');
        $req->bindValue(':email', $email, \PDO::PARAM_STR);
        $req->execute();

        if ($data = $req->fetch()) {
            return new User($data);
        }

        return null;
    }

    public function findValidated()
    {
        $users = [];

        $req = $this->db->prepare('SELECT * FROM User WHERE isValidated = 1');
        $req->execute();

        while ($data = $req->fetch()) {
            $users[] = new User($data);
        }

        return $users;
    }

    public function findNotValidated()
    {
        $users = [];

        $req = $this->db->prepare('SELECT * FROM User WHERE isValidated = 0');
        $req->execute();

        while ($data = $req->fetch()) {
            $users[] = new User($data);
        }
        return $users;
    }

    public function save(User $user)
    {
        if ($user->isNew()) {
            $this->add($user);
        } elseif (!$user->isNew()) {
            $this->edit($user);
        }
    }

    private function add(User $user)
    {
        $req = $this->db->prepare('INSERT INTO User SET name = :name, email = :email, password = :password');
        $req->bindValue(':name', $user->getName(), \PDO::PARAM_STR);
        $req->bindValue(':email', $user->getEmail(), \PDO::PARAM_STR);
        $req->bindValue(':password', $user->getPassword(), \PDO::PARAM_STR);
        $req->execute();
    }

    private function edit(User $user)
    {
        $req = $this->db->prepare('UPDATE User SET name = :name, email = :email, password = :password');
        $req->bindValue(':name', $user->getName(), \PDO::PARAM_STR);
        $req->bindValue(':email', $user->getEmail(), \PDO::PARAM_STR);
        $req->bindValue(':password', $user->getPassword(), \PDO::PARAM_STR);
        $req->execute();
    }

    public function delete(User $user)
    {
        $req = $this->db->prepare('DELETE FROM User WHERE id = :id');
        $req->bindValue(':id', $user->getId());
        $req->execute();
    }

    public function validate(User $user)
    {
        $req = $this->db->prepare('UPDATE User SET isValidated = 1 WHERE id = :id');
        $req->bindValue(':id', $user->getId(), \PDO::PARAM_INT);

        $req->execute();
    }
}
