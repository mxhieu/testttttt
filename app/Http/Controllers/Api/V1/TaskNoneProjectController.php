<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\TMS\Entities\TaskNoneProject;
use DateTime;
use Carbon\Carbon;
class TaskNoneProjectController extends Controller
{
    public function __construct(){
        $this->TaskNoneProject = new TaskNoneProject();
    }

    public function getTaskNoneProject(Request $request){
        $data = TaskNoneProject::with(['assignUser', 'taskProcess'])->get();
        $result = [];
        foreach($data as $key => $row){
            $result[$key]['y'] = $key;
            $result[$key]['name'] = $row->name;
            $result[$key]['assignee'] = $row->assignUser->name;
            $result[$key]['start'] = strtotime($row->start_at)*1000;
            $result[$key]['end'] = strtotime($row->end_at)*1000;
            $result[$key]['completed'] = !empty($row->taskProcess->last())? $row->taskProcess->last()->complete / 100: 0;
        }
        return $result;
    }

    public function taskInWeek(){
        Carbon::setWeekStartsAt(Carbon::MONDAY);
        Carbon::setWeekEndsAt(Carbon::SUNDAY);
        $week = ["Mon" => [], "Tue" => [], "Wed" => [], "Thu" => [], "Fri" => [], "Sat" => [], "Sun" => []];
        $tasks = $this->TaskNoneProject->taskInWeek();
        foreach($tasks as $row){
            $date = new DateTime($row->start_at);
            $dayOfWeek = substr($date->format('l'),0 , 3);
            if(array_key_exists($dayOfWeek, $week)){
                array_push($week[$dayOfWeek], $row);
            }
        }
        return $week;
    }
}
