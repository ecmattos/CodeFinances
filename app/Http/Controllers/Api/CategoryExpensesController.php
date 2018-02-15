<?php

namespace CodeFinances\Http\Controllers\Api;

use CodeFinances\Criteria\WithDepthCategoriesCriteria;
use CodeFinances\Http\Controllers\Controller;
use CodeFinances\Repositories\CategoryExpenseRepository;

class CategoryExpensesController extends Controller
{
    use CategoriesControllerTrait;

    protected $repository;

    public function __construct(CategoryExpenseRepository $repository)
    {
        $this->repository = $repository;
        $this->repository->pushCriteria(new WithDepthCategoriesCriteria());
    }
}