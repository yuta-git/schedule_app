<?php

namespace App\Http\Controllers;

use DB; // 追加
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
        
        if($customer->user_id !== \Auth::id()){
            return redirect('/customers');
        }

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
      
      $customer_id = $request->input('customer_id');
      
      $customer = Customer::find($customer_id);
      
      if($customer->user_id !== \Auth::id()){
            return redirect('/top');
      }
      
      // validation
      //for image ref) https://qiita.com/maejima_f/items/7691aa9385970ba7e3ed
      $this->validate($request, [
          'title' => 'required',
          'start' => 'required',
          'start_time' => 'required',
          'end' => 'required',
          'end_time' => 'required',
          'color' => 'required',
      ]);

      // 入力情報の取得
      $title = $request->input('title');
      $start = $request->input('start');
      $start_time = $request->input('start_time');
      $end = $request->input('end');
      $end_time = $request->input('end_time');
      $color = $request->input('color');

      // 入力情報をもとにデータベースに記録保存
      $customer->records()->create(['title' => $title, 'start' => $start . 'T' . $start_time, 'end' => $end . 'T' . $end_time, 'color' => $color]);

      // 顧客詳細へリダイレクト
      return redirect('/top')->with('flash_message', '記録を変更しました。');
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
      
        if($record->customer()->get()->first()->user_id !== \Auth::id()){
            return redirect('/top');
        }
      
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
      
        if($record->customer()->get()->first()->user_id !== \Auth::id()){
            return redirect('/top');
        }
        
        // validation
        //for image ref) https://qiita.com/maejima_f/items/7691aa9385970ba7e3ed
        $this->validate($request, [
            'title' => 'required',
            'start' => 'required',
            'start_time' => 'required',
            'end' => 'required',
            'end_time' => 'required',
            'color' => 'required',
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
        return redirect('/top')->with('flash_message', '記録を変更しました。');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Record  $record
     * @return \Illuminate\Http\Response
     */
    public function destroy(Record $record)
    {
      
        if($record->customer()->get()->first()->user_id !== \Auth::id()){
            return redirect('/top');
        }
      
      $customer = $record->customer()->get()->first();
      // データベースから削除
      $record->delete();
      // 顧客詳細へリダイレクト
      return redirect('/top')->with('flash_message', '記録を削除しました。');
    }
    
    // 自分の記録のカレンダー情報の取得
    public function get_calendar()
    {
        // ログインしているユーザーの顧客全記録を取得
        $records = DB::select('SELECT records.id, records.customer_id, CONCAT(CONCAT(customers.name, ": "), records.title) AS title, records.start, records.end, records.color, records.created_at, records.updated_at  FROM records JOIN customers ON records.customer_id=customers.id JOIN users ON customers.user_id=users.id WHERE users.id=?', [\Auth::id()]);
        $list = array('records' => $records);
        // 明示的に指定しない場合は、text/html型と判断される
        header("Content-type: application/json; charset=UTF-8");
        //JSONデータを出力
        echo json_encode($list);
        exit;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
     
    // カレンダーの日付欄をクリックした時に履歴・予定の新規作成画面を表示
    public function create_record_from_calendar(Request $request)
    {
        $date = $request->input('date');
        // 空のインスタンスを作成
        $record = new Record();
        $record->start = $date;
        $customers = \Auth::user()->customers()->get()->pluck('name', 'id');   
        // dd($customers);
        
        //顧客が誰もいなければ顧客作成画面へ遷移
        if(count($customers) === 0) {
          return redirect('/customers/create');
        }
        
        // view の呼び出し
        return view('records.create_record_from_calendar', compact('record', 'customers'));
    }
    
    
}
