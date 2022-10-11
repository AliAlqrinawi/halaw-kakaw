<?php

namespace App\Repositories;

use Bosnadev\Repositories\Contracts\RepositoryInterface;
use Bosnadev\Repositories\Eloquent\Repository;
use App\Repositories\Criteria\AppUserCriteria;

class PaymentRepository extends Repository
{

    public function model()
    {
        return 'App\Models\Payment';
    }

}
