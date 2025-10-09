<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class UpdateDocumentsNullableCategorySubcategory extends Migration
{
    /**
     * Run the migrations.
     *
     * This migration makes documents.category_id and documents.sub_category_id nullable.
     * It uses raw ALTER TABLE statements to avoid requiring doctrine/dbal.
     *
     * Note: adjust the column definitions (int(11)) if your DB uses a different width.
     */
    public function up()
    {
        // Make sure table exists
        if (! Schema::hasTable('documents')) {
            return;
        }

        // Modify columns to allow NULL (preserve default to NULL)
        DB::statement("ALTER TABLE `documents` MODIFY `category_id` INT(11) NULL DEFAULT NULL");
        DB::statement("ALTER TABLE `documents` MODIFY `sub_category_id` INT(11) NULL DEFAULT NULL");
    }

    /**
     * Reverse the migrations.
     *
     * Reverts category_id and sub_category_id to NOT NULL with default 0.
     */
    public function down()
    {
        if (! Schema::hasTable('documents')) {
            return;
        }

        DB::statement("ALTER TABLE `documents` MODIFY `category_id` INT(11) NOT NULL DEFAULT 0");
        DB::statement("ALTER TABLE `documents` MODIFY `sub_category_id` INT(11) NOT NULL DEFAULT 0");
    }
}
