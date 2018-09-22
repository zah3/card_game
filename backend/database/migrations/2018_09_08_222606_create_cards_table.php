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
            $table->increments('id');
            $table->unsignedInteger('main_skill_id')->nullable(false);
            $table->unsignedInteger('side_skill_id')->nullable();
            $table->unsignedInteger('type_id')->nullable(false);
            $table->char('name',200)->nullable(false)->unique();
            $table->unsignedSmallInteger('hp')->nullable(false)->default(100);
            $table->unsignedSmallInteger('dmg')->nullable(false)->default(40);
            $table->unsignedSmallInteger('def')->nullable(false)->default(30);
            $table->double('critical',2,2)->nullable(false)->default(0.20);
            $table->double('critical_chance',2,2)->nullable(false)->default(0.15);
            $table->double('block_chance',2,2)->nullable(false)->default(0.15);
            $table->double('accuracy',2,2)->nullable(false)->default(0.85);
            $table->double('reflection',2,2)->nullable(false)->default(0.00);
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->default(DB::raw('NULL on update CURRENT_TIMESTAMP'))->nullable();
            $table->timestamp('deleted_at')->nullable();

            $table->foreign('main_skill_id')->references('id')->on('skill_mains')->onUpdate('Cascade');
            $table->foreign('side_skill_id')->references('id')->on('skill_sides')->onUpdate('Cascade');
            $table->foreign('type_id')->references('id')->on('types')->onUpdate('Cascade');
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
