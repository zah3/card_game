<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class CreateCardsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(
            'cards', function (Blueprint $table) {
            $table->collation = 'utf8_general_ci';
            $table->increments('c_id');
            $table->unsignedInteger('c_main_skill_id')->nullable(false);
            $table->unsignedInteger('c_side_skill_id')->nullable();
            $table->unsignedInteger('c_type_id')->nullable(false);
            $table->char('c_name',200)->nullable(false)->unique();
            $table->unsignedSmallInteger('c_hp')->nullable(false)->default(100);
            $table->unsignedSmallInteger('c_dmg')->nullable(false)->default(40);
            $table->unsignedSmallInteger('c_def')->nullable(false)->default(30);
            $table->double('c_critical',2,2)->nullable(false)->default(0.20);
            $table->double('c_critical_chance',2,2)->nullable(false)->default(0.15);
            $table->double('c_block_chance',2,2)->nullable(false)->default(0.15);
            $table->double('c_accuracy',2,2)->nullable(false)->default(0.85);
            $table->double('c_reflection',2,2)->nullable(false)->default(0.00);
            $table->timestamp('c_created_at')->useCurrent();
            $table->timestamp('c_updated_at')->default(DB::raw('NULL on update CURRENT_TIMESTAMP'))->nullable();
            $table->timestamp('c_deleted_at')->nullable();

            $table->foreign('c_main_skill_id')->references('sm_id')->on('skill_mains')->onUpdate('Cascade');
            $table->foreign('c_side_skill_id')->references('ss_id')->on('skill_sides')->onUpdate('Cascade');
            $table->foreign('c_type_id')->references('t_id')->on('types')->onUpdate('Cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cards');
    }
}
