<?php

namespace App\Http\Controllers;

use App\Record;
use App\Customer; // 追加
use Illuminate\Http\Request;

class RecordsController extends Controller
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
    public function create(Request $request)
    {
        $customer_id = $request->input('customer_id');
        
        // dd($customer_id);
        
        $customer = Customer::find($customer_id);

        // 空のインスタンスを作成
        $record = new Record();

        // view の呼び出し
        return view('records.create', compact('record', 'customer_id', "customer"));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      // validation
      //for image ref) https://qiita.com/maejima_f/items/7691aa9385970ba7e3ed
      $this->validate($request, [
          'title' => 'required',
          'start' => 'required',
          'start_time' => 'required',
      ]);

      // 入力情報の取得
      $customer_id = $request->input('customer_id');
      $title = $request->input('title');
      $start = $request->input('start');
      $start_time = $request->input('start_time');
      $end = $request->input('end');
      $end_time = $request->input('end_time');
      $color = $request->input('color');

      // 入力情報をもとにデータベースに記録保存
      $customer = Customer::find($customer_id);
      $customer->records()->create(['title' => $title, 'start' => $start . 'T' . $start_time, 'end' => $end . 'T' . $end_time, 'color' => $color]);

      // 顧客詳細へリダイレクト
      return redirect('/customers/' . $customer->id)->with('flash_message', '記録を変更しました。');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Record  $record
     * @return \Illuminate\Http\Response
     */
    public function show(Record $record)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Record  $record
     * @return \Illuminate\Http\Response
     */
    public function edit(Record $record)
    {
      
      $customer = $record->customer()->get()->first(); 
      
      
      // view の呼び出し
      return view('records.edit', compact('record', 'customer'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Record  $record
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Record $record)
    {
        // validation
        //for image ref) https://qiita.com/maejima_f/items/7691aa9385970ba7e3ed
        $this->validate($request, [
            'title' => 'required',
            'start' => 'required',
            'start_time' => 'required',
        ]);

        // 入力情報の取得
        $title = $request->input('title');
        $start = $request->input('start');
        $start_time = $request->input('start_time');
        $end = $request->input('end');
        $end_time = $request->input('end_time');
        $color = $request->input('color');

        // 入力情報をもとにインスタンスのプロパティ変更
        $record->title = $title;
        $record->start = $start . 'T' . $start_time;
        $record->end = $end . 'T' . $end_time;
        $record->color = $color;
        

        // データベース更新
        $record->save();

        $customer = $record->customer()->get()->first();

        // 顧客詳細へリダイレクト
        return redirect('/customers/' . $customer->id)->with('flash_message', '記録を変更しました。');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Record  $record
     * @return \Illuminate\Http\Response
     */
    public function destroy(Record $record)
    {
      $customer = $record->customer()->get()->first();
      // データベースから削除
      $record->delete();
      // 顧客詳細へリダイレクト
      return redirect('/customers/' . $customer->id)->with('flash_message', '記録を削除しました。');
    }
    
    
}
