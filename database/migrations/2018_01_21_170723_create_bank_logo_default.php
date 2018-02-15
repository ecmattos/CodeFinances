<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBankLogoDefault extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $logo = new \Illuminate\Http\UploadedFile(
           storage_path('app/files/banks/logos/'.env('BANK_LOGO_DEFAULT').''), env('BANK_LOGO_DEFAULT') 
        );
        $name = env('BANK_LOGO_DEFAULT');
        $destFile = \CodeFinances\Models\Bank::logosDir();  

        \Storage::disk('public')->putFileAs($destFile, $logo, $name);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $name = env('BANK_LOGO_DEFAULT');
        $path = \CodeFinances\Models\Bank::logosDir() . '/' . $name;
        \Storage::disk('public')->delete($path);
    }
}
