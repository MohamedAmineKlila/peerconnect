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
        Schema::table('meeting_accepts', function (Blueprint $table) {
            if (!Schema::hasColumn('meeting_accepts', 'connection_id')) {
                $table->foreignId('connection_id')->constrained()->cascadeOnDelete()->after('id');
            }

            if (!Schema::hasColumn('meeting_accepts', 'user_id')) {
                $table->foreignId('user_id')->constrained()->cascadeOnDelete()->after('connection_id');
            }

            if (!Schema::hasColumn('meeting_accepts', 'accepted')) {
                $table->boolean('accepted')->default(false)->after('user_id');
            }

            if (!Schema::hasColumn('meeting_accepts', 'accepted_at')) {
                $table->timestamp('accepted_at')->nullable()->after('accepted');
            }

            if (!Schema::hasColumn('meeting_accepts', 'created_at')) {
                $table->timestamps();
            }

            if (!Schema::hasIndex('meeting_accepts', 'meeting_accepts_connection_id_user_id_unique')) {
                $table->unique(['connection_id', 'user_id']);
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('meeting_accepts', function (Blueprint $table) {
            if (Schema::hasIndex('meeting_accepts', 'meeting_accepts_connection_id_user_id_unique')) {
                $table->dropUnique('meeting_accepts_connection_id_user_id_unique');
            }

            if (Schema::hasColumn('meeting_accepts', 'accepted_at')) {
                $table->dropColumn('accepted_at');
            }

            if (Schema::hasColumn('meeting_accepts', 'accepted')) {
                $table->dropColumn('accepted');
            }

            if (Schema::hasColumn('meeting_accepts', 'user_id')) {
                $table->dropForeign(['user_id']);
                $table->dropColumn('user_id');
            }

            if (Schema::hasColumn('meeting_accepts', 'connection_id')) {
                $table->dropForeign(['connection_id']);
                $table->dropColumn('connection_id');
            }
        });
    }
};
