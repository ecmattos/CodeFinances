<?php

namespace CodeFinances\Http\Controllers\Api;

use CodeFinances\Http\Controllers\Controller;
use CodeFinances\Http\Controllers\Response;
use CodeFinances\Http\Requests\BillPayRequest;
use CodeFinances\Repositories\BillPayRepository;
/**
 * Class BillPaysController.
 *
 * @package namespace CodeFinances\Http\Controllers;
 */
class BillPaysController extends Controller
{
    /**
     * @var BillPayRepository
     */
    protected $repository;


    /**
     * BillPaysController constructor.
     *
     * @param BillPayRepository $repository
     */
    public function __construct(BillPayRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $BillPays = $this->repository->paginate(3);

        #dd($BillPay);

        return $BillPays;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  BillPayRequest $request
     *
     * @return \Illuminate\Http\Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function store(BillPayRequest $request)
    {
        $BillPay = $this->repository->create($request->all());

        return response()->json($BillPay, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $BillPay = $this->repository->find($id);
        
        return response()->json($BillPay);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  BillPayRequest $request
     * @param  string            $id
     *
     * @return Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function update(BillPayRequest $request, $id)
    {
        $BillPay = $this->repository->update($request->all(), $id);

        return response()->json($BillPay);
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->repository->delete($id);

        return response()->json([], 204);
    }
}
