<?php

namespace CodeFinances\Presenters;

use CodeFinances\Transformers\BankTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class BankPresenter.
 *
 * @package namespace CodeFinances\Presenters;
 */
class BankPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new BankTransformer();
    }
}
