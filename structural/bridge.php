<?php

interface Formatter
{
    public function format(string $str): string;
}

class SimpleText implements Formatter
{

    public function format(string $str): string
    {
        return $str;
    }
}

class HTMLText implements Formatter
{

    public function format(string $str): string
    {
        return "<p>$str</p>";
    }
}

abstract class BridgeService
{
    protected Formatter $formatter;

    /**
     * @param Formatter $formatter
     */
    public function __construct(Formatter $formatter)
    {
        $this->formatter = $formatter;
    }

    abstract public function getFormatter(string $str): string;
}

class SimpleTextService extends BridgeService
{
    public function getFormatter(string $str): string
    {
        return $this->formatter->format($str);
    }
}

class HTMLTextService extends BridgeService
{
    public function getFormatter(string $str): string
    {
        return $this->formatter->format($str);
    }
}

$simpleText = new SimpleText();
$htmlText = new HTMLText();

$simpleTextService = new SimpleTextService($simpleText);
$htmlTextService = new HTMLTextService($htmlText);

var_dump($htmlTextService->getFormatter('hello'));