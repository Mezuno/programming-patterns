<?php

//

interface Mediator
{
    public function getWorker();
}

abstract class Worker
{
    private string $position;

    /**
     * @param string $position
     */
    public function __construct(string $position)
    {
        $this->position = $position;
    }

    public function sayHello()
    {
        printf('Hello');
    }

    public function work()
    {
        return $this->position . ' is working';
    }
}

class InfoBase
{
    public function printInfo(Worker $worker)
    {
        printf($worker->work());
    }
}

class WorkerInfoBaseMediator implements Mediator
{
    private Worker $worker;
    private InfoBase $base;

    /**
     * @param Worker $worker
     * @param InfoBase $base
     */
    public function __construct(Worker $worker, InfoBase $base)
    {
        $this->worker = $worker;
        $this->base = $base;
    }

    public function getWorker()
    {
        $this->base->printInfo($this->worker);
    }
}

class Developer extends Worker
{

}
class Designer extends Worker
{

}

$developer = new Developer('developer middle');
$designer = new Designer('designer senior');

$infoBase = new InfoBase();

$mediator = new WorkerInfoBaseMediator($developer, $infoBase);
$mediator2 = new WorkerInfoBaseMediator($designer, $infoBase);

$mediator->getWorker();
$mediator2->getWorker();