<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableTypes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(
            'types', function (Blueprint $table) {
            $table->collation = 'utf8_general_ci';
            $table->increments('t_id');
            $table->char('t_name',200)->nullable(false)->unique();
            $table->timestamp('t_created_at')->useCurrent();
            $table->timestamp('t_updated_at')->default(\Illuminate\Support\Facades\DB::raw('NULL on update CURRENT_TIMESTAMP'))->nullable();
            $table->timestamp('t_deleted_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('side_skils');
    }
}
