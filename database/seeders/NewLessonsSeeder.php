<?php

namespace Database\Seeders;

use App\Enums\ActualityEnums;
use App\Models\Lesson;
use App\Models\Module;
use App\Models\Test;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class NewLessonsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for($i = 1; $i <= 5; $i++) {
            $module = Module::create([
                'name' => "Модуль $i",
                'title' => "Название для модуля $i",
                'actuality' => ActualityEnums::NEW
            ]);
            for($j = 1; $j <= 5; $j++) {
                Lesson::create([
                    'module_id' => $module->id,
                    'name' => "Урок $j, модуль $i",
                    'title' => "Название урока $j, модуль $i",
                    'desc' => "Описание урока $j, модуль $i",
                    'content' => "Контент урока $j, модуль $i",
                    'actuality' => ActualityEnums::NEW
                ]);
            }

            Test::create([
                'module_id' => $module->id,
                'actuality' => ActualityEnums::NEW,
                'questions' => json_decode("[{\"answers\": [{\"text\": \"Первый (верный)\", \"correct_flg\": true}, {\"text\": \"Второй (верный)\", \"correct_flg\": true}, {\"text\": \"Третий\", \"correct_flg\": false}], \"question\": \"Вопрос 1\"}, {\"answers\": [{\"text\": \"Неверный\", \"correct_flg\": false}, {\"text\": \"Второй (верный)\", \"correct_flg\": true}], \"question\": \"Второй вопрос\"}]"),
            ]);
        }
    }
}
