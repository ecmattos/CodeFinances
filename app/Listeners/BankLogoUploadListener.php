<?php

namespace CodeFinances\Listeners;

use CodeFinances\Events\BankStoredEvent;
#use Illuminate\Queue\InteractsWithQueue;
#use Illuminate\Contracts\Queue\ShouldQueue;
use CodeFinances\Repositories\BankRepository;

class BankLogoUploadListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(BankRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Handle the event.
     *
     * @param  BankStoredEvent  $event
     * @return void
     */
    public function handle(BankStoredEvent $event)
    {
        $bank = $event->getBank();
        $logo = $event->getLogo();

        if($logo)
        {
            $name = $bank->crated_at != $bank->update_at ? $bank->logo : md5(time()) . '.' . $logo->guessExtension();
            $destFile = $bank->logosDir(); 

            $result = \Storage::disk('public')->putFileAs($destFile, $logo, $name);
            
            if($result && $bank->crated_at == $bank->update_at)
            {
                $this->repository->update(['logo' => $name], $bank->id);
            }
        }
    }
}
