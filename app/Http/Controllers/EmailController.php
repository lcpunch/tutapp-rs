<?php

namespace App\Http\Controllers;

use App\Calendar;
use App\Mail\TesteEmail;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class EmailController extends Controller
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('send');
    }

    public function send(Request $request)
    {
        $sender = User::find($request->input('student_id'));
        $receiver = User::find($request->input('tutor_id'));
        $calendar = Calendar::find($request->input('id_calendar'));

        $title = $request->input('title');
        $content = $request->input('content');

        Mail::send('emails.send', ['title' => $title,
            'content' => $content,
            'hrstart' => $calendar['hrstart'],
            'hrfinish'=> $calendar['hrfinish'],
            'student_name' => $sender['name'],
            'tutor_name' => $receiver['name']
        ],
            function ($message)
            use ($sender, $request, $receiver, $calendar)
        {

            $message->from($sender->email, $sender->name);
            $message->to($receiver->email);

        });


        return response()->json(['message' => 'Request completed']);
    }
}
