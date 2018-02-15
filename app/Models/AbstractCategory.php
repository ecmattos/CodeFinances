<?php

namespace CodeFinances\Models;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

use Kalnoy\Nestedset\NodeTrait;

use HipsterJazzbo\Landlord\BelongsToTenants;

/**
 * Class Category.
 *
 * @package namespace CodeFinances\Models;
 */
class AbstractCategory extends Model implements Transformable
{
    use TransformableTrait;
    use BelongsToTenants;
    use NodeTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
    	'name',
    ];

    //dESABILITAR O MULTITENANCE QUANDO NA ADICAO E ALTERACAO DE CATEGORIAS E ASSIM POSSIBILITAR A 
    //CONSULTA DE NAO APENAS O CLIENTE QUE ESTA LOGADO MAS SIM DE TODOS 
    //E COM ISSO ATRIBUIR CORRETAMENTE O VALOR DE DEPTH = 0 QUANDO NA CRIACAO DE NOVAS CATEGORIAS PAI
    //vvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvv
    
    public static $enableTenant = true; 

    public function newQuery()
    {
        $builder = $this->newQueryWithoutScopes();

        foreach ($this->getGlobalScopes() as $identifier => $scope) {
            if((static::$enableTenant && $identifier == 'client_id') || $identifier != 'client_id')
            {
                $builder->withGlobalScope($identifier, $scope);
            }
        }


        return $builder;
    }

    //^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^ 
}

