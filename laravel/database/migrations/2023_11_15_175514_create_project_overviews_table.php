<?php
// database/migrations/xxxx_xx_xx_create_project_overviews_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProjectOverviewsTable extends Migration
{
    public function up()
    {
        Schema::create('project_overviews', function (Blueprint $table) {
            $table->id('projectOverviewID');
            $table->foreignId('problemGoalID')->constrained('problems_and_goals');
            $table->text('overviewText');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('project_overviews');
    }
}
