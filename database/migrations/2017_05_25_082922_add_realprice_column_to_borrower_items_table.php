<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddRealpriceColumnToBorrowerItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('borrower_items', function (Blueprint $table) {
            $table->double('real_price',15,2)->default(0.00)->after('status');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('borrower_items', function (Blueprint $table) {
            $table->dropColumn('real_price');
        });
    }
}
