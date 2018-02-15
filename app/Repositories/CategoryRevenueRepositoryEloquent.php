<?php

namespace CodeFinances\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use CodeFinances\Repositories\CategoryRevenueRepository;
use CodeFinances\Models\CategoryRevenue;
use CodeFinances\Validators\CategoryRevenuesValidator;
use CodeFinances\Presenters\CategoryPresenter;

/**
 * Class CategoryRevenueRepositoryEloquent.
 *
 * @package namespace CodeFinances\Repositories;
 */
class CategoryRevenueRepositoryEloquent extends BaseRepository implements CategoryRevenueRepository
{
    
    use CategoryRepositoryTrait;

    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return CategoryRevenue::class;
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
        return CategoryPresenter::class;
    }
}
