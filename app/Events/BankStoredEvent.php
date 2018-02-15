<?php

namespace CodeFinances\Events;

use Illuminate\Http\UploadedFile;
use CodeFinances\Models\Bank;

class BankStoredEvent
{
    private $bank;
    private $logo;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Bank $bank, UploadedFile $logo = null)
    {
        $this->bank = $bank;
        $this->logo = $logo;
    }

    public function getBank()
    {
        return $this->bank;
    }

    public function getLogo()
    {
        return $this->logo;
    }
}
