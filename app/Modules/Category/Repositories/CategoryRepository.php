<?php

namespace App\Modules\Category\Repositories;

use App\Modules\Common\Support\BaseRepository;

interface CategoryRepository extends BaseRepository
{
    public function getByCondition($conditions=[]);
}
