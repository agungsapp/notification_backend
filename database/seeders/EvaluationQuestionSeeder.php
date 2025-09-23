<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class EvaluationQuestionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $now = Carbon::now();

        DB::table('evaluation_questions')->insert([
            [
                'question'   => 'Bagaimana sikap karyawan?',
                'weight'     => 1,
                'is_active'  => true,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'question'   => 'Bagaimana disiplin karyawan?',
                'weight'     => 1,
                'is_active'  => true,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'question'   => 'Bagaimana kreativitas karyawan dalam tim?',
                'weight'     => 1,
                'is_active'  => true,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'question'   => 'Bagaimana komunikasi karyawan dengan tim dan atasan?',
                'weight'     => 1,
                'is_active'  => true,
                'created_at' => $now,
                'updated_at' => $now,
            ],
        ]);
    }
}
