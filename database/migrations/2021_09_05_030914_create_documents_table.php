<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDocumentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('documents', function (Blueprint $table) {
            $table->id();
            $table->string('staffs');
            $table->string('category_id');
            $table->string('from');
            $table->string('to');
            $table->string('file_ref');
            $table->string('cc');
            $table->string('date_issued');
            $table->string('attn');
            $table->string('subject');
            $table->text('content');
            $table->string('for_secretary');
            $table->string('status');
            $table->string('pdf_url');
            $table->integer('user_id');
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
        Schema::dropIfExists('documents');
    }
}
