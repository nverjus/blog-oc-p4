<?php
namespace NV\MiniFram;

class Manager extends ApplicationComponent
{
    public function getRepository(string $entity)
    {
        $repository = $this->app->getName().'\\Repository\\'.$entity.'Repository';

        if (!class_exists($repository)) {
            throw new \InvalidArgumentException('The required repository does not exists');
        }
        return new $repository($this->app);
    }
}
