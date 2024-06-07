<?php

namespace App\Helper;

use App\Models\LogMails;
use Exception;
use Illuminate\Mail\Mailable;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class MailHelper
{
    public static function sendMail(Mailable $mail, $data)
    {
        try {
            Mail::to($data['to'])->send($mail);
            
            $response = [
                'status' => true,
                'contents' => $mail->render(),
            ];
        } catch(Exception $exception) {
            $response = [
                'status' => false,
                'contents' => $exception->getMessage(),
            ];
        }

        self::writeLog($data, $response);
    }

    private static function writeLog($data, $response)
    {
        $uuid = Str::uuid();

        LogMails::create([
            'account_id' => isset($data['executor']->id) ? $data['executor']->id : 0,
            'target' => $data['to'],
            'subject' => $data['subject'],
            'log_response' => $uuid,
        ]);

        $responseArr = [
            'uuid' => $uuid,
            'response' => $response,
        ];

        $string = str_replace(array("\\n", "\\r"), '', json_encode($responseArr));
        $string = preg_replace('/\s\s+/', '', $string);

        Log::channel('mail')->info($string);
    }
}