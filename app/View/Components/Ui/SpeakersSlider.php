<?php

namespace App\View\Components\Ui;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class SpeakersSlider extends Component
{
    public $speakers;

    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        $this->speakers = [
            [
                'name' => 'Александр Чулок',
                'img' => '/fixed/speakers/1.jpg',
                'desc' => 'Директор Центра научно-технологического прогнозирования Института статистических исследований и экономики знаний НИУ ВШЭ'
            ],
            [
                'name' => 'Михаил Гинзбург',
                'img' => '/fixed/speakers/2.jpg',
                'desc' => 'Доктор медицинских наук, директор Самарского НИИ диетологии и диетотерапии'
            ],
            [
                'name' => 'Анна Жигульская',
                'img' => '/fixed/speakers/3.jpg',
                'desc' => 'Директор проектного офиса по внутренним коммуникациям и корпоративной социальной ответственности, Росатом'
            ],
            [
                'name' => 'Ольга Шкабардня',
                'img' => '/fixed/speakers/4.jpg',
                'desc' => 'Генеральный директор АНО «Энергия развития» ГК «Росатом»'
            ],
            [
                'name' => 'Ангелина Грохольская',
                'img' => '/fixed/speakers/5.jpg',
                'desc' => 'Телеведущая'
            ],
            [
                'name' => 'Георгий Каваносян',
                'img' => '/fixed/speakers/6.jpg',
                'desc' => 'Эколог, автор YouTube-канала «Сортировочная» и ведущий просветительского проекта «Кинобус ПроЭко»'
            ],
            [
                'name' => 'Андрей Нагибин',
                'img' => '/fixed/speakers/7.jpeg',
                'desc' => 'Российский общественный деятель, эколог, лидер движения «Зелёный патруль», лидер Российской экологической партии'
            ],
            [
                'name' => 'Николай Доронин',
                'img' => '/fixed/speakers/8.jpg',
                'desc' => 'Первый заместитель председателя комиссии Общественной палаты Российской Федерации по экологии и устойчивому развитию'
            ],
            [
                'name' => 'Вадим Петров',
                'img' => '/fixed/speakers/9.jpg',
                'desc' => 'Председатель Общественного совета при Росгидромет, замдиректора единого научного центра Минприроды России «ВНИИ Экология», советник директора, старший научный сотрудник ФГБУ ГОИН имени Н.Н. Зубова Росгидромета'
            ],
            [
                'name' => 'Павел Степанян',
                'img' => '/fixed/speakers/10.jpg',
                'desc' => 'Эколог-эксперт, сооснователь и исполнительный директор группы компаний «ЭкоЛайф»'
            ],
            [
                'name' => 'Гусен Ибрагимов',
                'img' => '/fixed/speakers/11.jpg',
                'desc' => 'Заместитель руководителя департамента РОП РЭО'
            ]
        ];
        return view('components.ui.speakers-slider');
    }
}
