<?php

namespace App\Livewire\Components;

use App\Models\Journalist;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Livewire\Component;

class JournalistRegister extends Component
{
    public $smi_name;
    public $fio;
    public $position;
    public $telephone;
    public $comment;
    public $devices;

    public function render()
    {
        return view('livewire.components.journalist-register');
    }

    public function register() {
        $exists = Journalist::where('smi_name', $this->smi_name)
            ->where('fio', $this->fio)
            ->exists();

        if ($exists) {
            $validator = Validator::make([], []); // Создаем пустой валидатор
            $validator->errors()->add('fio', 'Такой журналист уже зарегистрирован.');
            throw new ValidationException($validator);
        }

        Journalist::create([
            'smi_name' => $this->smi_name,
            'fio' => $this->fio,
            'telephone' => $this->telephone,
            'position' => $this->position,
            'comment' => $this->comment,
            'devices' => $this->devices
        ]);

        $this->dispatch('swal:modal',
            title: 'Успешно',
            type: 'success',
            text: "Регистрация прошла успешно",
        );
    }
}
