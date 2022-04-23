<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSlugToAdvertisementTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('advertisements', function (Blueprint $table) {
           $table->string('slug')->after('name');
           $table->string('link')->nullable()->change();
           $table->string('phone_number')->nullable()->change();
           $table->foreignId('sub_category_id')->nullable()->constrained('categories');
           $table->foreignId('child_category_id')->nullable()->constrained('categories');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('advertisements', function (Blueprint $table) {
            $table->dropColumn('slug');
            $table->string('link')->change();
            $table->string('phone_number')->change();
            $table->dropForeign(['sub_category_id']);
            $table->dropForeign(['child_category_id']);
            $table->dropColumn(['sub_category_id', 'child_category_id']);
        });
    }
}
