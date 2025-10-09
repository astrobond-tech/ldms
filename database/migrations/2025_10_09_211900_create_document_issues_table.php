<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDocumentIssuesTable extends Migration
{
    public function up()
    {
        Schema::create('document_issues', function (Blueprint $table) {
            $table->id();

            // Link to documents (master)
            $table->unsignedBigInteger('document_id');
            $table->foreign('document_id')->references('id')->on('documents')->onDelete('cascade');

            // Optional link to document_essentials row
            $table->unsignedBigInteger('essential_id')->nullable();
            $table->foreign('essential_id')->references('id')->on('document_essentials')->onDelete('set null');

            // Borrower and issuer
            $table->unsignedBigInteger('user_id')->nullable()->comment('Who borrowed the item');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('set null');

            $table->unsignedBigInteger('issued_by')->nullable()->comment('Who issued (librarian/admin)');
            $table->foreign('issued_by')->references('id')->on('users')->onDelete('set null');

            // Dates
            $table->dateTime('issue_date')->nullable();
            $table->dateTime('due_date')->nullable();
            $table->dateTime('return_date')->nullable();

            // status (small set) - keep as string to avoid DB portability issues with enums in some environments
            $table->string('status', 40)->default('issued')->comment('issued|returned|overdue|lost|damaged');

            // Return metadata
            $table->string('returned_to_location')->nullable();
            $table->text('return_notes')->nullable();
            $table->boolean('is_damaged')->default(false);
            $table->decimal('fine_amount', 8, 2)->nullable()->default(0);

            $table->timestamps();

            $table->index(['document_id', 'user_id', 'status']);
        });
    }

    public function down()
    {
        Schema::table('document_issues', function (Blueprint $table) {
            if (Schema::hasColumn('document_issues', 'document_id')) {
                $table->dropForeign(['document_id']);
            }
            if (Schema::hasColumn('document_issues', 'essential_id')) {
                $table->dropForeign(['essential_id']);
            }
            if (Schema::hasColumn('document_issues', 'user_id')) {
                $table->dropForeign(['user_id']);
            }
            if (Schema::hasColumn('document_issues', 'issued_by')) {
                $table->dropForeign(['issued_by']);
            }
        });

        Schema::dropIfExists('document_issues');
    }
}
