<?php

namespace Erichard\ElasticQueryBuilder\Filter;

use Erichard\ElasticQueryBuilder\QueryException;

class MatchFilter extends Filter
{
    protected $field;
    protected $query;
    protected $analyzer;
    protected $fuzziness;

    public function setField(string $field)
    {
        $this->field = $field;

        return $this;
    }

    public function setQuery(string $query)
    {
        $this->query = $query;

        return $this;
    }

    public function setAnalyzer($analyzer)
    {
        $this->analyzer = $analyzer;

        return $this;
    }

    public function setFuzziness(string $fuzziness)
    {
        $this->fuzziness = $fuzziness;

        return $this;
    }

    public function build(): array
    {
        if (null === $this->query) {
            throw new QueryException('You need to call setQuery() on'.__CLASS__);
        }

        $query = [
            'match' => [
                $this->field => [
                    'query' => $this->query,
                ],
            ],
        ];

        if (null !== $this->analyzer) {
            $query['match'][$this->field]['analyzer'] = $this->analyzer;
        }

        if (null !== $this->fuzziness) {
            $query['match'][$this->field]['fuzziness'] = $this->fuzziness;
        }

        return $query;
    }
}
