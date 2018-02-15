<?php

namespace CodeFinances\Repositories;

trait GetClientsTrait
{
	private function getClients()
    {
        /** @var \CodeFinances\Repositories\ClientRepository $repository */
        $repository = app(\CodeFinances\Repositories\ClientRepository::class);
        $repository->skipPresenter(true);
        
        return $repository->all();   
    }
}