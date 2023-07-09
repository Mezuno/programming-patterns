<?php

final class Connection
{
    private static ?self $instance = null;
    private static string $name;

    public static function getInstance(): self
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    public function __clone()
    {}

    public function __wakeup(): void
    {}

    /**
     * @return string
     */
    public static function getName(): string
    {
        return self::$name;
    }

    /**
     * @param string $name
     */
    public static function setName(string $name): void
    {
        self::$name = $name;
    }
}

$connection = Connection::getInstance();

$connection::setName('db_name');

$connection2 = Connection::getInstance();

// returns 'db_name' string
var_dump($connection2::getName());
