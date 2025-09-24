<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class MemoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $now = Carbon::now();

        // Pastikan ada user pertama sebagai pengirim
        // $senderId = DB::table('users')->value('id');
        $senderId = 3;
        // $readerId = DB::table('users')->where('id', '!=', $senderId)->value('id'); // user lain sebagai pembaca
        $readerId = 5; // user lain sebagai pembaca

        // Buat 3 memo
        $memo1Id = DB::table('memos')->insertGetId([
            'title'      => 'Pengumuman Libur Nasional',
            'body'       => 'Perusahaan akan libur pada tanggal 1 Oktober 2025 dalam rangka peringatan Hari Kesaktian Pancasila.',
            'sender_id'  => $senderId,
            'priority'   => 'high',
            'status'     => 'sent',
            'sent_at'    => $now,
            'created_at' => $now,
            'updated_at' => $now,
        ]);

        $memo2Id = DB::table('memos')->insertGetId([
            'title'      => 'Reminder Rapat Mingguan',
            'body'       => 'Rapat mingguan akan diadakan hari Senin pukul 09:00 di ruang meeting 1.',
            'sender_id'  => $senderId,
            'priority'   => 'normal',
            'status'     => 'sent',
            'sent_at'    => $now,
            'created_at' => $now,
            'updated_at' => $now,
        ]);

        $memo3Id = DB::table('memos')->insertGetId([
            'title'      => 'Perubahan Jam Kerja',
            'body'       => 'Mulai minggu depan, jam kerja akan dimulai pukul 08:00 dan berakhir pukul 16:00.',
            'sender_id'  => $senderId,
            'priority'   => 'low',
            'status'     => 'sent',
            'sent_at'    => $now,
            'created_at' => $now,
            'updated_at' => $now,
        ]);

        // Tandai 2 memo sudah dibaca
        DB::table('memo_reads')->insert([
            [
                'memo_id'   => $memo1Id,
                'user_id'   => $readerId,
                'read_at'   => $now,
            ],
            [
                'memo_id'   => $memo2Id,
                'user_id'   => $readerId,
                'read_at'   => $now,
            ],
        ]);

        // Memo3 sengaja tidak dimasukkan ke memo_reads agar dianggap belum dibaca
    }
}
