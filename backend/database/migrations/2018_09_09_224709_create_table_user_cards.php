<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableUserCards extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(
            'user_cards', function (Blueprint $table) {
            $table->collation = 'utf8_general_ci';
            $table->increments('id');
            $table->unsignedInteger('user_id')->nullable(false);
            $table->unsignedInteger('card_id')->nullable(false);
            $table->unsignedInteger('side_skill_id')->nullable(false);
            $table->unsignedInteger('main_skill_id')->nullable(false);
            $table->unsignedSmallInteger('level')->nullable(false)->default(1);
            $table->unsignedSmallInteger('star')->nullable(false)->default(0);
            $table->unsignedSmallInteger('hp')->nullable(false)->default(100);
            $table->unsignedSmallInteger('dmg')->nullable(false)->default(40);
            $table->unsignedSmallInteger('def')->nullable(false)->default(30);
            $table->double('critical',2,2)->nullable(false)->default(0.20);
            $table->double('critical_chance',2,2)->nullable(false)->default(0.15);
            $table->double('block_chance',2,2)->nullable(false)->default(0.15);
            $table->double('accuracy',2,2)->nullable(false)->default(0.85);
            $table->double('reflection',2,2)->nullable(false)->default(0.00);
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->default(\Illuminate\Support\Facades\DB::raw('NULL on update CURRENT_TIMESTAMP'))->nullable();
            $table->timestamp('deleted_at')->nullable();

            $table->foreign('user_id')->references('id')->on('users')->onUpdate('Cascade');
            $table->foreign('card_id')->references('id')->on('cards')->onUpdate('Cascade');
            $table->foreign('main_skill_id')->references('id')->on('skill_mains')->onUpdate('Cascade');
            $table->foreign('side_skill_id')->references('id')->on('skill_sides')->onUpdate('Cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_cards');
    }
}
