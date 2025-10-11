<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('document_issues', function (Blueprint $table) {
            $table->integer('quantity')->default(1)->after('status');
            $table->integer('returned_quantity')->default(0)->after('quantity');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('document_issues', function (Blueprint $table) {
            $table->dropColumn(['quantity', 'returned_quantity']);
        });
    }
};