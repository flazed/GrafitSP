<?php

namespace App\Mail;

use App\Material;
use App\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class MailSend extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($order)
    {
        $this->order = $order;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $materials = [];
        $this->order->order = json_decode($this->order->order);
        foreach ($this->order->order as $v) {
            array_push($materials, Material::find($v->id));
        }

        return $this->markdown('mail.mail', [
            'materials' => $materials,
            'order'     => $this->order
        ])
            ->from('grafit.sposad@gmail.com')
            ->subject('Заказ #' . $this->order->id);
    }
}
