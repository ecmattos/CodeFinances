<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBanksData extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $repository = app(\CodeFinances\Repositories\BankRepository::class);

        foreach ($this->getData() as $bankArray) 
        {
            $repository->create($bankArray);
            sleep(1);
        }
        //
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $repository = app(\CodeFinances\Repositories\BankRepository::class);
        $repository->skipPresenter(true);
        $count = count($this->getData());
        foreach(range(1, $count) as $value)
        {
            $model = $repository->find($value);
            $path = \CodeFinances\Models\Bank::logosDir() . '/' . $model->logo;
            \Storage::disk('public')->delete($path);
            $model->delete();
        }
    }

    public function getData() 
    {
        return  [
            [
                'name' => 'Caixa',
                'logo' => new \Illuminate\Http\UploadedFile(
                    storage_path('app/files/banks/logos/cef.jpg'), 'cef.jpg'
                )
            ],
            [
                'name' => 'Banrisul',
                'logo' => new \Illuminate\Http\UploadedFile(
                    storage_path('app/files/banks/logos/banrisul.jpg'), 'banrisul.jpg'
                )
            ],
            [
                'name' => 'Banco do Brasil',
                'logo' => new \Illuminate\Http\UploadedFile(
                    storage_path('app/files/banks/logos/bb.png'), 'bb.png'
                )
            ],
            [
                'name' => 'Bradesco',
                'logo' => new \Illuminate\Http\UploadedFile(
                    storage_path('app/files/banks/logos/bradesco.png'), 'bradesco.png'
                )
            ],
            [
                'name' => 'Itaú',
                'logo' => new \Illuminate\Http\UploadedFile(
                    storage_path('app/files/banks/logos/itau.png'), 'itau.png'
                )
            ],
            [
                'name' => 'NuBank',
                'logo' => new \Illuminate\Http\UploadedFile(
                    storage_path('app/files/banks/logos/nu.png'), 'nu.png'
                )
            ],
            [
                'name' => 'Santander',
                'logo' => new \Illuminate\Http\UploadedFile(
                    storage_path('app/files/banks/logos/santander.png'), 'santander.png'
                )
            ]
        ];
    }
}
