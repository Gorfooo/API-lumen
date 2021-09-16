<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Carbon;

class Empresas extends Migration
{

    public function up()
    {
        Schema::create('empresas', function (Blueprint $table) {
            $table->id();
            $table->string('nome');
            $table->string('telefone');
            $table->string('cnpj',14);
            $table->date('created_at')->default(Carbon::now());;
        });
    }

    public function down()
    {
        Schema::dropIfExists('empresas');
    }
}
