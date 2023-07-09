<?php

// Выбор "стратегии" в зависимости от переданного класса

interface Definer
{
    public function define($arg): string;
}

class Data
{
    private Definer $definer;
    private int|string|bool $arg;

    /**
     * @param Definer $definer
     */
    public function __construct(Definer $definer)
    {
        $this->definer = $definer;
    }

    /**
     * @param bool|int|string $arg
     */
    public function setArg(bool|int|string $arg): void
    {
        $this->arg = $arg;
    }

    /**
     * @param Definer $definer
     */
    public function setDefiner(Definer $definer): void
    {
        $this->definer = $definer;
    }

    public function executeStrategy(): string
    {
        return $this->definer->define($this->arg);
    }
}

class IntDefiner implements Definer
{
    public function define($arg): string
    {
        return $arg . ' from int strategy';
    }
}

class StringDefiner implements Definer
{
    public function define($arg): string
    {
        return $arg . ' from string strategy';
    }
}

class BoolDefiner implements Definer
{
    public function define($arg): string
    {
        return $arg . ' from bool strategy';
    }
}

$data = new Data(new StringDefiner());

$data->setArg('some arg for first');

var_dump($data->executeStrategy());