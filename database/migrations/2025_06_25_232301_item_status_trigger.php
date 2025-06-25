<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::unprepared('
            CREATE TRIGGER BeforeItemUpdateTrigger 
            BEFORE UPDATE ON items
            FOR EACH ROW
            BEGIN
                IF NEW.qty <= 0 THEN
                    SET NEW.status = "unavailable";
                ELSE
                    SET NEW.status = "available";
                END IF;
            END
        ');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared('DROP TRIGGER IF EXISTS BeforeItemUpdateTrigger');
    }
};
