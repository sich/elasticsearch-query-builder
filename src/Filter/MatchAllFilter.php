<?php

namespace Erichard\ElasticQueryBuilder\Filter;

use Erichard\ElasticQueryBuilder\QueryException;
use StdClass;

class MatchAllFilter extends Filter
{
    protected $boost;

    public function setBoost(string $boost)
    {
        $this->boost = $boost;

        return $this;
    }

    public function build(): array
    {
        $query = [
            'match_all' => new StdClass
        ];

        if (null !== $this->boost) {
            $query['match_all']->boost = $this->boost;
        }

        return $query;
    }
}
