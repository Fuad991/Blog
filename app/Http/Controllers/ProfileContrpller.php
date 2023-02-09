<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use App\Models\Profile;
class ProfileContrpller extends Controller
{
    public function __construct(){//هاذ عشان نحمي الكونترولير وما نخلي اي واحد مش عامل لوج ان على الصفحة ينزل بوست
        $this->middleware('auth');
    }


    public function index()
    {
        $user= Auth::user();//هاي مكتبة بتطلعلي معلومات اليوزر من الداتا بيس
        $id=Auth::id();//بتجيبلك الاي دي لليوزر
        if($user->profile==null){//في حالة اليوزر ما كان عنده بروفايل
            $profile= Profile::create([
                'province'=>'Amman',
                'user_id'=>$id,//هون اخذنا الاي دي الي عرفناها فوق عشان بدنا نس الاي دي ال ب تيبل اليوزر
            	'gender'=>'Male',
               	'bio'=>'hello world',
                'cv'=>'my name'
            ]);
            }
        return view('users.profile')->with('user',$user);//حطينا الويذ عشان تبعث معلومات اليوزر معها
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
       $this->validate($request,[
        'province'=>'required',
        'gender'=>'required',
        'bio'=>' required',
        'name'=>'required'
       ]);
       $user=Auth::user();//هذول عشان تتأكد انه جاب كل المعلومات ويبدل مكان كل وحدة بالداتا بيز
       $user->profile->province=$request->province;//الي قبل اليساوي قيمة الداتا بيز والي بعد اليساوي الي جبناهم من الفورم وبدنا نعبيهم مكان القديمات
       $user->profile->gender=$request->gender;//حطبنا البروفايل لانه بره يوديهم على تيبل البروفايل مش زي الاسم موجود بتيبل اليوزر
       $user->profile->bio=$request->bio;
       $user->name=$request->name;
       $user->save();
       $user->profile->save();

       if($request->has('password')){//حطيناها ب اف عشنها مش اجبارية
        $user->password=bycrpt($request->password);//استخدمنا فنكشن ال بيكربت عشان التشفير
        $user->save();
    }
    return redirect()->back();//هاذ برجعك للصفحة الي قبل
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
