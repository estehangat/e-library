<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePpaProposalDetailTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ppa_proposal_detail', function (Blueprint $table) {
            $table->id();
			$table->bigInteger('ppa_id');
			$table->bigInteger('ppa_detail_id')->nullable();
			$table->bigInteger('ppa_proposal_id')->nullable();
			$table->bigInteger('account_id');
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
        Schema::dropIfExists('ppa_proposal_detail');
    }
}
