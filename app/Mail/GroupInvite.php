<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class GroupInvite extends Mailable
{
    use Queueable, SerializesModels;
    public $email;
    public $groupId;
    /**
     * Create a new message instance.
     */

    public function __construct($email, $groupId)
    {
        $this->email = $email;
        $this->groupId = $groupId;
    }



    public function build()
    {
        return $this->view('mail.group-invite')
            ->with([
                'email' => $this->email,
                'url' => config('app.url') . '/join?email=' . $this->email . '&groupId=' . $this->groupId,
            ])
            ->withSymfonyMessage(function ($message) {
                $message->embedFromPath(storage_path("app/public/icon.png"), 'banner_image');
            });
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            from: new Address('invitation@edwinsaucedo.me', 'Finance Together Invitations'),
            subject: 'Invitation to join Finance Together Group',
            bcc: [
                new Address('edwinsaucedomx@gmail.com', 'Edwin Saucedo'),
            ],
        );
    }

    /**
     * Get the message content definition.
     */


    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
