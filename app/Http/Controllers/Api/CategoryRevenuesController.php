<?php

namespace CodeFinances\Http\Controllers\Api;

use CodeFinances\Criteria\WithDepthCategoriesCriteria;
use CodeFinances\Http\Controllers\Controller;
use CodeFinances\Repositories\CategoryRevenueRepository;

class CategoryRevenuesController extends Controller
{
    use CategoriesControllerTrait;

    protected $repository;

    public function __construct(CategoryRevenueRepository $repository)
    {
        $this->repository = $repository;
        $this->repository->pushCriteria(new WithDepthCategoriesCriteria());
    }
}