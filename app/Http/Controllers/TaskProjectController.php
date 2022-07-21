<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class TaskProjectController extends Controller
{
    // insert data to database fnc start 
    public function saveTask(Request $request)
    {
        $task_name = $request->input('name_task');
        $task_resp_person = $request->input('responsible_person_task');
        $task_mention_person = $request->input('mention_person_task');
        $task_date = $request->input('date_start_task');
        $task_end_date = $request->input('date_end_task');
        $task_summery = $request->input('summery_task');
        $task_sub = $request->input('sub_task');



            $data = array(
                "task_name" => $task_name,
                "task_resp_person" => $task_resp_person,
                "task_mention_person" => $task_mention_person,
                "task_date" => $task_date,
                "task_end_date" => $task_end_date,
                "task_summery" => $task_summery,
                "task_sub" => $task_sub, 
            );

        DB::table('tasks')
        ->insert($data);
    }
    // insert data to database fnc end 

    // fetch data from database start
     public function fetchUsersTask()
     {          
         $list_users = DB::select('select name from users');
         $list_sub_tasks = DB::select('select task_name from tasks');
         $list_tasks = DB::select('select * from tasks');

        //  $list_deal_new = DB::select('select * from deals WHERE deal_status="New Deal"');
        //  $list_deal_in_progress = DB::select('select * from deals WHERE deal_status="In Progress"');
        //  $list_deal_final = DB::select('select * from deals WHERE deal_status="Final"');
        //  $contact_cst = DB::select('select cst_name from customers');
         return ['list_users' => $list_users,
                 'list_sub_tasks' => $list_sub_tasks,
                 'list_tasks' => $list_tasks,
                ];                        
     }
    // fetch data from database end
}
