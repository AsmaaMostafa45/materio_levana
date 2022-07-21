<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class DealsController extends Controller
{
//     public function someMethod(Request $request)
// {
//     $cst_name = $request->input('name');
//     $cst_email = $request->input('email');

//         $data = array(
         
//             "cst_name" => $cst_name,
//             "cst_email" => $cst_email,
            
//         );

//     DB::table('customers')->insert($data);
    
//     return [$request->name, $request->email];
// }

        // public function list()
        //     {
        //         return response()->json([
        //             'users' => ['asmaa','mohamed','ahmed','mahdy']
        //         ], Response::HTTP_OK);
                
        //     }

            public function list()
            {
                    $users = DB::select('select * from customers');
                    return ['users'=>$users];
                    
                    // echo $users;
                                    
            }


            // $result = DB::table('table')
            // ->select('column')
            // ->where('id', 1)
            // ->first();


            // To access the column, you would then do

            // $result->column; 


            // The following can also be a decent alternative:

            // $variable = DB::table('table')
            //     ->where('id', 1)
            //     ->value('column'); // The value is returned directly. 
            // Now, in your first case:

            // $results = DB::table('nametable')
            //     ->get();


            // foreach($results as $result) {
            //     echo $result->column; // for example
            // }


}


    // echo '<script>console.log("Your console from php")</script>';
    

        
        // $cst_name =$request->name;
        // $cst_email = $request->email; 

    //     echo '<script type="text/javascript">' .
    //     'console.log(' .$cst_name.');</script>';
    //    echo "'<script>console.log(\"$cst_name\")</script>'";
    //    echo "<script>console.log('" .$cst_name . "');</script>";

    // echo "Record inserted successfully.<br/>";
     // echo '<a href = "/insert">Click Here</a> to go back.';