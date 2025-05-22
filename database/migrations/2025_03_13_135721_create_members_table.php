<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('members', function (Blueprint $table) {
            $table->foreign('memberId')->references('id')->on('users')->onDelete('cascade');
            $table->float('price');
            $table->id('memberId');
            $table->boolean('activeStatus');
            $table->date('membershipDueDate');
            $table->date('membershipStart');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('members');
    }
};
