<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class NoteAjoutNotif extends Mailable
{
    use Queueable, SerializesModels;

    public $noteDetails;

    /**
     * Create a new message instance.
     */
    public function __construct($noteDetails)
    {
        $this->noteDetails = $noteDetails;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Note Ajout Notif',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'email.note_ajoutee',
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }

    public function build()
    {
        return $this->subject('Nouvelle note saisie')
                    ->view('email.note_ajoutee')
                    ->with('noteDetails', $this->noteDetails);
    }
}
