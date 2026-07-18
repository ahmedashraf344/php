<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SettingTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('settings')->insert([
            [
                'key' => 'name_ar',
                'value' => null,
                'group_title' => 'general'
            ], [
                'key' => 'name_en',
                'value' => null,
                'group_title' => 'general'
            ], [
                'key' => 'copyrights_ar',
                'value' => null,
                'group_title' => 'general'
            ], [
                'key' => 'copyrights_en',
                'value' => null,
                'group_title' => 'general'
            ], [
                'key' => 'logo',
                'value' => null,
                'group_title' => 'general'
            ], [
                'key' => 'terms_title_ar',
                'value' => null,
                'group_title' => 'terms_page'
            ], [
                'key' => 'terms_title_en',
                'value' => null,
                'group_title' => 'terms_page'
            ], [
                'key' => 'terms_content_ar',
                'value' => null,
                'group_title' => 'terms_page'
            ], [
                'key' => 'terms_content_en',
                'value' => null,
                'group_title' => 'terms_page'
            ], [
                'key' => 'about_title_ar',
                'value' => null,
                'group_title' => 'about_page'
            ], [
                'key' => 'about_title_en',
                'value' => null,
                'group_title' => 'about_page'
            ], [
                'key' => 'about_content_ar',
                'value' => null,
                'group_title' => 'about_page'
            ], [
                'key' => 'about_content_en',
                'value' => null,
                'group_title' => 'about_page'
            ],
        ]);
    }
}
