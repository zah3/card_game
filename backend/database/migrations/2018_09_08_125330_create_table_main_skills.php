<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableMainSkills extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(
            'skill_mains', function (Blueprint $table) {
            $table->collation = 'utf8_general_ci';
            $table->increments('id');
            $table->unsignedInteger('skill_type_id')->nullable();
            $table->char('name',200)->nullable(false)->unique();
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->default(\Illuminate\Support\Facades\DB::raw('NULL on update CURRENT_TIMESTAMP'))->nullable();
            $table->timestamp('deleted_at')->nullable();

            $table->foreign('skill_type_id')->references('id')->on('types')->onUpdate('Cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('skill_mains');
    }
}
