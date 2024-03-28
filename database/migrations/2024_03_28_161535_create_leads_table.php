<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('leads', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('old_status_id')->nullable();
            $table->string('status_id')->nullable();
            $table->string('price')->nullable();
            $table->string('responsible_user_id')->nullable();
            $table->string('last_modified')->nullable();
            $table->string('modified_user_id')->nullable();
            $table->string('created_user_id')->nullable();
            $table->string('date_create')->nullable();
            $table->string('account_id')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('leads');
    }
};
