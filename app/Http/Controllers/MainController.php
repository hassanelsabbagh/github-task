<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class MainController extends Controller
{
    public function run($name){
        $events = json_decode(Http::get('https://api.github.com/users/' . $name . '/events/public'));
        $data = [];
        $score = 0;

        foreach($events as $event){
            $point = 0;
            switch($event->type){
                case 'PushEvent':
                    $point = 10;
                    break;
                case 'PullRequestEvent':
                    $point = 5;
                    break;
                case 'IssueCommentEvent':
                    $point = 4;
                    break;
                default:
                    $point = 1;
                    break;
            }
            array_push($data, [
                'type' => $event->type,
                'repository' => $event->repo->name,
                'date' => $event->created_at,
                'points' => $point
            ]);
            $score = $score + $point;
        }
        $collection = collect([]);
        $collection->put('data', $data);
        $collection->put('score', $score);
        return response()->json($collection);   
    }
}
