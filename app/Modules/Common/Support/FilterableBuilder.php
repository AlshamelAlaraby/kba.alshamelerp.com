<?php

namespace App\Modules\Common\Support;

class FilterableBuilder
{
    public function __invoke($builder, $args)
    {
        return $builder->filter($args);
    }
}
