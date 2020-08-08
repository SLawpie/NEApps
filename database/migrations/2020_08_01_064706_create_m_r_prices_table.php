<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMRPricesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('m_r_prices', function (Blueprint $table) {
            $table->id();
            
            $table->unsignedBigInteger('examination_id');
            $table->foreign('examination_id')->references('id')->on('m_r_examinations')->onDelete('cascade');
            
            $table->unsignedBigInteger('facility_id');
            $table->foreign('facility_id')->references('id')->on('m_r_facilities')->onDelete('cascade');
            
            $table->decimal('price', 5, 2);
            $table->text('description')->nullable();
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
        $table->dropForeign(['examination_id']);
        $table->dropForeign(['facility_id']);
        
        Schema::dropIfExists('m_r_prices');
    }
}
