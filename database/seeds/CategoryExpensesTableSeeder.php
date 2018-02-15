<?php

use Illuminate\Database\Seeder;

class CategoryExpensesTableSeeder extends Seeder
{
    use \CodeFinances\Repositories\GetClientsTrait;
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $clients = $this->getClients();
        factory(\CodeFinances\Models\CategoryExpense::class, 30)
            ->make()
            ->each(function ($category) use($clients){
                $client = $clients->random();
                $category->client_id = $client->id;
                $category->save();
            });
        $categoriesRoot = $this->getCategoryExpensesRoot();
        foreach ($categoriesRoot as $root){
            factory(\CodeFinances\Models\CategoryExpense::class, 3)
                ->make()
                ->each(function ($child) use($root){
                    $child->client_id = $root->client_id;
                    $child->save();
                    $child->parent()->associate($root);
                    $child->save();
                });
        }
    }
    private function getCategoryExpensesRoot()
    {
        /** @var CodeFinances\Repositories\CategoryRepository $repository */
        $repository = app(\CodeFinances\Repositories\CategoryExpenseRepository::class);
        $repository->skipPresenter(true);
        return $repository->all();
    }
}