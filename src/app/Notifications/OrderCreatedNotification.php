<?php

namespace App\Notifications;

use App\Containers\Order\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class OrderCreatedNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct(public Order $order)
    {
        //
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail', 'database'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('Заказ успешно оформлен!')
            ->greeting("Здравствуйте, {$notifiable->name}!")
            ->line('Ваш заказ был успешно создан.')
            ->line("Номер заказа: #{$this->order->id}")
            ->line("Статус: {$this->order->status}")
            ->line("Общая сумма: {$this->order->total_price} руб.")
            ->action('Посмотреть заказ', url("/orders/{$this->order->id}"))
            ->line('Спасибо за ваш заказ!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'order_id' => $this->order->id,
            'message' => 'Ваш заказ успешно создан',
            'total_price' => $this->order->total_price,
            'status' => $this->order->status,
        ];
    }
}
