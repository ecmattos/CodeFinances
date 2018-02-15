<?php

namespace CodeFinances\Models;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class Bank.
 *
 * @package namespace CodeFinances\Models;
 */
class Bank extends Model implements Transformable
{
    use TransformableTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
    	'name',
    	'logo'
    ];

    public static function logosDir() 
    {
    	return 'banks/images';
    }


    public function bankAccounts() 
    {
        #return $this->(bankAccounts::class);
    }
}
