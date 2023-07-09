<?php

class Worker
{
    private string $name;

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function __construct(string $name)
    {
        $this->name = $name;
    }

    public static function make($args): Worker
    {
        return new self($args['name']);
    }
}

class WorkerMapper
{
    private WorkerStorageAdapter $adapter;

    /**
     * @param WorkerStorageAdapter $adapter
     */
    public function __construct(WorkerStorageAdapter $adapter)
    {
        $this->adapter = $adapter;
    }

    public function findById($id): Worker|string
    {
        $res = $this->adapter->find($id);

        if ($res === null) {
            return 'Worker with this id doesnt exists';
        }

        return $this->make($res);
    }

    private function make($args): Worker
    {
        return Worker::make($args);
    }
}

class WorkerStorageAdapter
{
    private array $data = [];

    /**
     * @param array $data
     */
    public function __construct(array $data)
    {
        $this->data = $data;
    }

    public function find($id)
    {
        if (isset($this->data[$id])) {
            return $this->data[$id];
        }

        return null;
    }
}

$data = [
    1 => [
        'name' => 'Boris',
    ],
];

$workerStorageAdapter = new WorkerStorageAdapter($data);

$workerMapper = new WorkerMapper($workerStorageAdapter);

$worker = $workerMapper->findById(1);

var_dump($worker->getName());
