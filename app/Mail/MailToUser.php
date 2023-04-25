<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\Comments;
use App\Models\User;
use Illuminate\Support\Facades\Mail;

class MailtoUser extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * The user instance.
     *
     * @var User
     */
    public $user;

    /**
     * The idea instance.
     *
     * @var Comments
     */
    public $comment;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(User $user, Comments $comment)
    {
        $this->user = $user;
        $this->comment = $comment;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('systemmanager2002@gmail.com')
            ->subject('New comment has been created')
            ->view('emails.notify-comment');
    }
}