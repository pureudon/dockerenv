<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();

            // letter head (left)
            $table->date('date')->nullable();
            $table->string('name')->nullable();
            $table->string('category')->nullable();
            $table->string('type')->nullable();
            $table->string('ref',20)->nullable();
            $table->string('fontcolor')->nullable();
            $table->string('companyid')->nullable();
            $table->string('companyname1')->nullable();
            $table->string('companyname2')->nullable();
            $table->string('clientid')->nullable();
            $table->string('clientname')->nullable();
            $table->string('siteid')->nullable();
            $table->string('sitename')->nullable();
            $table->string('addr1')->nullable();
            $table->string('addr2')->nullable();
            $table->string('addr3')->nullable();
            $table->string('attn')->nullable();
            $table->string('dept')->nullable();
            $table->string('contactperson')->nullable();
            $table->string('tel')->nullable();
            $table->string('fax')->nullable();
            $table->string('email')->nullable();

            $table->string('quot')->nullable();
            $table->string('po')->nullable();
            $table->string('salesid')->nullable();
            $table->string('salesname')->nullable();

            $table->string('startday')->nullable();
            $table->string('endday')->nullable();
            $table->string('period')->nullable();
            $table->string('length')->nullable();

            $table->string('deliverydate')->nullable();
            $table->string('collectiondate')->nullable();

            $table->decimal('totalamount', $precision = 8, $scale = 2)->nullable();

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
        Schema::dropIfExists('invoices');
    }
}
