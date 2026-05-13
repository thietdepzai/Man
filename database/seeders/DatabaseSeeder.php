<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Xóa danh mục cũ nếu cần thiết hoặc seed mới
        DB::table('categories')->insertOrIgnore([
            ['id' => 1, 'name' => 'Muối Hồng Himalaya'],
            ['id' => 2, 'name' => 'Muối Tổng Hợp']
        ]);

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);
    }
}
