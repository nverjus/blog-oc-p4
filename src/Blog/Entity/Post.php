<?php
namespace Blog\Entity;

use NV\MiniFram\Entity;

class Post extends Entity
{
    protected $title;
    protected $intro;
    protected $content;
    protected $updateDate;
    protected $userId = null;
    protected $user = null;
    protected $comments;

    public function getTitle()
    {
        return $this->title;
    }

    public function setTitle($title)
    {
        if (is_string($title)) {
            $this->title = $title;
            return $this;
        }
    }

    public function getIntro()
    {
        return $this->intro;
    }

    public function setIntro($intro)
    {
        if (is_string($intro)) {
            $this->intro = $intro;
            return $this;
        }
    }

    public function getContent()
    {
        return $this->content;
    }

    public function setContent($content)
    {
        if (is_string($content)) {
            $this->content = $content;
            return $this;
        }
    }

    public function getUpdateDate()
    {
        return $this->updateDate;
    }

    public function setUpdateDate($updateDate)
    {
        $this->updateDate = new \DateTime($updateDate);
        return $this;
    }

    public function getUserId()
    {
        return $this->userId;
    }

    public function setUserId($userId)
    {
        if ((int) $userId > 0) {
            $this->userId = $userId;
            return $this;
        }
    }

    public function getUser()
    {
        return $this->user;
    }

    public function setUser(User $user)
    {
        $this->user = $user;
        return $this;
    }

    public function getComments()
    {
        return $this->comments;
    }

    public function setComments(array $comments)
    {
        if (empty($comments)) {
            $this->comments = null;
            return $this;
        }
        $this->comments = $comments;
        return $this;
    }
}
