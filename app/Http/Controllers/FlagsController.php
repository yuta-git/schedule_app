<?php

namespace App\Http\Controllers;

use App\Flag;
use Illuminate\Http\Request;

class FlagsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // dd('flag_create');
        $flag = \Auth::user()->flag()->get()->first();
        // dd($flag);
        
        // まだ設定されてなければ新規作成
        if(!$flag){
            $flag = \Auth::user()->flag()->create([]);
        }

        return view('flags.create', compact('flag'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            // 'age_flag' => 'required',
            // 'birthday_flag' => 'required',
            // 'address_flag' => 'required',
            // 'hometown_flag' => 'required',
            // 'charactor_flag' => 'required',
            // 'blood_type_flag' => 'required',
            // 'occupancy_flag' => 'required',
            // 'hobby_flag' => 'required',
            // 'skill_flag' => 'required',
            // 'dayoff_flag' => 'required',
            // 'favorite_food_flag' => 'required',
            // 'dislike_food_flag' => 'required',
            // 'marriage_flag' => 'required',
            // 'children_flag' => 'required',
            // 'lover_flag' => 'required',
            // 'mail_flag' => 'required',
            // 'telphone_flag' => 'required',
            // 'company_name_flag' => 'required',
            // 'memo_flag' => 'required',

        ]);

        // dd($request);
        
        $id = $request->input('id');
        
        $age_flag = $request->input('age_flag');
        $birthday_flag = $request->input('birthday_flag');
        $address_flag = $request->input('address_flag');
        $hometown_flag = $request->input('hometown_flag');
        $charactor_flag = $request->input('charactor_flag');
        $blood_type_flag = $request->input('blood_type_flag');
        $occupancy_flag = $request->input('occupancy_flag');
        $hobby_flag = $request->input('hobby_flag');
        $skill_flag = $request->input('skill_flag');
        $dayoff_flag = $request->input('dayoff_flag');
        $favorite_food_flag = $request->input('favorite_food_flag');
        $dislike_food_flag = $request->input('dislike_food_flag');
        $marriage_flag = $request->input('marriage_flag');
        $children_flag = $request->input('children_flag');
        $lover_flag = $request->input('lover_flag');
        $mail_flag = $request->input('mail_flag');
        $telphone_flag = $request->input('telphone_flag');
        $company_name_flag = $request->input('company_name_flag');
        $memo_flag = $request->input('memo_flag');

        $flag = Flag::find($id);
        
        if($flag->user->id !== \Auth::id()){
            return rediredt('/top');
        }

        $flag->age_flag = $age_flag;
        $flag->birthday_flag = $birthday_flag;
        $flag->address_flag = $address_flag;
        $flag->hometown_flag = $hometown_flag;
        $flag->charactor_flag = $charactor_flag;
        $flag->blood_type_flag = $blood_type_flag;
        $flag->occupancy_flag = $occupancy_flag;
        $flag->hobby_flag = $hobby_flag;
        $flag->skill_flag = $skill_flag;
        $flag->dayoff_flag = $dayoff_flag;
        $flag->favorite_food_flag = $favorite_food_flag;
        $flag->dislike_food_flag = $dislike_food_flag;
        $flag->marriage_flag = $marriage_flag;
        $flag->children_flag = $children_flag;
        $flag->lover_flag = $lover_flag;
        $flag->mail_flag = $mail_flag;
        $flag->telphone_flag = $telphone_flag;
        $flag->company_name_flag = $company_name_flag;
        $flag->memo_flag = $memo_flag;

        $flag->save();

        return redirect('/customers')->with('flash_message', '顧客表示設定を保存しました');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Flag  $flag
     * @return \Illuminate\Http\Response
     */
    public function show(Flag $flag)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Flag  $flag
     * @return \Illuminate\Http\Response
     */
    public function edit(Flag $flag)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Flag  $flag
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Flag $flag)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Flag  $flag
     * @return \Illuminate\Http\Response
     */
    public function destroy(Flag $flag)
    {
        //
    }
}
