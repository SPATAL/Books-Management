<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBooksTable extends Migration
{
    public function up()
{
    if (!Schema::hasTable('books')) {
        Schema::create('books', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description');
            $table->decimal('price', 8, 2);
            $table->string('image')->nullable();
            $table->string('pdf')->nullable();
            //$table->foreignId('author_id')->constrained()->onDelete('cascade');
            $table->date('published_at')->nullable();
            $table->timestamps();
        });
    }
}


    public function down()
    {
        Schema::dropIfExists('books');
    }
}
