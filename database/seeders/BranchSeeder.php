<?php

namespace Database\Seeders;

use App\Models\Branch;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Seeder;

class BranchSeeder extends Seeder
{
    use HasFactory;
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Branch::insert([
            ['name' => 'Rectoria'],
            ['name' => 'Zapopan'],
            ['name' => 'Orizaba'],
        ]);
    }
}
