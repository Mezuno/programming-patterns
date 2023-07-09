<?php

// Наследники переписывают шаблонный метод, который вызывается только в каком-то методе родителя

abstract class Task
{
    public function printSections()
    {
        $this->printHeader();
        $this->printBody();
        $this->printFooter();
        $this->printCustom();
    }

    private function printHeader(): void
    {
        printf('Header' . PHP_EOL);
    }

    private function printBody(): void
    {
        printf('Body' . PHP_EOL);
    }

    private function printFooter(): void
    {
        printf('Footer' . PHP_EOL);
    }

    abstract protected function printCustom();
}

class DeveloperTask extends Task
{
    protected function printCustom()
    {
        printf('for developer' . PHP_EOL);
    }
}

class DesignerTask extends Task
{
    protected function printCustom()
    {
        printf('for designer' . PHP_EOL);
    }
}

$developerTask = new DeveloperTask();
$designerTask = new DesignerTask();

$developerTask->printSections();
$designerTask->printSections();
