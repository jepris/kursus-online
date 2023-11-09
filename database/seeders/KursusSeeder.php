<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class KursusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $imagePath = Storage::url('/img/course1.jpeg');

        DB::table('kursuses')->insert([
            'cover' => $imagePath,
            'judul' => 'UI/UX Design',
            'description' => 'professional certification'
        ]);
    }
}
