<?php

namespace CodeFinances\Listeners;

use Prettus\Repository\Events\RepositoryEventBase;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

use CodeFinances\Repositories\BankAccountRepository;

class BankAccountSetDefaultListener
{
    private $repository;

    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(BankAccountRepository $repository)
    {
        $this->repository = $repository;
        $this->repository->skipPresenter(true);
    }

    /**
     * Handle the event.
     *
     * @param  RepositoryEventBase  $event
     * @return void
     */
    public function handle(RepositoryEventBase $event)
    {
        $model = $event->getModel();
        if(!$model->default)
        {
            return;
        }

        //Verifica se existe outra conta padrao ja cadastrada.
        $collection = $this->repository
            ->findByField('default', true)
            ->filter(function($value, $key) use($model){ 
                return $model->id != $value->id; //desconsidera a conta que esta sendo criada/alterada
            });

        $bankAccountDefault = $collection->first(); 
        
        if($bankAccountDefault)//Se nao houver conta padrao, $bankAccountDefault pode ser null
        {
            $this->repository->update(['default' => false], $bankAccountDefault->id);
        }
    }
}
