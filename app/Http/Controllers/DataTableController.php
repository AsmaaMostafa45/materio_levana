<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use DB;

class DataTableController extends Controller
{
    
    // insert data to database fnc start 
        public function getDataTableFn(Request $request)
            {
                $cst_name = $request->input('name_cst');
                $cst_email = $request->input('email_cst');
                $cst_date = $request->input('date_cst');
                $cst_phone_code = $request->input('phone_code_cst');
                $cst_phone_no = $request->input('phone_no_cst');
                $cst_age = $request->input('age_cst');
                $cst_status = $request->input('status_cst');
                $cst_notes = $request->input('notes_cst');

                    $data = array(
                        "cst_name" => $cst_name,
                        "cst_email" => $cst_email,
                        "cst_date" => $cst_date,
                        "cst_phone_code" => $cst_phone_code,
                        "cst_phone_no" => $cst_phone_no,
                        "cst_age" => $cst_age,
                        "cst_status" => $cst_status,
                        "cst_notes" => $cst_notes,   
                    );

                DB::table('customers')
                ->insert($data);
                
                return [$request->name, $request->email];
            }
    // insert data to database fnc end 

    // edit data in database start
    public static function editCst(Request $request, $id)
    {
        echo "from edit";
        echo "'<script>console.log(\"$id\")</script>'";
        $cst_name = $request->input('name_cst');
        $cst_name = $request->input('name_cst');
        $cst_email = $request->input('email_cst');
        $cst_date = $request->input('date_cst');
        $cst_phone_code = $request->input('phone_code_cst');
        $cst_phone_no = $request->input('phone_no_cst');
        $cst_age = $request->input('age_cst');
        $cst_status = $request->input('status_cst');
        $cst_notes = $request->input('notes_cst');

        $data = array(
            "cst_name" => $cst_name,
            "cst_email" => $cst_email,
            "cst_date" => $cst_date,
            "cst_phone_code" => $cst_phone_code,
            "cst_phone_no" => $cst_phone_no,
            "cst_age" => $cst_age,
            "cst_status" => $cst_status,
            "cst_notes" => $cst_notes,    
        );
        DB::table('customers')
        ->where('cst_id', $id)
        ->update($data);
    }
    // edit data in database end

    // delete from database start
    public static function deleteData($id)
    {
        DB::table('customers')
        ->where('cst_id', '=', $id)
        ->delete();
    }
    //delete from database end 

    // fetch data from database start
        public function listCst()
            {
                $list_cst = DB::select('select * from customers');
                $count_cst = DB::table('customers')->count();
                return ['list_cst'=>$list_cst, 'count_cst'=>$count_cst];                        
            }
    // fetch data from database end

}
