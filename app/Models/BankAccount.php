<?php

namespace CodeFinances\Models;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

use HipsterJazzbo\Landlord\BelongsToTenants;

/**
 * Class BankAccount.
 *
 * @package namespace CodeFinances\Models;
 */
class BankAccount extends Model implements Transformable
{
    use TransformableTrait;
    use BelongsToTenants;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
    	'name',
    	'agency',
    	'account',
    	'bank_id',
    	'default'
    ];

    public function bank()
    {
    	return $this->belongsTo(Bank::class);
    }

}
