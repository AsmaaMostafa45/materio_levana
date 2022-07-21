<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class DealsController extends Controller
{
    // insert data to database fnc start 
    public function saveDeal(Request $request)
    {
        $deal_name = $request->input('name_deal');
        $deal_status = $request->input('status_deal');
        $deal_amount = $request->input('amount_deal');
        $deal_currency = $request->input('currency_deal');
        $deal_date = $request->input('date_deal');
        $deal_contact = $request->input('contact_deal');
        $deal_source = $request->input('source_deal');
        $deal_info_notes = $request->input('info_notes_deal');

            $data = array(
                "deal_name" => $deal_name,
                "deal_status" => $deal_status,
                "deal_amount" => $deal_amount,
                "deal_currency" => $deal_currency,
                "deal_date" => $deal_date,
                "deal_contact" => $deal_contact,
                "deal_source" => $deal_source,
                "deal_info_notes" => $deal_info_notes,   
            );

        DB::table('deals')
        ->insert($data);
    }
    // insert data to database fnc end 

    // fetch data from database start
    public function fetchDealsContact()
    {          
        $list_deal = DB::select('select * from deals');
        $list_deal_new = DB::select('select * from deals WHERE deal_status="New Deal"');
        $list_deal_in_progress = DB::select('select * from deals WHERE deal_status="In Progress"');
        $list_deal_final = DB::select('select * from deals WHERE deal_status="Final"');
        $contact_cst = DB::select('select cst_name from customers');
        return ['list_deal'=>$list_deal,
                'list_deal_new'=>$list_deal_new,
                'list_deal_in_progress'=>$list_deal_in_progress,
                'list_deal_final'=>$list_deal_final,
                'contact_cst'=>$contact_cst];                        
    }
    // fetch data from database end

}