<?php

namespace App\Mail;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Attachment;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class CheckStudentEnterTime extends Mailable
{
    use Queueable, SerializesModels;
    private User $student;

    /**
     * Create a new message instance.
     */
    public function __construct(User $student)
    {
        $this->student = $student;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Late Student Notification ' . $this->student->name,
            cc: [
                'school-admin@uni.edu'
            ]
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.late-student-notification',
            with: [
                'student' => $this->student
            ],
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [
            Attachment::fromPath(public_path('pass-fail.jpg'))
                        ->withMime('image/jpeg')
                        ->as('img.jpg')
        ];
    }
}
