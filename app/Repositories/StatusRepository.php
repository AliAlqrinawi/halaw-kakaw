<?php

namespace App\Repositories;

use Bosnadev\Repositories\Contracts\RepositoryInterface;
use Bosnadev\Repositories\Eloquent\Repository;

use DB;
class StatusRepository extends Repository
{

    public function model()
    {
        return 'App\Models\Status';
    }
}
