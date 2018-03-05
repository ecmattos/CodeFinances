<?php

namespace CodeFinances\Models;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

use HipsterJazzbo\Landlord\BelongsToTenants;

/**
 * Class BillPay.
 *
 * @package namespace CodeFinances\Models;
 */
class BillPay extends Model implements Transformable
{
    use TransformableTrait;
    use BelongsToTenants;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
    	'date_due',
    	'name',
    	'value',
    	'done'
    ];

}
