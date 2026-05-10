<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('meetings', function (Blueprint $table) {
            if (!Schema::hasColumn('meetings', 'duration_hours')) {
                $table->integer('duration_hours')->nullable()->after('scheduled_at');
            }

            if (!Schema::hasColumn('meetings', 'subject')) {
                $table->string('subject')->nullable()->after('duration_hours');
            }

            if (!Schema::hasColumn('meetings', 'online')) {
                $table->boolean('online')->default(true)->after('location');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('meetings', function (Blueprint $table) {
            if (Schema::hasColumn('meetings', 'online')) {
                $table->dropColumn('online');
            }
            if (Schema::hasColumn('meetings', 'subject')) {
                $table->dropColumn('subject');
            }
            if (Schema::hasColumn('meetings', 'duration_hours')) {
                $table->dropColumn('duration_hours');
            }
        });
    }
};
