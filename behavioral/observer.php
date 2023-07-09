<?php

// Слежение за состонием объекта и сохранением промежуточных состояний

class Worker implements SplSubject
{
    private SplObjectStorage $observers;

    private string $name = '';

    public function __construct()
    {
        $this->observers = new SplObjectStorage();
    }

    public function attach(SplObserver $observer): void
    {
        $this->observers->attach($observer);
    }

    public function detach(SplObserver $observer): void
    {
        $this->observers->detach($observer);
    }

    public function changeName($name)
    {
        $this->name = $name;
        $this->notify();
    }

    public function notify(): void
    {
        foreach ($this->observers as $observer) {
            $observer->update($this);
        }
    }
}

class WorkerObserver implements SplObserver
{
    private array $workers = [];

    public function update(SplSubject $subject): void
    {
        $this->workers[] = clone $subject;
    }

    /**
     * @return array
     */
    public function getWorkers(): array
    {
        return $this->workers;
    }
}

$observer = new WorkerObserver();

$worker = new Worker();

$worker->attach($observer);

$worker->changeName('Boris');
$worker->changeName('Bob');
$worker->changeName('Kate');

var_dump(count($observer->getWorkers()));
