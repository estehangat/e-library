<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePpaProposalTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ppa_proposal', function (Blueprint $table) {
            $table->id();
			$table->string('desc');
			$table->bigInteger('amount')->default(0);
			$table->bigInteger('ppa_detail_id')->nullable();
			$table->bigInteger('employee_id');
            $table->integer('position_id');
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
        Schema::dropIfExists('ppa_proposal');
    }
}
