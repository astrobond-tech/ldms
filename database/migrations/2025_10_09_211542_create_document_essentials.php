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
        Schema::create('document_essentials', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('document_id');
            $table->foreign('document_id')->references('id')->on('documents')->onDelete('cascade');

            // ENUM for selection type
            $table->enum('document_type', ['book', 'document', 'paper_cutting'])
                ->index()
                ->comment('Allowed: book | document | paper_cutting');
            $table->integer('copies_total')->nullable()->default(0);
            $table->integer('copies_available')->nullable()->default(0);
            $table->string('rack')->nullable()->comment('Rack identifier');
            $table->string('shelf')->nullable()->comment('Shelf identifier');
            $table->string('room')->nullable();
            $table->string('cabinet')->nullable();

            // Book-specific fields
            $table->string('author')->nullable();
            $table->string('publisher')->nullable();
            $table->string('isbn')->nullable();

            $table->string('language')->nullable();
            $table->year('published_year')->nullable();

            // Paper-cutting fields
            $table->string('newspaper_name')->nullable();
            $table->date('clipping_date')->nullable();
            $table->string('headline')->nullable();
            $table->string('section')->nullable()->comment('e.g. education, health, economy');
            $table->string('forwarded_to')->nullable()->comment('Officer/Department forwarded to');

            // Office-document specific fields
            $table->string('doc_category')->nullable()->comment('e.g. contract, memo, policy');
            $table->string('ref_number')->nullable()->comment('Document reference number');

            $table->string('file_number')->nullable();
            // Optional pointer to a version_histories row (preferred/current file)
            $table->unsignedBigInteger('latest_version_history_id')->nullable()->comment('FK to version_histories.id');
            $table->foreign('latest_version_history_id')->references('id')->on('version_histories')->onDelete('set null');


            // Indexes
            $table->index(['document_type', 'newspaper_name']);
            $table->index(['document_type', 'author']);
            $table->index(['document_type', 'doc_category']);

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
        Schema::table('document_essentials', function (Blueprint $table) {
            if (Schema::hasColumn('document_essentials', 'latest_version_history_id')) {
                $table->dropForeign(['latest_version_history_id']);
            }

            if (Schema::hasColumn('document_essentials', 'document_id')) {
                $table->dropForeign(['document_id']);
            }
        });

        Schema::dropIfExists('document_essentials');
    }
};
