<?php

namespace CodeFinances\Http\Controllers\Api;

use CodeFinances\Http\Controllers\Controller;
use CodeFinances\Repositories\BankRepository;
use Illuminate\Http\Request;
use CodeFinances\Http\Requests;

class BanksController extends Controller
{
     /**
     * @var BankRepository
     */
    private $repository;

    public function __construct(BankRepository $repository)
    {
         $this->repository = $repository;
    }

    public function index()
    {
        return $this->repository->all();
    }
}