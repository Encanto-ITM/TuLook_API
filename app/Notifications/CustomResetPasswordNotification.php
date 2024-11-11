<?php

namespace App\Notifications;

use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class CustomResetPasswordNotification extends Notification
{
    protected $url;

    public function __construct($url)
    {
        $this->url = $url;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->greeting('Hola ' . $notifiable->name)
            ->subject('Restablecimiento de Contraseña')
            ->line('Estás recibiendo este correo porque solicitaste un restablecimiento de contraseña.')
            ->line('Este enlace de restablecimiento expirará en 60 minutos.')
            ->action('Restablecer Contraseña', $this->url)
            ->line('Si no solicitaste este restablecimiento, ignora este correo.')
            ->salutation('Atentamente, El equipo de TuLook');
    }
}
