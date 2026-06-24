<?php

namespace App\Notifications;

use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Notifications\Messages\MailMessage;

class CustomResetPassword extends ResetPassword
{
    // 🔥 Añadimos esto para que Laravel sepa que es una alerta/acción importante y pinte el botón de rojo
    public $level = 'error'; 

    public function toMail($notifiable)
    {
        $url = url(route('password.reset', [
            'token' => $this->token,
            'email' => $notifiable->getEmailForPasswordReset(),
        ], false));

        return (new MailMessage)
            ->subject('Recuperación de Contraseña - NOWSTYLE 🚀🔥')
            ->greeting('¡Hola, Team NOWSTYLE!')
            ->line('Recibiste este correo porque se solicitó restablecer la contraseña de acceso para tu cuenta en nuestra plataforma.')
            ->action('Restablecer Contraseña', $url)
            ->line('Este enlace de seguridad vencerá y expirará en un plazo de 60 minutos.')
            ->line('Si tú no solicitaste este cambio, puedes ignorar este mensaje de forma segura.')
            ->salutation('Saludos, el equipo de NOWSTYLE.');
    }
}