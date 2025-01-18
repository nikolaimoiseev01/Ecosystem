<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Lesson;
use App\Models\Module;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */

    public $modules = [
        [
            'name' => 'Модуль 1',
            'title' => 'Основы экологии и экологического мышления',
        ],
        [
            'name' => 'Модуль 2',
            'title' => 'Практические аспекты и коммуникация',
        ],
        [
            'name' => 'Модуль 3',
            'title' => 'Экологические вызовы и решения',
        ],
        [
            'name' => 'Модуль 4',
            'title' => 'Законодательные аспекты экологического движения в России',
        ]
    ];

    public $lessons = [
        [
            "module_id" => 1,
            "name" => "Урок 1",
            "title" => "Что такое экология? Глобальные экологические проблемы Цели и задачи курса",
            "desc" => "Становление экологии как науки, отрасли экологии, экологические профессии, перспективы развития, общественная деятельность\nАнализ ключевых глобальных и экологических проблем\nДеятельность движения, ценности и смыслы для экоамбассадоров\nСпикер: Георгий Каваносян, эколог, автор YouTube-канала «Сортировочная» и ведущий просветительского проекта «Кинобус ПроЭко»",
            "image" => "https://xn--80adjaaocbrwcswoeblbfe4t.xn--p1ai/wp-content/uploads/2024/12/listok-1.jpg"
        ],
        [
            "module_id" => 2,
            "name" => "Урок 2",
            "title" => "Экология и человек",
            "desc" => "Влияние экологических факторов (шум, вибрации, световое загрязнение) на здоровье человека, методы защиты и профилактики\nСпикер: Михаил Гинзбург, доктор медицинских наук, директор Самарского НИИ диетологии и диетотерапии",
            "image" => "https://xn--80adjaaocbrwcswoeblbfe4t.xn--p1ai/wp-content/uploads/2024/12/serdcze-4.jpg"
        ],
        [
            "module_id" => 2,
            "name" => "Урок 3",
            "title" => "Экологические проекты как часть КСО-стратегии бизнеса",
            "desc" => "Как бизнес выбирает экопроекты: лучшие практики и отношение к развитию экологической культуры\nСпикер: Анна Жигульская, директор проектного офиса по внутренним коммуникациям и корпоративной социальной ответственности, Росатом",
            "image" => "https://xn--80adjaaocbrwcswoeblbfe4t.xn--p1ai/wp-content/uploads/2024/12/serdcze-4.jpg"
        ],
        [
            "module_id" => 2,
            "name" => "Урок 4",
            "title" => "Мастер-планы городов по экологии",
            "desc" => "Создание мастер-планов городов с учётом экологических факторов. Подходы к устойчивому развитию. Успешные мировые примеры и их применение в российских реалиях.\nСпикер: Ольга Шкабардня, генеральный директор АНО «Энергия развития» ГК «Росатом»",
            "image" => "https://xn--80adjaaocbrwcswoeblbfe4t.xn--p1ai/wp-content/uploads/2024/12/serdcze-4.jpg"
        ],
        [
            "module_id" => 3,
            "name" => "Урок 5",
            "title" => "Как восстановление экосистем влияет на изменения климата",
            "desc" => "Изменение климата, парниковый эффект, международные соглашения и национальные стратегии по борьбе с изменением климата\nСпикер: Вадим Петров, председатель Общественного совета при Росгидромет, замдиректора единого научного центра Минприроды России «ВНИИ Экология», советник директора, старший научный сотрудник ФГБУ ГОИН имени Н.Н. Зубова Росгидромета",
            "image" => "https://xn--80adjaaocbrwcswoeblbfe4t.xn--p1ai/wp-content/uploads/2024/12/shhit-2.jpg"
        ],
        [
            "module_id" => 3,
            "name" => "Урок 6",
            "title" => "Промышленная экология",
            "desc" => "Экологические аспекты промышленного производства, технологии снижения загрязнения, экологический мониторинг промышленных предприятий\nСпикер: Павел Степанян, эколог-эксперт, сооснователь и исполнительный директор группы компаний «ЭкоЛайф»",
            "image" => "https://xn--80adjaaocbrwcswoeblbfe4t.xn--p1ai/wp-content/uploads/2024/12/shhit-2.jpg"
        ],
        [
            "module_id" => 3,
            "name" => "Урок 7",
            "title" => "Экономика замкнутого цикла: как это работает и при чём тут РОП?",
            "desc" => "Переработка отходов, использование вторичных материалов, опыт работы экоцентров\nСпикер: Гусен Ибрагимов, заместитель руководителя департамента РОП РЭО",
            "image" => "https://xn--80adjaaocbrwcswoeblbfe4t.xn--p1ai/wp-content/uploads/2024/12/list-krug-3.jpg"
        ],
        [
            "module_id" => 3,
            "name" => "Урок 8",
            "title" => "Навигатор трендов будущего для молодежи: взгляд 360 градусов сквозь призму мировых форсайтов и анализа больших данных (Экология будущего)",
            "desc" => "Экологические вызовы современности и будущие сценарии развития с использованием методов прогнозирования и форсайта\nСпикер: Александр Чулок, директор Центра научно-технологического прогнозирования Института статистических исследований и экономики знаний НИУ ВШЭ",
            "image" => "https://xn--80adjaaocbrwcswoeblbfe4t.xn--p1ai/wp-content/uploads/2024/12/list-krug-3.jpg"
        ],
        [
            "module_id" => 4,
            "name" => "Урок 9",
            "title" => "Общественно-экологический контроль",
            "desc" => "Гражданская активность, механизмы контроля, взаимодействие с государственными органами\nСпикер: Андрей Нагибин, российский общественный деятель, эколог, лидер движения «Зелёный патруль», лидер Российской экологической партии",
            "image" => "https://xn--80adjaaocbrwcswoeblbfe4t.xn--p1ai/wp-content/uploads/2024/12/shhit-2.jpg"
        ],
        [
            "module_id" => 4,
            "name" => "Урок 10",
            "title" => "«Зелёная» дипломатия и законодательное регулирование",
            "desc" => "Международное сотрудничество (зеленая дипломатия), законодательное регулирование в области экологии\nСпикер: Николай Доронин, первый заместитель председателя комиссии Об...",
            "image" => "https://xn--80adjaaocbrwcswoeblbfe4t.xn--p1ai/wp-content/uploads/2024/12/shhit-2.jpg"
        ]
    ];

    public function makeModules()
    {
        foreach ($this->modules as $var) {
            Module::create([
                'name' => $var['name'],
                'title' => $var['title'],
            ]);
        }
    }

    public function makeLessons()
    {
        $video =  url('/') . "/fixed/test/test_video.mp4";

        foreach ($this->lessons as $var) {
            $lesson = Lesson::create([
                'module_id' => $var['module_id'],
                'name' => $var['name'],
                'title' => $var['title'],
                'desc' => $var['desc'],
            ]);
            $lesson->addMedia($video)->preservingOriginal()->toMediaCollection('video');
        }
    }
    public function run(): void
    {

        Role::create(['name' => 'admin']);
        Role::create(['name' => 'user']);

        $user = User::create([
            'name' => 'admin',
            'email' => 'admin@mail.ru',
            'email_verified_at' => now(),
            'password' => Hash::make('12345678'),
            'remember_token' => Str::random(10),
        ]);
        $user->assignRole('admin');

        $this->makeModules();
        $this->makeLessons();


    }
}
