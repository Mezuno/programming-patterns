<?php


class Worker
{
    private ?string $name;

    /**
     * Worker constructor
     * @param string|null $name
     */
    public function __construct(string $name = null)
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }
}

class WorkerFactory
{
    public static function make(): Worker
    {
        return new Worker();
    }
}

$worker = WorkerFactory::make();
$worker->setName('Mezuno');

var_dump($worker->getName());