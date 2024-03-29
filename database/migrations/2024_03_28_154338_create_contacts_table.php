<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('contacts', function (Blueprint $table) {
            $table->string('id');
            $table->string('name')->nullable();
            $table->string('responsible_user_id')->nullable();
            $table->string('responsible_user')->nullable();
            $table->string('date_create')->nullable();
            $table->string('last_modified')->nullable();
            $table->string('created_user_id')->nullable();
            $table->string('modified_user_id')->nullable();
            $table->string('company_name')->nullable();
            $table->string('linked_company_id')->nullable();
            $table->string('account_id')->nullable();
            $table->string('type')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('contacts');
    }
};
