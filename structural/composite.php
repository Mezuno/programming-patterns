<?php

interface Renderable
{
    public function render(): string;
}

class Mail implements Renderable
{
    private array $parts = [];

    public function render(): string
    {
        $result = '';
        foreach ($this->parts as $part) {
            $result .= $part->render();
        }

        return $result;
    }

    public function addPart(Renderable $part)
    {
        $this->parts[] = $part;
    }
}

abstract class Part implements Renderable
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
        return $this->text . PHP_EOL;
    }
}

class Header extends Part implements Renderable
{
    public function render(): string
    {
        return strtoupper($this->getText());
    }
}

class Body extends Part implements Renderable
{
    public function render(): string
    {
        return 'BODY: ' . $this->getText();
    }
}

class Footer extends Part implements Renderable
{
    public function render(): string
    {
        return '2020-' . date('Y') . '. ' . $this->getText();
    }
}

$mail = new Mail();

$mail->addPart(new Header('header'));
$mail->addPart(new Body('some body...'));
$mail->addPart(new Footer('All rights reserved.'));

var_dump($mail->render());