<?php
namespace Blog\Entity;

use NV\MiniFram\Entity;

class Comment extends Entity
{
    protected $author;
    protected $content;
    protected $publicationDate;
    protected $isValidated;
    protected $postId;

    public function getAuthor()
    {
        return $this->author;
    }

    public function setAuthor($author)
    {
        if (is_string($author)) {
            $this->author = $author;
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

    public function getPublicationDate()
    {
        return $this->publicationDate;
    }

    public function setPublicationDate($publicationDate)
    {
        $this->publicationDate = new \DateTime($publicationDate);
        return $this;
    }

    public function getIsValidated()
    {
        return $this->isValidated;
    }

    public function setIsValidated($isValidated)
    {
        if (($isValidated == 0) || $isValidated == false) {
            $this->isValidated = false;
        } elseif (($isValidated == 1) || $isValidated == true) {
            $this->isValidated = true;
        }
        return $this;
    }

    public function getPostId()
    {
        return $this->postId;
    }

    public function setPostId($postId)
    {
        if ((int) $postId > 0) {
            $this->postId = (int) $postId;
            return $this;
        }
    }
}
