<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TestimonialSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('testimonials')->insert([
            [
                'name' => 'Vijayanagaram Rahul',
                'title' => 'Freelauncer',
                'image_path' => 'assets/img/testimonials/rahul.jpg',
                'testimonial_text' => 'Minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat tarad limino ata Minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat tarad limino ata',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'sandeep',
                'title' => 'Freelauncer',
                'image_path' => 'assets/img/testimonials/sandeep.jpg',
                'testimonial_text' => 'Minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat tarad limino ata Minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat tarad limino ata',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
