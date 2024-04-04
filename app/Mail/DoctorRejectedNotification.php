<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class DoctorRejectedNotification extends Mailable
{
    use Queueable, SerializesModels;
    public $doctor;
    /**
     * @param  \App\Models\Doctor $doctor
     * @return void
     * Create a new message instance.
     */
    public function __construct($doctor)
    {
        $this->doctor = $doctor;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Doctor Rejected Notification',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            markdown: 'emails.doctor_rejected',
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
        return $this->from('zohaibzuh121@gmail.com', 'clinvio')
        ->replyTo($this->doctor->Email)
        ->subject('Doctor Rejected Notification')
        ->view('emails.doctor_rejected')
        ->with('doctorName', $this->doctor->Name);
    }
}
