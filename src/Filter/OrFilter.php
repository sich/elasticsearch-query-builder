<?php

namespace Erichard\ElasticQueryBuilder\Filter;

use Erichard\ElasticQueryBuilder\QueryException;

class OrFilter extends Filter
{
    private $filter = [];

     public function addFilter(Filter $filter)
    {
        $this->filter[] = $filter;

        return $this;
    }

    public function isEmpty()
    {
        return empty($this->filter);
    }

    public function build(): array
    {
        if (empty($filter)) {
            throw new QueryException('Empty filter');
        }

        $filter = [];

        foreach ($this->filter as $f) {
            $filter[] = $f->build();
        }

        return [
            'or' => $filter,
        ];
    }
}
