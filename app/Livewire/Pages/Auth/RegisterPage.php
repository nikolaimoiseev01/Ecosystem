<?php

namespace App\Livewire\Pages\Auth;

use App\Models\User;
use CooperAV\SmsAero\SmsAero;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Livewire\Component;
use Illuminate\Validation\Rules;

class RegisterPage extends Component
{
    public string $name = '';
    public string $surname = '';
    public string $thirdname = '';
    public string $birth_dt = '';
    public string $login = '';
    public string $email = '';
    public string $password = '';
    public string $telegram = '';
    public string $type_of_activity = '';
    public string $eco_part = '';
    public string $workplace = '';
    public string $volunteer_experience = '';
    public string $telephone = '';
    public string $password_confirmation = '';

    public $sms_code_sent = False;
    public $sms_code_input;
    public $sms_code_correct;


    /**
     * Handle an incoming registration request.
     */

    public array $types_of_activity = [
        [
            'id' => 1,
            'name' => 'Студент',
        ],
        [
            'id' => 2,
            'name' => 'Наемный сотрудник',
        ],
        [
            'id' => 3,
            'name' => 'Пенсионер',
        ]
    ];

    public array $volunteer_exps = [
        [
            'id' => 1,
            'name' => 'Да, в НКО',
        ],
        [
            'id' => 2,
            'name' => 'Да, в Движении "Экосистема',
        ],
        [
            'id' => 3,
            'name' => 'Да, в студенческом экологическом клубе',
        ],
        [
            'id' => 4,
            'name' => 'Нет, не состою',
        ]
    ];

    public function render()
    {
        return view('livewire.pages.auth.register-page');
    }


    public function register(): void
    {

        $validated = $this->validate([
            'login' => ['required', 'string', 'lowercase', 'max:255', 'unique:' . User::class],
            'password' => ['required', 'string', 'confirmed', Rules\Password::defaults()],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
            'name' => ['required', 'string', 'max:255'],
            'surname' => ['required', 'string', 'max:255'],
            'thirdname' => ['required', 'string', 'max:255'],
            'birth_dt' => ['required', 'string'],
            'telegram' => ['required', 'string', 'max:255'],
            'type_of_activity' => ['required', 'string', 'max:255'],
            'eco_part' => ['required', 'string', 'max:255'],
            'workplace' => ['required', 'string', 'max:255'],
            'volunteer_experience' => ['required', 'string', 'max:255'],
            'telephone' => ['required', 'string', 'max:255'],
        ]);

        if (!($this->sms_code_sent)) {
            $validator = Validator::make([], []); // Создаем экземпляр валидатора
            $validator->errors()->add('telephone', 'Пройдите верификацию по смс.'); // Добавляем ошибку
            throw new \Illuminate\Validation\ValidationException($validator); // Бросаем исключение
        }

        /* Если правильного еще нет, или правильный есть, но не подходит */
        if (!($this->sms_code_correct ?? null) || (($this->sms_code_correct ?? null) && intval($this->sms_code_input) !== $this->sms_code_correct)) {
            $validator = Validator::make([], []); // Создаем экземпляр валидатора
            $validator->errors()->add('telephone', 'Код неверный'); // Добавляем ошибку
            throw new \Illuminate\Validation\ValidationException($validator); // Бросаем исключение
        }

        $validated['password'] = Hash::make($validated['password']);

        event(new Registered($user = User::create($validated)));

        Auth::login($user);

        $user->assignRole('user');

        $this->redirect(route('account.courses'), navigate: true);
    }

    public function getSms() {
//        // Create SmsAero instance.
//        $oSMSAero = new SmsAero(ENV('SMSAERO_LOGIN'),ENV('SMSAERO_API_KEY'));
////        dd($oSMSAero);
//        // We can use it with config file f.e.
//        // config('smsaero.login') and config('smsaero.api_key')
//
//        // Set receiver's phone number.
//        $phone_number = $this->telephone;
//
//        // Set message content.
//        $message = 'SMS Aero';
//
//        // Sending channels.
//        $type = 'DIRECT'; // In docuimentation describe other types.
//        // To send message to another countries need use 'INTERNATIONAL' type.
//
//        // Send message.
//        $response = $oSMSAero->send($phone_number, $message, $type);
//
//        // Default response data -> json. However we can get response in XML format.
        $this->sms_code_correct = 9999;
        $this->sms_code_sent = True;
    }

    public function checkSmsCode(){
    }
}
