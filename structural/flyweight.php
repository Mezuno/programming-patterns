<?php

// Разгрузить использование памяти, создание объектов в $pool только при их отсутствии

interface Mail
{
    public function render(): string;
}

abstract class TypeMail
{
    private string $text;

    /**
     * @param string $text
     */
    public function __construct(string $text)
    {
        $this->text = $text;
    }

    /**
     * @return string
     */
    public function getText(): string
    {
        return $this->text;
    }
}

class BusinessMail extends TypeMail implements Mail
{
    public function render(): string
    {
        return $this->getText() . ' from business mail';
    }
}

class JobMail extends TypeMail implements Mail
{
    public function render(): string
    {
        return $this->getText() . ' from job mail';
    }
}

class UndefinedMail extends TypeMail implements Mail
{
    public function render(): string
    {
        return $this->getText() . ' from undefined type of mail';
    }
}

class MailFactory
{
    private array $pool = [];

    public function getMail(int $id, string $typeMail): Mail
    {
        // Создаем объект в $pool только при его отсутствии

        if (!isset($this->pool[$id])) {
            $this->pool[$id] = $this->make($typeMail);
        }

        return $this->pool[$id];
    }

    private function make(string $typeMail): Mail
    {
        $ClassName = strtoupper($typeMail);

        if (class_exists($ClassName)) {
            return new $ClassName('some text');
        }

        return new UndefinedMail('some text');
    }
}

$mailFactory = new MailFactory();

// Не находит письмо, создает новое и возвращает
$mail = $mailFactory->getMail(10, 'business');
// Находит письмо, возвращает
$mail2 = $mailFactory->getMail(10, 'business');

// На выходе в MailFactory лежит одно письмо

var_dump($mail->render());
var_dump($mail2->render());
