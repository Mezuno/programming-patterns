<?php

interface AbstractFactory
{
    public static function makeDeveloperWorker(): DeveloperWorker;
    public static function makeDesignerWorker(): DesignerWorker;
}

class OutsourceWorkerFactory implements AbstractFactory
{
    public static function makeDeveloperWorker(): DeveloperWorker
    {
        return new OutsourceDeveloperWorker();
    }

    public static function makeDesignerWorker(): DesignerWorker
    {
        return new OutsourceDesignerWorker();
    }
}

class NativeWorkerFactory implements AbstractFactory
{
    public static function makeDeveloperWorker(): DeveloperWorker
    {
        return new NativeDeveloperWorker();
    }

    public static function makeDesignerWorker(): DesignerWorker
    {
        return new NativeDesignerWorker();
    }
}

interface Worker
{
    public function work();
}

interface DeveloperWorker extends Worker
{}

interface DesignerWorker extends Worker
{}

class NativeDeveloperWorker implements DeveloperWorker
{
    public function work()
    {
        printf('native hard working');
    }
}

class OutsourceDeveloperWorker implements DeveloperWorker
{
    public function work()
    {
        printf('outsource hard working');
    }
}

class NativeDesignerWorker implements DesignerWorker
{
    public function work()
    {
        printf('native drawing butterflies');
    }
}

class OutsourceDesignerWorker implements DesignerWorker
{
    public function work()
    {
        printf('outsource drawing butterflies');
    }
}

$nativeDeveloper = NativeWorkerFactory::makeDeveloperWorker();
$nativeDesigner = NativeWorkerFactory::makeDesignerWorker();

$outsourceDeveloper = OutsourceWorkerFactory::makeDeveloperWorker();
$outsourceDesigner = OutsourceWorkerFactory::makeDesignerWorker();

$nativeDeveloper->work();
$nativeDesigner->work();

$outsourceDeveloper->work();
$outsourceDesigner->work();

