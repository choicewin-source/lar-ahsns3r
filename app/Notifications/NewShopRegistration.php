<?php

namespace App\Notifications;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewShopRegistration extends Notification implements ShouldQueue
{
    use Queueable;

    public function __construct(
        public User $shopOwner
    ) {}

    /**
     * Get the notification's delivery channels.
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
            ->subject('طلب تسجيل متجر جديد')
            ->greeting('مرحباً ' . $notifiable->name . ',')
            ->line('تم تسجيل متجر جديد يحتاج إلى موافقتك.')
            ->line('**اسم المتجر:** ' . $this->shopOwner->shop_name)
            ->line('**المدينة:** ' . $this->shopOwner->shop_city)
            ->line('**رقم الهاتف:** ' . ($this->shopOwner->shop_phone ?? 'غير محدد'))
            ->action('مراجعة الطلب', route('admin.dashboard'))
            ->salutation('مع تحيات نظام أحسن سعر');
    }

    /**
     * Get the array representation of the notification.
     */
    public function toArray(object $notifiable): array
    {
        return [
            'title' => 'طلب تسجيل متجر جديد',
            'message' => 'متجر جديد: ' . $this->shopOwner->shop_name,
            'type' => 'new_shop_registration',
            'shop_id' => $this->shopOwner->id,
        ];
    }
}