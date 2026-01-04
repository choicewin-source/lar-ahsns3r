<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ShopApproved extends Notification implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct()
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
            ->subject('مبروك! تم قبول متجرك في أحسن سعر 🎉')
            ->greeting('مرحباً ' . $notifiable->name . '،')
            ->line('نود إعلامك بأنه تم قبول طلب تسجيل متجرك **' . $notifiable->shop_name . '** في منصة أحسن سعر.')
            ->line('يمكنك الآن البدء في إضافة منتجاتك وعرض الأسعار للزبائن.')
            ->action('الدخول إلى لوحة التحكم', route('shop.dashboard'))
            ->line('شكراً لانضمامك إلينا ونتمنى لك التوفيق! 🚀')
            ->salutation('مع تحيات فريق أحسن سعر');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'title' => 'تم قبول متجرك',
            'message' => 'مبروك! تم قبول متجرك ' . $notifiable->shop_name . ' ويمكنك الآن البدء في إضافة منتجاتك.',
            'type' => 'shop_approved',
        ];
    }
}