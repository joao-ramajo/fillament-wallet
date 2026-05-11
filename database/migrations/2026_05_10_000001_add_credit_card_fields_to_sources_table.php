<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('sources', function (Blueprint $table) {
            $table->string('type')->default('cash_like')->after('name');
            $table->integer('credit_limit')->nullable()->after('allow_negative');
            $table->unsignedTinyInteger('statement_closing_day')->nullable()->after('credit_limit');
            $table->unsignedTinyInteger('statement_due_day')->nullable()->after('statement_closing_day');
        });
    }

    public function down(): void
    {
        Schema::table('sources', function (Blueprint $table) {
            $table->dropColumn([
                'type',
                'credit_limit',
                'statement_closing_day',
                'statement_due_day',
            ]);
        });
    }
};
