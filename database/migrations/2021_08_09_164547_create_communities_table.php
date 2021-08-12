<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommunitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::disableForeignKeyConstraints();
        Schema::create('communities', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name', 255);
            $table->unsignedBigInteger('department_id');
            //llave foranea 1
            $table->foreign('department_id')->references('id')->on('departments')->onDelete('cascade');
            $table->unsignedBigInteger('province_id');
            //llave forane 2
            $table->foreign('province_id')->references('id')->on('provinces')->onDelete('cascade');  
            $table->unsignedBigInteger('district_id');
            //llave foranea 3
            $table->foreign('district_id')->references('id')->on('districts')->onDelete('cascade');
    
            $table->timestamps();
            $table->softDeletes(); //Nueva línea, para el borrado lógico
            $table->engine = 'InnoDB';  

        });
        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        Schema::dropIfExists('communities');
        DB::statement('SET FOREIGN_KEY_CHECKS = 1');
    }
}
