<?php

namespace CodeFinances\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
##use CodeFinances\Repositories\BankAccountRepository;
use CodeFinances\Models\BankAccount;
use CodeFinances\Presenters\BankAccountPresenter;

/**
 * Class BankAccountRepositoryEloquent.
 *
 * @package namespace CodeFinances\Repositories;
 */
class BankAccountRepositoryEloquent extends BaseRepository implements BankAccountRepository
{
    protected $fieldSearchable = [
        'name' => 'like',
        'agency' => 'like',
        'account' => 'like',
        'bank.name' => 'like'
    ]; 

    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return BankAccount::class;
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
        return BankAccountPresenter::class;
    }
    
}
