<?php

namespace CodeFinances\Presenters;

use CodeFinances\Transformers\BankAccountTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class BankAccountPresenter.
 *
 * @package namespace CodeFinances\Presenters;
 */
class BankAccountPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new BankAccountTransformer();
    }
}
