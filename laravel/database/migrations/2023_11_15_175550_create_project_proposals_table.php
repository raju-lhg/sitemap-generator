<?php

// database/migrations/xxxx_xx_xx_create_project_proposals_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProjectProposalsTable extends Migration
{
    public function up()
    {
        Schema::create('project_proposals', function (Blueprint $table) {
            $table->id('projectProposalID');
            $table->foreignId('projectOverviewID')->constrained('project_overviews');
            $table->foreignId('scopeOfWorkID')->constrained('scope_of_works');
            $table->text('proposalText');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('project_proposals');
    }
}
