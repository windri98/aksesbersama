<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\Request;
use App\Models\NotificationSetup;

class NotificationSetupController extends Controller
{
    public function saveDevice(Request $request, $website = '')
    {
        try {
            if ($website === '') {
                $website = 'others';
            }
            
            $token = $request->validate([
                'expoToken' => 'required|string'
            ]);

            $adaNih = NotificationSetup::where('token', $token['expoToken'])->first();

            if ($adaNih) {
                return response()->json([
                    'status' => 'success',
                    'message' => 'Device token already saved',
                ]);
            } else {
                NotificationSetup::create([
                    'token' => $token['expoToken'],
                    'website' => $website,
                    'device' => 'random',
                ]);
    
                return response()->json([
                    'status' => 'success',
                    'message' => 'Device token has been registered'
                ]);
            }
    
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage(),
            ]);
        }
    }

    public function notification(Request $request)
    {

        $request->validate([
            'title' => 'required|string',
            'body' => 'required|string',
            'send_from' => 'string',
        ]);
        
        if($request->send_from === 'api') {

            $deviceToken = NotificationSetup::pluck('token')->toArray();
    
            $title = $request->input('title');
            $body = $request->input('body');
    
            $responses = [];
            $errors = [];
    
            $client = new Client();
            $url = 'https://exp.host/--/api/v2/push/send';
            
            foreach ($deviceToken as $token) {
                try {
                    $response = $client->post($url, [
                        'json' => [
                            'to' => $token,
                            'title' => $title,
                            'body' => $body,
                            'sound' => 'default',
                        ],
                    ]);
        
                    $responses[] = [
                        'token' => $token,
                        'response' => json_decode($response->getBody(), true),
                    ];
                } catch (\Exception $e) {
                    $errors[] = [
                        'token' => $token,
                        'error' => $e->getMessage(),
                    ];
                }
            }
    
            return response()->json([
                'success' => true,
                'responses' => $responses,
                'errors' => $errors,
            ]);
        } else {
            $deviceToken = NotificationSetup::pluck('token')->toArray();
    
            $title = $request->input('title');
            $body = $request->input('body');
    
            $responses = [];
            $errors = [];
    
            $client = new Client();
            $url = 'https://exp.host/--/api/v2/push/send';
            
            foreach ($deviceToken as $token) {
                try {
                    $response = $client->post($url, [
                        'json' => [
                            'to' => $token,
                            'title' => $title,
                            'body' => $body,
                            'sound' => 'default',
                        ],
                    ]);
        
                    $responses[] = [
                        'token' => $token,
                        'response' => json_decode($response->getBody(), true),
                    ];
                } catch (\Exception $e) {
                    $errors[] = [
                        'token' => $token,
                        'error' => $e->getMessage(),
                    ];
                }
            }

            return redirect()->back()->with('success', 'berhasil kirim notifikasi');
        }
    }

    public function oneDeviceNotification(Request $request, $token)
    {
        return $request;
        $request->validate([
            'title' => 'required|string',
            'body' => 'required|string',
        ]);

        $client = new Client();
        $url = 'https://exp.host/--/api/v2/push/send';
        return $token;
        try {
            $response = $client->post($url, [
                'json' => [
                    'to' => $token,
                    'title' => $request->title,
                    'body' => $request->body,
                    'sound' => 'default',
                ],
            ]);

            $response = [
                'token' => $token,
                'response' => json_decode($response->getBody(), true),
            ];

            return response()->json($response);
        } catch (\Exception $e) {
            $errors = [
                'token' => $token,
                'error' => $e->getMessage(),
            ];

            return response()->json($errors);
        }
    }

}
