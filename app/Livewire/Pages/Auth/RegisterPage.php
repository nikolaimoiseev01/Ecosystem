<?php

namespace App\Livewire\Pages\Auth;

use App\Models\User;
use CooperAV\SmsAero\SmsAero;
use DateTime;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Livewire\Component;
use Illuminate\Validation\Rules;
use App\Helpers\Geo;

class RegisterPage extends Component
{
    public string $name = '';
    public string $surname = '';

    public $countries;
    public string $country = 'Россия';
    public $regions;

    public $region = 'Московская область';
    public string $thirdname = '';
    public string $birth_dt = '';
    public string $login = '';
    public string $email = '';
    public string $password = '';
    public string $telegram = '';
    public string $type_of_activity = 'Студент';
    public string $eco_part = 'Да, в НКО';
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
            'id' => 'Студент',
            'name' => 'Студент',
        ],
        [
            'id' => 'Наемный сотрудник',
            'name' => 'Наемный сотрудник',
        ],
        [
            'id' => 'Пенсионер',
            'name' => 'Пенсионер',
        ],
        [
            'id' => 'Самозанятый',
            'name' => 'Самозанятый',
        ],
        [
            'id' => 'Индивидуальный предприниматель',
            'name' => 'Индивидуальный предприниматель',
        ],
        [
            'id' => 'Не работающий',
            'name' => 'Не работающий',
        ],
        [
            'id' => 'Другое',
            'name' => 'Другое',
        ]
    ];

    public array $eco_parts = [
        [
            'id' => 'Да, в НКО',
            'name' => 'Да, в НКО',
        ],
        [
            'id' => 'Да, в Движении "Экосистема',
            'name' => 'Да, в Движении "Экосистема',
        ],
        [
            'id' => 'Да, в студенческом экологическом клубе',
            'name' => 'Да, в студенческом экологическом клубе',
        ],
        [
            'id' => 'Нет, не состою',
            'name' => 'Нет, не состою',
        ]
    ];


    public function render()
    {
        return view('livewire.pages.auth.register-page');
    }

    public function mount()
    {
        $this->countries = Geo::countries();

        $this->regions = Geo::regions();

        usort($this->countries, function ($a, $b) {
            return strcmp($a['name'], $b['name']);
        });

        usort($this->regions, function ($a, $b) {
            return strcmp($a['name'], $b['name']);
        });
    }

    public function isOlderThan18($birthDate) {
        $dateOfBirth = new DateTime($birthDate);
        $currentDate = new DateTime();
        $age = $dateOfBirth->diff($currentDate)->y;

        return $age >= 18;
    }

    public function register(): void
    {

        $this->region = $this->country == 'Россия' ? $this->region : null;


        $validated = $this->validate([
            'login' => ['required', 'string', 'lowercase', 'max:255', 'unique:' . User::class],
            'password' => ['required', 'string', 'confirmed', Rules\Password::defaults()],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
            'country' => ['required', 'string', 'max:455'],
            'region' => ['max:255'],
            'name' => ['required', 'string', 'max:255'],
            'surname' => ['required', 'string', 'max:255'],
            'thirdname' => ['required', 'string', 'max:255'],
            'birth_dt' => ['required', 'string'],
            'telegram' => ['required', 'string', 'max:255'],
            'type_of_activity' => ['required', 'string', 'max:255'],
            'eco_part' => ['required', 'string', 'max:255'],
            'workplace' => ['required', 'string', 'max:255'],
            'volunteer_experience' => ['required', 'string'],
            'telephone' => ['required', 'string', 'max:255'],
        ]);

        $isAdult = $this->isOlderThan18($this->birth_dt);


        $validator = Validator::make([], []); // Создаем экземпляр валидатора

        if (!$isAdult) {
            $validator->errors()->add('birth_dt', 'Вы должны быть старше 18-ти лет.'); // Добавляем ошибку
            throw new \Illuminate\Validation\ValidationException($validator); // Бросаем исключение
        }

        /* Если правильного еще нет, или правильный есть, но не подходит */
        if (!($this->sms_code_correct ?? null) || (($this->sms_code_correct ?? null) && strval($this->sms_code_input) !== $this->sms_code_correct)) {
            $validator->errors()->add('telephone', 'Код неверный'); // Добавляем ошибку
            throw new \Illuminate\Validation\ValidationException($validator); // Бросаем исключение
        }

        if (!($this->sms_code_sent)) {
            $validator->errors()->add('telephone', 'Пройдите верификацию по смс.'); // Добавляем ошибку
            throw new \Illuminate\Validation\ValidationException($validator); // Бросаем исключение
        }

        $validated['password'] = Hash::make($validated['password']);

        event(new Registered($user = User::create($validated)));

        Auth::login($user);

        $user->assignRole('user');

        $this->redirect(route('account.courses'), navigate: true);
    }

    public function getSms()
    {

        if (ENV('APP_DEBUG')) {
            $this->sms_code_correct = strval(9999);
        } else {
            $digits = 4;
            $this->sms_code_correct = str_pad(rand(0, pow(10, $digits) - 1), $digits, '0', STR_PAD_LEFT);

            // Create SmsAero instance.
            $oSMSAero = new SmsAero(ENV('SMSAERO_LOGIN'), ENV('SMSAERO_API_KEY'));

            // Set receiver's phone number.
            $phone_number = $this->telephone;

            // Set message content.
            $message = 'Экосистема. Код подтверждения: ' . $this->sms_code_correct;

            // Sending channels.
            $type = 'DIRECT'; // In docuimentation describe other types.
            // To send message to another countries need use 'INTERNATIONAL' type.

            // Send message.
            $response = $oSMSAero->send($phone_number, $message, $type);
        }

        // Default response data -> json. However we can get response in XML format.
        $this->sms_code_sent = True;
    }

}
