<?php

namespace CodeFinances\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use CodeFinances\Repositories\CategoryExpenseRepository;
use CodeFinances\Models\CategoryExpense;
use CodeFinances\Validators\CategoryExpensesValidator;
use CodeFinances\Presenters\CategoryPresenter;

/**
 * Class CategoryExpenseRepositoryEloquent.
 *
 * @package namespace CodeFinances\Repositories;
 */
class CategoryExpenseRepositoryEloquent extends BaseRepository implements CategoryExpenseRepository
{
    use CategoryRepositoryTrait;
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return CategoryExpense::class;
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
