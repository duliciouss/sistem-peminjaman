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
        // Function 1: Count total loans
        DB::unprepared('
            CREATE FUNCTION GetTotalLoans() 
            RETURNS INT
            DETERMINISTIC
            BEGIN
                DECLARE total INT;
                SELECT COUNT(*) INTO total FROM item_loans;
                RETURN IFNULL(total, 0);
            END
        ');

        DB::unprepared('
            CREATE FUNCTION GetReturnedLoans() 
            RETURNS INT
            DETERMINISTIC
            BEGIN
                DECLARE total INT;
                SELECT COUNT(DISTINCT loan_id) INTO total FROM item_returns;
                RETURN IFNULL(total, 0);
            END
        ');

        DB::unprepared('
            CREATE FUNCTION GetUnreturnedLoans()
            RETURNS INT
            DETERMINISTIC
            BEGIN
                DECLARE unreturned_count INT;
                
                SELECT COUNT(*) INTO unreturned_count
                FROM item_loans il
                WHERE NOT EXISTS (
                    SELECT 1 
                    FROM item_returns ir 
                    WHERE ir.loan_id = il.id
                );
                
                RETURN IFNULL(unreturned_count, 0);
            END
        ');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared('
            DROP FUNCTION IF EXISTS GetTotalLoans;
            DROP FUNCTION IF EXISTS GetReturnedLoans;
            DROP FUNCTION IF EXISTS GetUnreturnedLoans;
        ');
    }
};
