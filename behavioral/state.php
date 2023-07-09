<?php

// Переключение состояний

interface State
{
    public function toNext(Task $task);

    public function getStatus();
}

class Task
{
    private State $state;

    /**
     * @return State
     */
    public function getState(): State
    {
        return $this->state;
    }

    /**
     * @param State $state
     */
    public function setState(State $state): void
    {
        $this->state = $state;
    }

    public static function make(): Task
    {
        $self = new self();
        $self->setState(new Created());
        return $self;
    }

    public function proceedToNext()
    {
        $this->state->toNext($this);
    }
}

class Created implements State
{
    public function toNext(Task $task)
    {
       $task->setState(new Process());
    }

    public function getStatus()
    {
        return 'Created';
    }
}

class Process implements State
{
    public function toNext(Task $task)
    {
        $task->setState(new Test());
    }

    public function getStatus()
    {
        return 'Process';
    }
}

class Test implements State
{
    public function toNext(Task $task)
    {
        $task->setState(new Done());
    }

    public function getStatus()
    {
        return 'Test';
    }
}

class Done implements State
{
    public function toNext(Task $task)
    {}

    public function getStatus()
    {
        return 'Done';
    }
}

$task = Task::make();

var_dump($task->getState()->getStatus());

$task->proceedToNext();

var_dump($task->getState()->getStatus());
