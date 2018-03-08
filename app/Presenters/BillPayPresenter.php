<?php

namespace CodeFinances\Presenters;

use CodeFinances\Transformers\BillPayTransformer;
use Prettus\Repository\Presenter\FractalPresenter;
/**
 * Class BankAccountPresenter
 *
 * @package namespace CodeFinances\Presenters;
 */
class BillPayPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new BillPayTransformer();
    }
}
