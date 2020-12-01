<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Event;

class EventController extends Controller
{
    protected $Event;

    public function __construct(){
        $this->Event = new Event();
    }

    public function eventList(){
        try{
            $events = $this->Event->with('status')->get();
            $calendar = [];
            foreach($events as $key => $row){
                $calendar[$key]['id'] = $row->id;
                $calendar[$key]['title'] = $row->name;
                $calendar[$key]['start'] = strtotime($row->start_at)*1000;
                $calendar[$key]['end'] = strtotime($row->end_at)*1000;
                $calendar[$key]['color'] = $row->status->color;
            }
            return response()->json([
                'status' => 200,
                'msg' => 'Thành công!',
                'data' => $calendar
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 500,
                'msg' => 'internal server!',
                'data' => []
            ]);
        }
    }
}
