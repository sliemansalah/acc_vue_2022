<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCouponsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('coupons', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('code')->unique();
            $table->double('value')->unsigned()->nullable();
            $table->boolean('is_percent')->default(0); //0 => fixed, 1 => percent
            $table->integer('usage_limit_per_coupon')->unsigned()->nullable(); // عد المرات المسسموح بها استخدام الكوبون
            $table->integer('usage_limit_per_customer')->unsigned()->nullable(); // كم مرة يستطيع العميل استخدام الكوبون هذا
            $table->integer('used')->default(0);
            $table->tinyInteger('status')->default(0);
            $table->timestamp('start_date')->nullable();
            $table->timestamp('end_date')->nullable();
            $table->unsignedBigInteger('store_id');
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('coupon_item', function (Blueprint $table) {
            $table->integer('coupon_id')->unsigned();
            $table->integer('item_id')->unsigned();
            $table->boolean('exclude')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('coupons');
    }
}
