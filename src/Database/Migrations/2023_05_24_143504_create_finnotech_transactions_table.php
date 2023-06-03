<?php

namespace Tedon\LaravelFinnotech\Database\Migrations;

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('finnotech_transactions', function (Blueprint $table) {
            $table->id();
            $table->string('type')->nullable();
            $table->string('track_id')->nullable();
            $table->string('status')->nullable();
            $table->json('result')->nullable();
            $table->json('error')->nullable();
            $table->json('inputs')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('finnotech_transactions');
    }
};
