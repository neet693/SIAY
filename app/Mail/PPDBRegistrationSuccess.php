<?php

namespace App\Mail;

use App\Models\Interview;
use App\Models\Student;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class PPDBRegistrationSuccess extends Mailable
{
    use Queueable, SerializesModels;

    public $student;
    public $password;
    public $interview;

    /**
     * Create a new message instance.
     */
    public function __construct(Student $student, $password, Interview $interview)
    {
        $this->student = $student;
        $this->password = "sekolahyahya*";
        $this->interview = $interview;
    }


    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'PPDB Registration Success',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            markdown: 'mail.ppdb.registration',
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
}
