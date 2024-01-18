<?php

namespace App\Models;

use App\Models\Kursus;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Siswa extends Model
{
    use HasFactory;

    protected $guarded = [];

    // public function kursus(){
    //     return $this->hasMany(Kursus::class);
    // }
}
