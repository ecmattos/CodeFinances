<?php

namespace CodeFinances\Repositories;

trait CategoryRepositoryTrait
{
    
    public function create(array $attributes)
    {
        $model = $this->model;
        $model::$enableTenant = false;
        if(isset($attributes['parent_id']))
        {
            //filha
            $skipPresenter = $this->skipPresenter;
            $this->skipPresenter(true);
            $parent = $this->find($attributes['parent_id']);
            $this->skipPresenter = $skipPresenter;
            $child = $parent->children()->create($attributes);

            $result = $this->parserResult($child);
        }
        else
        {
            //pai
            $result = parent::create($attributes);
        }
        $model::$enableTenant = true;
        return $result;
    }

    
    public function update(array $attributes, $id)
    {
        $model = $this->model;
        $model::$enableTenant = false;
        if(isset($attributes['parent_id'])){
            //filha
            $skipPresenter = $this->skipPresenter;
            $this->skipPresenter(true);
            $child = $this->find($id);
            $child->parent_id = $attributes['parent_id'];
            $child->fill($attributes);
            $child->save();
            $this->skipPresenter = $skipPresenter;
            $result = $this->parserResult($child);
        }else{
            $result = parent::update($attributes, $id);
            $result->makeRoot()->save();
        }
        //pai
        $model::$enableTenant = true;
        return $result;
    }

    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Category::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    public function presenter()
    {
        return CategoryPresenter::class;
    }
    
}
