<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRelationshipsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('relationships', function (Blueprint $table) {
            $table->id();
            $table->foreignId('studentID')->constrained('students','id');
            $table->foreignId('parentID')->constrained('parents','id');
            $table->foreignId('relationID')->constrained('relations','id');
            $table->string('birthCertificate');
            $table->string('status')->default('not actioned');
            $table->string('admin')->default('not actioned');
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
        Schema::dropIfExists('relationships');
    }
}
