<?php
namespace Blog\Entity;

use NV\MiniFram\Entity;

class Post extends Entity
{
    protected $title;
    protected $intro;
    protected $content;
    protected $updateDate;

    public function getTitle()
    {
        return $this->title;
    }

    public function setTitle($title)
    {
        if (is_string($title)) {
            $this->title = $title;
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
        }
    }

    public function getUpdateDate()
    {
        return $this->updateDate;
    }

    public function setUpdateDate($updateDate)
    {
        $this->updateDate = new \DateTime($updateDate);
    }
}
