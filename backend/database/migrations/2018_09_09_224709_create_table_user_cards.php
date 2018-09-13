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
            $table->increments('uc_id');
            $table->unsignedInteger('uc_user_id')->nullable(false);
            $table->unsignedInteger('uc_card_id')->nullable(false);
            $table->unsignedInteger('uc_side_skill_id')->nullable(false);
            $table->unsignedInteger('uc_main_skill_id')->nullable(false);
            $table->unsignedSmallInteger('uc_level')->nullable(false)->default(1);
            $table->unsignedSmallInteger('uc_star')->nullable(false)->default(0);
            $table->unsignedSmallInteger('uc_hp')->nullable(false)->default(100);
            $table->unsignedSmallInteger('uc_dmg')->nullable(false)->default(40);
            $table->unsignedSmallInteger('uc_def')->nullable(false)->default(30);
            $table->double('uc_critical',2,2)->nullable(false)->default(0.20);
            $table->double('uc_critical_chance',2,2)->nullable(false)->default(0.15);
            $table->double('uc_block_chance',2,2)->nullable(false)->default(0.15);
            $table->double('uc_accuracy',2,2)->nullable(false)->default(0.85);
            $table->double('uc_reflection',2,2)->nullable(false)->default(0.00);
            $table->timestamp('uc_created_at')->useCurrent();
            $table->timestamp('uc_updated_at')->default(\Illuminate\Support\Facades\DB::raw('NULL on update CURRENT_TIMESTAMP'))->nullable();
            $table->timestamp('uc_deleted_at')->nullable();

            $table->foreign('uc_user_id')->references('id')->on('users')->onUpdate('Cascade');
            $table->foreign('uc_card_id')->references('c_id')->on('cards')->onUpdate('Cascade');
            $table->foreign('uc_main_skill_id')->references('sm_id')->on('skill_mains')->onUpdate('Cascade');
            $table->foreign('uc_side_skill_id')->references('ss_id')->on('skill_sides')->onUpdate('Cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
