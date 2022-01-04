<?php

namespace App\Http\Controllers;

use App\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CustomersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        //ログインしているユーザーの顧客一覧取得
        $customers = \Auth::user()->customers()->get();
        
        //登録順の昇順で顧客一覧を取得
        $customers = Customer::where('user_id', \Auth::id())->where('delete_flag', 0)->orderBy('created_at', 'ASC')->get();

        
        // dd($customers);

        $flag = \Auth::user()->flag()->get()->first();        
        
        // view の呼び出し
        return view('customers.index', compact('customers', 'flag'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // ログインしているユーザーの顧客一覧取得
        $customers = \Auth::user()->customers()->get();
        
        // 空の顧客インスタンス作成
        $customer = new Customer();
        // view の呼び出し
        return view('customers.create', compact('customers', 'customer'));
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
            'name' => 'required',
            'kana_name' => 'required|regex:/^[ぁ-んー]+$/u',  
            'gender' => 'required',
            'image' => [
                'file',
                'mimes:jpeg,jpg,png'
            ]
        ]);
        
        // 入力情報の取得
        $name = $request->input('name');
        $kana_name = $request->input('kana_name');
        $gender = $request->input('gender');
        $file =  $request->thumbnail;
        $age = $request->input('age');
        $birthday = $request->input('birthday');
        //誕生日が入力されているなら
        if($birthday !== null){
            $now = date("Ymd");
            $age = floor(($now - str_replace("-", "", $birthday)) / 10000);
        }
        $address = $request->input('address');
        $hometown = $request->input('hometown');
        $feature = $request->input('feature');
        $blood_type = $request->input('blood_type');
        $job = $request->input('job');
        $hobby = $request->input('hobby');
        $skill = $request->input('skill');
        $dayoff = $request->input('dayoff');
        $favorite_food = $request->input('favorite_food');
        $dislike_food = $request->input('dislike_food');
        $marriage = $request->input('marriage');
        $children = $request->input('children');
        $lover = $request->input('lover');
        $email = $request->input('email');
        $telephone = $request->input('telephone');
        $company_name = $request->input('company_name');
        $memo = $request->input('memo');
        
        // https://qiita.com/ryo-program/items/35bbe8fc3c5da1993366
        // 画像ファイルのアップロード
        // if($file){
        //     // 現在時刻ともともとのファイル名を組み合わせてランダムなファイル名作成
        //     $thumbnail = time() . $file->getClientOriginalName();
        //     // アップロードするフォルダ名取得
        //     $target_path = public_path('uploads/');
        //     // アップロード処理
        //     $file->move($target_path, $thumbnail);
        // }else{
        //     // 画像ファイルが選択されていなければ空の文字列をセット
        //     $thumbnail = '';
        // }
        
        // S3用
        if($file) {
            $path = Storage::disk('s3')->putFile('/uploads', $file, 'public');
            // パスから、最後の「ファイル名.拡張子」の部分だけ取得
            $thumbnail = basename($path);
        } else {
            // 画像ファイルが選択されていなければ空の文字列をセット
            $thumbnail = '';
        }

        
        // 入力データ値をもとに連想配列を作成
        $data = compact('name', 'kana_name', 'gender', 'thumbnail', 'age', 'birthday', 'address', 'hometown', 'feature', 'blood_type', 'job', 'hobby', 'skill', 'dayoff', 'favorite_food', 'dislike_food', 'marriage', 'children', 'lover', 'email', 'telephone', 'company_name', 'memo');
        
        // 入力情報をもとに新しいインスタンス作成
        \Auth::user()->customers()->create($data);
        
        // 顧客一覧へリダイレクト
        return redirect('/customers')->with('flash_message', '新規顧客を作成しました');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function show(Customer $customer)
    {
        
        if($customer->user_id !== \Auth::id()){
            return redirect('/customers');
        }
        
        // ログインしているユーザーの顧客一覧取得
        $customers = \Auth::user()->customers()->get();
        
        // 顧客の全記録を取得
        $records = $customer->records()->get();
        
        $flag = \Auth::user()->flag()->get()->first();
        
        //まだflagがなければ新規作成
        if(!$flag) {
            $flag = \Auth::user()->flag()->create([]);
        }
        
        // view の呼び出し
        return view('customers.show', compact('customers', 'records' , 'customer', 'flag'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function edit(Customer $customer)
    {
    
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Customer $customer)
    {
        if($customer->user_id !== \Auth::id()){
            return redirect('/customers');
        }
        // validation        
        //for image ref) https://qiita.com/maejima_f/items/7691aa9385970ba7e3ed
        $this->validate($request, [
            'name' => 'required',
            'kana_name' => 'required|regex:/^[ぁ-んー]+$/u',
            'gender' => 'required',
            'image' => [
                'file',
                'mimes:jpeg,jpg,png'
            ]
        ]);
        
        // 入力情報の取得
        $name = $request->input('name');
        $kana_name = $request->input('kana_name');
        $gender = $request->input('gender');
        $file =  $request->thumbnail;
        $age = $request->input('age');
        $birthday = $request->input('birthday');
        //誕生日が入力されているなら
        if($birthday !== null){
            $now = date("Ymd");
            $age = floor(($now - str_replace("-", "", $birthday)) / 10000);
        }
        $address = $request->input('address');
        $hometown = $request->input('hometown');
        $feature = $request->input('feature');
        $blood_type = $request->input('blood_type');
        $job = $request->input('job');
        $hobby = $request->input('hobby');
        $skill = $request->input('skill');
        $dayoff = $request->input('dayoff');
        $favorite_food = $request->input('favorite_food');
        $dislike_food = $request->input('dislike_food');
        $marriage = $request->input('marriage');
        $children = $request->input('children');
        $lover = $request->input('lover');
        $email = $request->input('email');
        $telephone = $request->input('telephone');
        $company_name = $request->input('company_name');
        $memo = $request->input('memo');
        $thumbnail_flag = $request->input('thumbnail_flag');
        
        // https://qiita.com/ryo-program/items/35bbe8fc3c5da1993366
        // 画像ファイルのアップロード
        // if($file){
        //     // 現在時刻ともともとのファイル名を組み合わせてランダムなファイル名作成
        //     $thumbnail = time() . $file->getClientOriginalName();
        //     // アップロードするフォルダ名取得
        //     $target_path = public_path('uploads/');
        //     // アップロード処理
        //     $file->move($target_path, $thumbnail);
        // }else{
        //     // 画像ファイルが選択されていなければ空の文字列をセット
        //     $thumbnail = '';
        // }
        
        // 画像アップロード
        if($file){
            // S3用
            $path = Storage::disk('s3')->putFile('/uploads', $file, 'public');

            // パスから、最後の「ファイル名.拡張子」の部分だけ取得
            $thumbnail = basename($path);

        }else{
            // 画像が選択されていなければ、もとの画像名のまま
            $thumbnail = $customer->thumbnail;
        }
        
        // 入力データ値をもとに連想配列を作成
        // $data = compact('name', 'kana_name', 'gender', 'thumbnail', 'age', 'birthday', 'address', 'hometown', 'feature', 'blood_type', 'job', 'hobby', 'skill', 'dayoff', 'favorite_food', 'dislike_food', 'marriage', 'children', 'lover', 'email', 'telephone', 'company_name', 'memo');
        
        $customer->name = $name; $customer->kana_name = $kana_name; $customer->gender = $gender; $customer->thumbnail = $thumbnail; $customer->age = $age; $customer->birthday = $birthday; $customer->address = $address; $customer->children = $children; $customer->lover = $lover; $customer->email = $email; $customer->telephone = $telephone; $customer->company_name = $company_name; $customer->memo = $memo;
        $customer->hometown = $hometown; $customer->feature = $feature; $customer->blood_type = $blood_type; $customer->job = $job; $customer->hobby = $hobby; $customer->skill = $skill; $customer->dayoff = $dayoff; $customer->favorite_food = $favorite_food; $customer->dislike_food = $dislike_food; $customer->marriage = $marriage;
        
        $customer->save();
        
        // 顧客一覧へリダイレクト
        return back()->with('flash_message', '顧客情報を更新しました');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Customer $customer)
    {
        //
    }
    
    //削除
    public function delete($customer_id){
        
        $customer = Customer::find($customer_id);
        
        if($customer->user_id !== \Auth::id()){
            return redirect('/customers');
        }
        
        // dd($customer);
        $customer->favorite_flag = 0;
        $customer->delete_flag = 1;
        $customer->save();
    
        return redirect('/customers')->with('flash_message', $customer->name . 'さんを削除しました');
    
    }

    //削除解除
    public function undelete($customer_id){
        
        $customer = Customer::find($customer_id);
        
        // dd($customer_id);
        if($customer->user_id !== \Auth::id()){
            return redirect('/customers');
        }
        
        // dd($customer);
        $customer->favorite_flag = 0;
        $customer->delete_flag = 0;
        $customer->save();
        
        return redirect('/customers')->with('flash_message', $customer->name . 'さんを削除から復活しました');
    }
    
    //削除顧客一覧取得
    public function deletes(){
        
        // dd('OK');
        $del_customers = Customer::where('user_id', \Auth::id())->where('delete_flag', 1)->get();
        
        $flag = \Auth::user()->flag()->get()->first();
        
        return view('customers.del_customers', compact('del_customers', 'flag'));
    }
    
    //お気に入り
    public function favorite($customer_id){
        // dd($customer_id);
        
        $customer = Customer::find($customer_id);
        
        if($customer->user_id !== \Auth::id()){
            return redirect('/customers');
        }

        // dd($customer);
        $customer->favorite_flag = 1;
        $customer->save();

        return redirect('/customers')->with('flash_message', $customer->name . 'さんをお気に入りに登録しました');
    }

    //お気に入り解除
    public function unfavorite($customer_id){
        // dd($customer_id);
        
        $customer = Customer::find($customer_id);
        
        if($customer->user_id !== \Auth::id()){
            return redirect('/customers');
        }

        // dd($customer);
        $customer->favorite_flag = 0;
        $customer->save();

        return redirect('/customers')->with('flash_message', $customer->name . 'さんをお気に入りにから削除しました');
    }
    
    //お気に入り顧客一覧取得
    public function favorites(){
        $fav_customers = Customer::where('user_id', \Auth::id())->where('favorite_flag', 1)->get();
        
        // dd($fav_customers);
        
        $flag = \Auth::user()->flag()->get()->first();
        
        return view('customers.favorites', compact('fav_customers', 'flag'));
    }
    
    // 顧客一覧検索
     public function search(Request $request){
        $keyword = $request->input('keyword');
        if($keyword !== ''){
            $customers = \Auth::user()->customers()->where('kana_name', 'like', "%$keyword%")->orWhere('name', 'like', "%$keyword%")->where('delete_flag', '0')->get();
            // dd($customers);
            // session(['flash_message', '検索キーワード: ' . $keyword . 'で ' . $customers->count() . '件ヒットしました']);
            $request->session()->flash('flash_message', '検索キーワード: ' . $keyword . 'で ' . $customers->count() . '件ヒットしました');
            return view('customers.index', compact('customers'));
        }else{
            return redirect('customers/index');
        }
    }
    
    // お気に入り顧客検索
     public function searchFav(Request $request){
        $keyword = $request->input('keyword');
        if($keyword !== ''){
            $customers = \Auth::user()->customers()->where('kana_name', 'like', "%$keyword%")->orWhere('name', 'like', "%$keyword%")->where('favorite_flag', '1')->where('delete_flag', '0')->get();
            // dd($customers);
            // session(['flash_message', '検索キーワード: ' . $keyword . 'で ' . $customers->count() . '件ヒットしました']);
            $request->session()->flash('flash_message', '検索キーワード: ' . $keyword . 'で ' . $customers->count() . '件ヒットしました');
            return view('customers.index', compact('customers'));
        }else{
            return redirect('customers/index');
        }
    }
    
    // 削除済みの顧客検索
    public function searchDel(Request $request){
        $keyword = $request->input('keyword');
        if($keyword !== ''){
            $customers = \Auth::user()->customers()->where('kana_name', 'like', "%$keyword%")->orWhere('name', 'like', "%$keyword%")->where('delete_flag', '1')->get();
            // dd($customers);
            // session(['flash_message', '検索キーワード: ' . $keyword . 'で ' . $customers->count() . '件ヒットしました']);
            $request->session()->flash('flash_message', '検索キーワード: ' . $keyword . 'で ' . $customers->count() . '件ヒットしました');
            return view('customers.index', compact('customers'));
        }else{
            return redirect('customers/index');
        }
    }

    //かな名順に並び替え
    public function order_by_kana(Request $request)
    {
        // ログインしているユーザーの顧客一覧取得
        // $customers = \Auth::user()->customers()->get();
        
        $kind = $request->input('kind');
        
        // dd($kind);
        
        $flag = \Auth::user()->flag()->get()->first();    
        
        //お気に入り一覧ならば
        if($kind === 'favorites') {
            $fav_customers = Customer::where('user_id', \Auth::id())->where('delete_flag', 0)->where('favorite_flag', 1)->orderBy('kana_name', 'ASC')->get();
            // view の呼び出し
             return view('customers.favorites', compact('fav_customers', 'flag'));
        } else if ($kind === 'deletes') {
            $del_customers = Customer::where('user_id', \Auth::id())->where('delete_flag', 1)->orderBy('kana_name', 'ASC')->get();
            // view の呼び出し
             return view('customers.del_customers', compact('del_customers', 'flag'));
        }
        else {
            $customers = Customer::where('user_id', \Auth::id())->where('delete_flag', 0)->orderBy('kana_name', 'ASC')->get();
            // view の呼び出し
            return view('customers.index', compact('customers', 'flag'));
        }

        

    }


}
