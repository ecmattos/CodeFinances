<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $repository = app(\CodeFinances\Repositories\ClientRepository::class);
        $clients = $repository->all();

        factory(\CodeFinances\Models\User::class,1)
            ->states('admin')->create([
                'name' => 'Eduardo Mattos',
                'email'=> 'admin@user.com'
            ]);
        foreach (range(1,50) as $value){
            factory(\CodeFinances\Models\User::class,1)
                ->create([
                    'name' => "Cliente da Silva nr. $value",
                    'email'=> "client$value@user.com"
                ])->each(function($user) use ($clients){
                    $client = $clients->random();
                    $user->client()->associate($client);
                    $user->save();
            });
        }
    }
}
 