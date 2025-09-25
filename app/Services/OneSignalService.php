<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class OneSignalService
{
  protected $appId;
  protected $apiKey;

  public function __construct()
  {
    $this->appId = config('services.onesignal.app_id');
    $this->apiKey = config('services.onesignal.api_key');
  }

  protected function buildPayload(array $base): array
  {
    return array_merge([
      'app_id' => $this->appId,
      'android_sound' => 'notification',
      // 'small_icon' => 'ic_stat_onesignal_default',  // Nama resource icon di Android (harus ada di app)
      'android_accent_color' => '#FFFF0000',
      'android_channel_id' => 'a2419aa3-1d35-466f-917e-604f9990a5f4',
      'large_icon' => 'https://www.bankeka.co.id/assets/img/logo/logo.png',
      'data' => ['foo' => 'bar'],
    ], $base);
  }

  public function sendToPlayerId(string $playerId, string $title, string $message): array
  {
    $payload = $this->buildPayload([
      'include_player_ids' => [$playerId],
      'headings' => ['en' => $title],
      'contents' => ['en' => $message],
    ]);

    return $this->send($payload);
  }

  public function sendToExternalId(string $externalUserId, string $title, string $message): array
  {
    $payload = $this->buildPayload([
      'include_external_user_ids' => [$externalUserId],
      'headings' => ['en' => $title],
      'contents' => ['en' => $message],
    ]);

    return $this->send($payload);
  }



  public function sendToAllSubscribed(string $title, string $message): array
  {
    $payload = $this->buildPayload([
      'included_segments' => ['Active Subscriptions'],
      'headings' => ['en' => $title],
      'contents' => ['en' => $message],
    ]);

    return $this->send($payload);
  }



  protected function send(array $payload): array
  {
    $response = Http::withHeaders([
      'Authorization' => 'Basic ' . $this->apiKey,
      'Content-Type' => 'application/json',
    ])->post('https://onesignal.com/api/v1/notifications', $payload);

    return $response->json();
  }
}
