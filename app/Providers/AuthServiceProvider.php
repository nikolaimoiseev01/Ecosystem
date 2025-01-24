<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Support\Facades\Lang;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        //
    ];


    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        ResetPassword::toMailUsing(function ($notifiable, $token) {
            return (new MailMessage)
                ->subject(Lang::get('Восстановление пароля'))
                ->greeting('Здравствуйте!')
                ->line(Lang::get('Вы получили это письмо, поскольку мы получили запрос на сброс пароля для вашей учетной записи.'))
                ->action(Lang::get('Сбросить пароль'), route('password.reset', $token))
                ->line(Lang::get('Ссылка перестанет работать через минут: :count.', ['count' => config('auth.passwords.' . config('auth.defaults.passwords') . '.expire')]))
                ->line(Lang::get('Если вы не запрашивали сброс пароля, никаких дальнейших действий не требуется.'))
                ->salutation('С уважением, ' . config('app.name'))
                ;
        });
    }
}
