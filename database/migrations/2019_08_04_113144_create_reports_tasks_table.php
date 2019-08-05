<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReportsTasksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reports_tasks', function (Blueprint $table) {
            $table->unsignedBigInteger('report_id')->unique();
            $table->unique('task_id')->unique();
            $table->foreign('report_id')->references('id')->on('reports');
            $table->foreign('task_id')->references('id')->on('tasks');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reports_tasks');
    }
}
