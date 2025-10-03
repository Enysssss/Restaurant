<?php
namespace App\Notifications;

use App\Models\Dish;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class DishLiked extends Notification
{
    use Queueable;

    protected $dish;
    protected $user;

    public function __construct(Dish $dish, $user)
    {
        $this->dish = $dish;
        $this->user = $user;
    }

    public function via($notifiable)
    {
        return ['mail', 'database']; //mAil et bdd
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->line('Votre plat "' . $this->dish->name . '" a été aimé par ' . $this->user->name . '.')
                    ->action('Voir le plat', url('/dishes/'.$this->dish->id))
                    ->line('Merci d\'utiliser notre application!');
    }

    public function toArray($notifiable)
    {
        return [
            'dish_name' => $this->dish->name,
            'user_name' => $this->user->name,
            'dish_id' => $this->dish->id,
        ];
    }
}
