<?php

// Вызвает реализацию родителя при условии

interface Worker
{
    public function addClosedHours(int $hours): void;
    public function countSalary(): float;
}

class WorkerOutsource implements Worker
{
    private array $hours = [];

    public function addClosedHours(int $hours): void
    {
        $this->hours[] = $hours;
    }

    public function countSalary(): float
    {
        return array_sum($this->hours) * 500;
    }
}

class WorkerProxy extends WorkerOutsource implements Worker
{
    private float $salary = 0;

    public function countSalary(): float
    {
        if ($this->salary === 0.0) {
            $this->salary = parent::countSalary();
        }

        return $this->salary;
    }
}

$workerProxy = new WorkerProxy();

$workerProxy->addClosedHours(10);
$workerProxy->countSalary();
$workerProxy->addClosedHours(10);
$workerProxy->addClosedHours(10);
$workerProxy->countSalary();

var_dump($workerProxy->countSalary());