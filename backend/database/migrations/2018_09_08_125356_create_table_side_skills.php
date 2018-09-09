<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableSideSkills extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(
            'skill_sides', function (Blueprint $table) {
            $table->collation = 'utf8_general_ci';
            $table->increments('ss_id');
            $table->unsignedInteger('ss_skill_type_id')->nullable();
            $table->char('ss_name',200)->nullable(false)->unique();
            $table->timestamp('ss_created_at')->useCurrent();
            $table->timestamp('ss_updated_at')->default(\Illuminate\Support\Facades\DB::raw('NULL on update CURRENT_TIMESTAMP'))->nullable();
            $table->timestamp('ss_deleted_at')->nullable();

            $table->foreign('ss_skill_type_id')->references('t_id')->on('types')->onDelete('set null')->onUpdate('Cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('skill_sides');
    }
}
