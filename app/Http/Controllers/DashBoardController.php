<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use DB;

class DashBoardController extends Controller
{

    // fetch data from database start
        public function cstDeal()
            {
                $list_cst = DB::select('select * from customers');
                $count_cst = DB::table('customers')->count();
                $count_deal = DB::table('deals')->count();

                $cst_deal_count  = array();
                $cst_deal_count['Customers'] = $count_cst;
                $cst_deal_count['Sales'] = $count_deal;

                $deal_new_count = DB::table('deals')
                ->where('deal_status', 'New Deal')
                ->count();

                $deal_in_progress_count = DB::table('deals')
                ->where('deal_status', 'In Progress')
                ->count();

                $deal_final_count = DB::table('deals')
                ->where('deal_status', 'Final')
                ->count();
       


                //return values
                return ['list_cst'=>$list_cst,
                'count_cst'=>$count_cst , 
                'count_deal'=>$count_deal,
                'cst_deal_count'=>$cst_deal_count,
                'deal_new_count'=>$deal_new_count,
                'deal_in_progress_count'=>$deal_in_progress_count,
                'deal_final_count'=>$deal_final_count,
                
                ];                        
            }

        public function cstDealDash()
        {
            

            $deal_new_count = DB::table('deals')
            ->where('deal_status', 'New Deal')
            ->count();

            $deal_in_progress_count = DB::table('deals')
            ->where('deal_status', 'In Progress')
            ->count();

            $deal_final_count = DB::table('deals')
            ->where('deal_status', 'Final')
            ->count();
    


            //return values
            return [
            'deal_new_count'=>$deal_new_count,
            'deal_in_progress_count'=>$deal_in_progress_count,
            'deal_final_count'=>$deal_final_count,
            
            ];                        
        }
    // fetch data from database end

}
