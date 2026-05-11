<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('expenses', function (Blueprint $table): void {
            $table->string('origin_type')->default('direct')->after('type');
            $table->string('occurrence_type')->default('direct')->after('origin_type');
            $table->foreignId('credit_card_statement_id')
                ->nullable()
                ->after('source_id')
                ->constrained('credit_card_statements')
                ->nullOnDelete();
            $table->string('installment_group_id')->nullable()->after('credit_card_statement_id');
            $table->unsignedSmallInteger('installment_number')->nullable()->after('installment_group_id');
            $table->unsignedSmallInteger('installment_total')->nullable()->after('installment_number');
            $table->date('purchase_date')->nullable()->after('payment_date');
        });
    }

    public function down(): void
    {
        Schema::table('expenses', function (Blueprint $table): void {
            $table->dropConstrainedForeignId('credit_card_statement_id');
            $table->dropColumn([
                'origin_type',
                'occurrence_type',
                'installment_group_id',
                'installment_number',
                'installment_total',
                'purchase_date',
            ]);
        });
    }
};
