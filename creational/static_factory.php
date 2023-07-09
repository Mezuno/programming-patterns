<?php

interface Worker
{
    public function work();
}

class Developer implements Worker
{
    public function work()
    {
        printf('hard working');
    }
}

class Designer implements Worker
{
    public function work()
    {
        printf('drawing butterflies');
    }
}

class WorkerFactory
{
    public static function make($workerTitle): ?Worker
    {
        $ClassName = strtoupper($workerTitle);

        if (class_exists($ClassName)) {
            return new $ClassName();
        }

        return null;
    }
}

// 2 options to use it
$developer = WorkerFactory::make(Developer::class);
$designer = WorkerFactory::make('designer');

$developer->work();
$designer->work();