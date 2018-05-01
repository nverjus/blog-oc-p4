<?php
namespace NV\MiniFram;

abstract class Entity
{
    protected $id;

    use Hydrator;

    public function __construct(array $data)
    {
        if (!empty($data)) {
            $this->hydrate($data);
        }
    }

    public function isNew()
    {
        if (empty($this->id)) {
            return true;
        }
        return false;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        if ((int) $id > 0) {
            $this->id = (int) $id;
        }
    }
}
