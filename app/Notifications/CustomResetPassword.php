<?php

namespace App\Notifications;

use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Notifications\Messages\MailMessage;

class CustomResetPassword extends ResetPassword
{
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Restablecer contraseña - NowStyleVZT')
            ->greeting('¡Hola!')
            ->line('Recibiste este correo porque solicitaste restablecer tu contraseña.')
            ->action('Restablecer contraseña', url('/reset-password/'.$this->token.'?email='.$notifiable->email))
            ->line('Este enlace expira en 60 minutos.')
            ->line('Si no fuiste tú, ignora este mensaje.')
            ->salutation('NowStyleVZT');
    }
}