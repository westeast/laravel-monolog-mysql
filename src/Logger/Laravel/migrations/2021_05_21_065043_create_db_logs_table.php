<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

class CreateDbLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(
            env('DB_LOG_TABLE', 'logs'),
            function (Blueprint $table) {
                $table->engine = 'InnoDB';

                $table->bigIncrements('id');
                $table->string('instance')->index();
                $table->string('channel')->index();
                $table->string('level')->index();
                $table->string('level_name');
                $table->text('message');
                $table->text('context');
                $table->text('trace');
                $table->text('params');
                $table->string('url')->nullable();
                $table->string('remote_addr')->nullable();
                $table->string('user_agent')->nullable();
                $table->integer('created_by')->nullable()->index();
                $table->dateTime('created_at');
            }
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop(env('DB_LOG_TABLE', 'logs'));
    }
}
