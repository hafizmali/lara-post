<?php


use Illuminate\Support\Facades\Storage;

function getVideo($path) {
    $response =  asset('storage/'.$path);
 //   $response = Storage::disk('public')->get($path);
   // $response = Response::make($response, 200);
  //  $response->header('Content-Type', 'video/mp4');

    return $response;
}
