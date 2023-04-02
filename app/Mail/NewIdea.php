<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\Ideas;
use App\Models\User;
use Illuminate\Support\Facades\Mail;

class NewIdea extends Mailable
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
     * @var Ideas
     */
    public $idea;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(User $user, Ideas $idea)
    {
        $this->user = $user;
        $this->idea = $idea;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('systemmanager2002@gmail.com')
            ->subject('New idea has been created')
            ->view('emails.new-idea');
    }
}
