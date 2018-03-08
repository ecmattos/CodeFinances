<?php

namespace CodeFinances\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use CodeFinances\Repositories\BillPayRepository;
use CodeFinances\Models\BillPay;
use CodeFinances\Validators\BillPayValidator;
use CodeFinances\Presenters\BillPayPresenter;

/**
 * Class BillPayRepositoryEloquent.
 *
 * @package namespace CodeFinances\Repositories;
 */
class BillPayRepositoryEloquent extends BaseRepository implements BillPayRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return BillPay::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    public function presenter()
    {
        return BillPayPresenter::class;
    }
    
}
