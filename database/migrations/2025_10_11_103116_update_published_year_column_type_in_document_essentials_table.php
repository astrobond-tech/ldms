<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('document_essentials', function (Blueprint $table) {
            // Change published_year to SMALLINT (suitable for values like 1226–9999)
            $table->smallInteger('published_year')->nullable()->change();
        });
    }

    public function down(): void
    {
        Schema::table('document_essentials', function (Blueprint $table) {
            // Revert back to TINYINT (if it was originally that)
            $table->tinyInteger('published_year')->nullable()->change();
        });
    }
};
