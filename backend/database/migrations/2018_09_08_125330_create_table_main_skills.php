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
            $table->increments('sm_id');
            $table->unsignedInteger('sm_skill_type_id')->nullable();
            $table->char('sm_name',200)->nullable(false)->unique();
            $table->timestamp('sm_created_at')->useCurrent();
            $table->timestamp('sm_updated_at')->default(\Illuminate\Support\Facades\DB::raw('NULL on update CURRENT_TIMESTAMP'))->nullable();
            $table->timestamp('sm_deleted_at')->nullable();

            $table->foreign('sm_skill_type_id')->references('t_id')->on('types')->onUpdate('Cascade');

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
