<?php

namespace CodeFinances\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use CodeFinances\Repositories\ClientRepository;
use CodeFinances\Models\Client;
use CodeFinances\Validators\ClientValidator;

/**
 * Class ClientRepositoryEloquent.
 *
 * @package namespace CodeFinances\Repositories;
 */
class ClientRepositoryEloquent extends BaseRepository implements ClientRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Client::class;
    }

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
