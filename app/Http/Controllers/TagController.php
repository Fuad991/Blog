<?php

namespace App\Http\Controllers;

use App\Models\tag;
use Illuminate\Http\Request;

class TagController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tags= tag::all();
        return view('tags.index')->with('tags',$tags);
    }

    public function create()
    {
        return view('tags.index');
    }

    public function store(Request $request)
    {
        $this->validate($request,[
            'tag' => 'required',
        ]);

        $tag = tag::create([
            'tag' => $request -> tag
        ]);

        return redirect()->back();
    }

    public function edit($id)
    {
        $tag = tag::find($id);
        return view('tags.edit')->with('tag',$tag);
    }

    public function update(Request $request, $id)
    {
        $tag = tag::find($id);
        $this->validate($request,[
            'tag' => 'required',
        ]);

        $tag->tag = $request->tag;
        $tag->save();
        return redirect()->back();
    }

    public function destroy($id)
    {
        $tag = tag::find($id);
        $tag->delete();
        return redirect()->back();
    }
}
