<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('credit_card_statements', function (Blueprint $table) {
            $table->id();
            $table->foreignId('source_id')->constrained('sources')->cascadeOnDelete();
            $table->date('reference_month');
            $table->date('closing_at');
            $table->date('due_at');
            $table->enum('status', ['open', 'closed', 'paid'])->default('open');
            $table->integer('total_amount')->default(0);
            $table->timestamp('paid_at')->nullable();
            $table->foreignId('payment_source_id')->nullable()->constrained('sources')->nullOnDelete();
            $table->timestamps();

            $table->unique(['source_id', 'reference_month']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('credit_card_statements');
    }
};
