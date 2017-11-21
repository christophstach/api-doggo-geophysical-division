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
        header('Access-Control-Allow-Origin: http://localhost:4200');
        $headers = [
            'Access-Control-Allow-Origin' => 'http://localhost:4200',
            'test' => 'test123'
        ];
        try {
            $from = $request->input('from');
            $subject = $request->input('subject');
            $message = $request->input('message');

            if (!$from || !$subject || !$message) {
                throw new \Exception('Not all required fields were provided!');
            }

            $email = new EmailFormUsed($from, $subject, $message);
            Mail::to('christoph.stach@gmail.com')->send($email);

            return response()->json(['data' => [
                'from' => $from,
                'subject' => $subject,
                'message' => $message
            ]], 200, $headers);
        } catch (\Exception $exception) {
            return response()->json(['exception' => [
                'type' => get_class($exception),
                'code' => $exception->getCode(),
                'message' => $exception->getMessage()
            ]], 500, $headers);
        }
    }
}