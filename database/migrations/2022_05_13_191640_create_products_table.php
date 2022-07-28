<?php

use App\Models\Product;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            
            // $table->product = 'InnoDB';
            $table->id();

            $table->unsignedBigInteger('category_id');
            $table->unsignedBigInteger('brand_id');

            // $table->unsignedBigInteger('created_by');
            
            $table->foreign('brand_id')->references('id')->on('brands')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade')->onUpdate('cascade');
            // $table->foreign('created_by')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');


            $table->string('image');
            $table->string('title');
            $table->string('description');
            $table->decimal('selling_price', 8, 2);
            $table->decimal('original_price', 8, 2);
            // $table->string('year', 4)->unllable();
            // $table->boolean(Product::STATUS_ACTCIVE);
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
        Schema::dropIfExists('products');
    }
}
