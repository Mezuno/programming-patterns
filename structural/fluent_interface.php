<?php

// Chaining implementation

class QueryBuilder
{
    private array $select = [];
    private string $from = '';
    private array $where = [];

    public function select(array $select): self
    {
        $this->select = $select;

        return $this;
    }

    public function from($from): self
    {
        $this->from = $from;

        return $this;
    }

    public function where(string $column, string $operator, mixed $value): self
    {
        if ($operator === 'like') {
            $value = '%' . $value . '%';
        }
        if (is_string($value)) {
            $value = "'" . $value . "'";
        }

        $this->where[] = $column . ' ' . $operator . ' ' . $value ;

        return $this;
    }

    public function get(): string
    {
        return sprintf('SELECT %s FROM %s WHERE %s;',
            join(', ', $this->select),
            $this->from,
            join(' AND ', $this->where),
        );
    }
}

$queryBuilder = new QueryBuilder();

$query = $queryBuilder
            ->select(['id', 'title'])
            ->from('posts')
            ->where('views', '>', 20)
            ->where('title', 'like', 'Заголовок')
            ->get();

var_dump($query);