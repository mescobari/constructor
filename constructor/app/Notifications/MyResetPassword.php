<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

use Illuminate\Auth\Notifications\ResetPassword;


class MyResetPassword extends ResetPassword
{
    public function toMail($notifiable)
    {
        return (new MailMessage)
        ->subject('Recuperar contraseña')
        ->greeting('Buen día tenga usted')
        ->line('Estás recibiendo este correo porque hizo una solicitud de recuperación de contraseña para su cuenta.')
        ->action('Recuperar contraseña', route('password.reset', $this->token))
        ->line('Si no realizaste esta solicitud, no se requiere realizar ninguna otra acción.')
        ->line('Este enlace caducará en 60 minutos.')
        ->salutation('Saludos, '. 'SISCOR - Desarrollado por Fernando Quispe Castro');
    }


    // public function toMail($notifiable)
    // {
    //     return (new MailMessage)
    //         ->subject(Lang::get('Solicitud de restablecimiento de contraseña'))
    //         ->line(Lang::get('Hola, se solicitó un restablecimiento de contraseña para tu cuenta ' . $notifiable->getEmailForPasswordReset() . ', haz clic en el botón que aparece a continuación para cambiar tu contraseña.'))
    //         ->action(Lang::get('Cambiar contraseña'), url(config('app.url') . route('password.reset', ['token' => $this->token, 'email' => $notifiable->getEmailForPasswordReset()], false)))
    //         ->line(Lang::get('Si tu no realizaste la solicitud de cambio de contraseña, solo ignora este mensaje. '))
    //         ->line(Lang::get('Este enlace solo es válido dentro de los proximos :count minutos.', ['count' => config('auth.passwords.' . config('auth.defaults.passwords') . '.expire')]));
    // }
}
