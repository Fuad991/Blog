<?php

namespace App\Http\Controllers;

use App\Models\post;
use App\Models\tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    public function __construct(){//هاذ عشان نحمي الكونترولير وما نخلي اي واحد مش عامل لوج ان على الصفحة ينزل بوست
        $this->middleware('auth');
    }

    public function index()
    {
      //$posts = post::all();//هيك بشوف كل البوستات لكل اليوزر
      $posts = post::orderBy('created_at','DESC')->get();//هاذ عشان يجيب البوستات على الوقت الي انشأ البوست و ديسك عشان يجيب اجدد البوستات بالاول
      //$posts = post::where('user_id',Auth::id())->get();//هيك بس البوستات لليوزر الي عامله لوج ان
      return view('posts.index')->with('posts',$posts);//اول اشي بل ويذ المتغير بوست والثاني المتغير الي بالكونترولير
    }

    public function trashed()
    {
       // $posts = post::onlyTrashed()->get();//هون بشوف كل البوستات المحذوفة
       $posts = post::onlyTrashed()->where('user_id',Auth::id())->get();//هون بس البوستات الي اليوزر حاذفهااوث هي الي بتحكيلك مين اليوزر الي عامل لوج ان على الصفحة من الاي دي
        return view('posts.trashed')->with('posts',$posts);
    }

    public function create()
    {
        $tags= tag::all();//عشان نستدعي كل التاجات
        //if($tags->count > 0){
          //  redirect()->route('tag.create');//هاي عشان اذا ما كان عنده تاج لازم ينشأ واحد
        //}
        return view('posts.create')->with('tags',$tags);
    }
    public function store(Request $request)
    {
        $this->validate($request,[
            'title' => 'required',
            'content' => 'required',
            'tag' => 'required',
            'pic' => 'required|image',//هيك حددناله انه بدنا صورة مش يعبيها اي اشي
        ]);//فاليديت هاي اداة تحقق زي ال اف ستيتمنت

        $pic = $request->pic;//هاي عشان نستقبل الصورة
        $newphoto = time().$pic->getClientOriginalName();//هاي عشان اسماء الصور ما تتشابه والفنكشن ما اشتغل
        $pic->move('uploads/posts',$newphoto) ;//هاذ عشان مكان الحفظ

        $post = post::create([//هاذ عشان نسيف بالداتا بيز
            'user_id' => Auth::id(),
            'title' => $request->title,
            'content' => $request->content,
            'pic' => 'uploads/posts/'.$newphoto ,
            'slug' => str_slug($request->title)
        ]);

        $post->tag()->attach($request->tags);//عشان يوخذ كل التاجات المحددة مع البوست ويضيفهم معه بالداتا بيز

        return redirect()->back();
    }

    public function show($slug)
    {
        $tags= tag::all();
        $post = post::where('slug',$slug)->first();//هاذ عشان يعرض البوست على اساس السلق
        //$post = post::where('slug',$slug)->where('user_id',Auth::id())->first();//هاي بتخلي بس اليوزر الي عامل البوست يشوفه بس يكبس على العين مش بال انديكس
        return view('posts.show')->with('post',$post)
        ->with('tag',$tags);
    }

    public function edit($id)
    {
      $tags= tag::all();
      //$posts = post::find($id);//هاي بتخلي اي يوزر يعدل
      $posts = post::where('user_id',$id)->where('user_id',Auth::id())->first();//هاي بس اليوزر الي عمل البوست هو الي بعدل
      if($posts === null){//هاي عشان اذا كان الي بده يعدل مش صاحب البوست ما بدخله وما بعطيه ايرور بس برجعه على الصفحة الي قبل
        return redirect()->back();
      }
      return view('posts.edit')->with('post',$posts)
      ->with('tag',$tags);
    }

    public function update(Request $request,$id)
    {
        $post = post::find($id);
        $this->validate($request,[//عشان نتحقق انه عدل كل المعلومات
            'title' => 'required',
            'content' => 'required',
        ]);

        //dd($request->all()); //هاذ فنكشن بعرضلك شو القيم الي بتيجي من المستخدم

        if($request->pic->has('photo')){
        $pic = $request->pic;
        $newphoto = time().$pic->getClientOriginalName();
        $pic->move('uploads/posts',$newphoto) ;
        $post->photo = 'uploads/posts/'.$newphoto;
        }

        $post->title = $request->title;
        $post->content = $request->content;
        $post->save();
        $post->tag()->sync($request->tags);

        return redirect()->back();
    }

    public function destroy($id)
    {
        //$post = post::find($id);//هون اي واحد بقدر يحذف البوست
        $post = post::where('user_id',$id)->where('user_id',Auth::id())->first();//هةن بس صاحب البوست الي بحذفه
        $post->delete();
        if($post === null){//هاي عشان اذا كان الي بده يعدل مش صاحب البوست ما بدخله وما بعطيه ايرور بس برجعه على الصفحة الي قبل
            return redirect()->back();
          }
        return redirect()->back();
    }

    public function delete($id)
   {
    $post = post::withTrashed()->where('id', $id)->first();
    $post->forceDelete();
    return redirect()->back();
    }

    public function restore($id)
   {
    $post = post::withTrashed()->where('id', $id)->first();
    $post->restore();
    return redirect()->back();
    }
}
