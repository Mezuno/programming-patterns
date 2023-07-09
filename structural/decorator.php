<?php

// Создаем класс над каким-либо классом для переопределения поведения каких-либо методов

interface Worker
{
    public function countSalary(): float;
}

abstract class WorkerDecorator implements Worker
{
    protected Worker $worker;

    /**
     * @param Worker $worker
     */
    public function __construct(Worker $worker)
    {
        $this->worker = $worker;
    }
}

class Developer implements Worker
{
    public function countSalary(): float
    {
        return 3000 * 20;
    }
}

class DeveloperOverTime extends WorkerDecorator
{
    public function countSalary(): float
    {
        return $this->worker->countSalary() * 1.2;
    }
}

$developer = new Developer();

$developerOverTime = new DeveloperOverTime($developer);

var_dump($developer->countSalary());
var_dump($developerOverTime->countSalary());
