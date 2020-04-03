<?php

namespace App\Http\Controllers;
use App\ckeditor;
use App\blog_post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class ckEditorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['post']=DB::table('blog_posts')->get();
        return view('editor.allpost',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['post']=DB::table('blog_posts')->orderBy('id', 'desc')->paginate(1);
        $data['edit_single_post']=DB::table('blog_posts')->orderBy('id', 'desc')->paginate(1);
        $data['edit_post']=DB::table('blog_posts')->get();
        return view('editor.editor',$data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      
        DB::table('blog_posts')->insert([
            'details'=>$request->details,
        ]);
        return back()->with('status','Blog Added Sucessfully!');
           
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data['info']= DB::table('blog_posts')->find($id);
    
        return view('editor.view',$data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['edit_posts'] =  DB::table('blog_posts')->find($id);

        return view('editor.edit_post', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        blog_post::where('id', $id)->update([
            'details'=>$request->details,

        ]);
        return redirect()->back()->with('status', 'blog post Updated Successfully!');
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
    public function upload(Request $request)
    {
        if($request->hasFile('upload')) {
            //get filename with extension
            $filenamewithextension = $request->file('upload')->getClientOriginalName();
      
            //get filename without extension
            $filename = pathinfo($filenamewithextension, PATHINFO_FILENAME);
      
            //get file extension
            $extension = $request->file('upload')->getClientOriginalExtension();
      
            //filename to store
            $filenametostore = $filename.'_'.time().'.'.$extension;
      
            //Upload File
            $request->file('upload')->storeAs('public/uploads', $filenametostore);
 
            $CKEditorFuncNum = $request->input('CKEditorFuncNum');
            $url = asset('storage/uploads/'.$filenametostore); 
            $msg = 'Image successfully uploaded'; 
            $re = "<script>window.parent.CKEDITOR.tools.callFunction($CKEditorFuncNum, '$url', '$msg')</script>";
             
            // Render HTML output 
            @header('Content-type: text/html; charset=utf-8'); 
            echo $re;
        }
    }
}
