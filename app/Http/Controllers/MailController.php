<?php


namespace App\Http\Controllers;

use App\Mail\EmailFormUsed;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class MailController extends Controller
{
    /**
     * Sends a mail
     *
     * @return string
     */
    public function sendToChristophStach(Request $request)
    {
        try {
            if (!$request->has('from') || !$request->has('subject') || !$request->has('message')) {
                throw new \Exception('Not all required fields were provided!');
            } else {
                $from = $request->input('from');
                $subject = $request->input('subject');
                $message = $request->input('message');

                if (!$from || !$subject || !$message) {
                    throw new \Exception('Some fields are empty!');
                }

                $email = new EmailFormUsed($from, $subject, $message);
                Mail::to('christoph.stach@gmail.com')
                    ->send($email);

                return response()->json(['data' => [
                    'from' => $from,
                    'subject' => $subject,
                    'message' => $message
                ]], 200);
            }
        } catch (\Exception $exception) {
            return response()->json(['exception' => [
                'type' => get_class($exception),
                'code' => $exception->getCode(),
                'message' => $exception->getMessage()
            ]], 500);
        }
    }
}