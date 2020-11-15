<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// DB使いたいのでModelのBlogを呼び出した。
use App\Models\Blog;

// リクエストはバリデーションで必要なんです
use App\Http\Requests\BlogRequest;

class BlogController extends Controller
{
    public function index(){
        
        // Blogから全部のデータを取る
        $blogs =Blog::all();

   
        return view('blog.list' ,[
            'blogs' =>$blogs,
            // viewに値を渡す
        ]);
    }

    // routeで使っていたidを引数としている
    public function show($id)
    {

        // DBの中から該当のidを探している
        $blog =Blog::find($id);

        // もし該当する詳細のIDがなければリダイレクトしていく
        if(is_null($blog)){
            // sessioonとはエラーメッセージのこと
            \Session::flash('err_msg' ,'データがありません');
            return redirect (route('blogs'));
        }

   
        return view('blog.detail' ,[
            'blog' =>$blog,
        ]);
    }

    // ブログ登録画面
    public function create()
    {
        return view ('blog.form');
    }
    //ブログを登録する
    // 引数をRequestからBlogrequestに変更した。これでバリデーションリクエストが使える様になる
    public function store(BlogRequest $request)
    {
        // createで取得したものをallとして全部inputの中に代入
        $inputs =$request->all();


        \DB::beginTransaction();
        try{
            // ブログ（データベース）に登録！！
            Blog::create($inputs);
            \DB::commit();
        }catch(\Throwable $e){
            \DB::rollback();
            abort(500);
        }

        \Session::flash('err_msg' ,'ブログを登録しました');
        return redirect (route('blogs'));
       
    }

    // ブログ編集画面
    // ほとんど詳細画面の表示と同じ
    public function edit($id)
    {

        // DBの中から該当のidを探している
        $blog =Blog::find($id);

        // もし該当する詳細のIDがなければリダイレクトしていく
        if(is_null($blog)){
            // sessioonとはエラーメッセージのこと
            \Session::flash('err_msg' ,'データがありません');
            return redirect (route('blogs'));
        }

   
        return view('blog.edit' ,[
            'blog' =>$blog,
        ]);
    }

    public function update(BlogRequest $request)
    {
         // createで取得したものをallとして全部inputの中に代入
         $inputs =$request->all();


         \DB::beginTransaction();
         try{
             // ブログ（データベース）に登録！！
             $blog = Blog::find($inputs['id']);
             $blog->fill([
                'title'   =>$inputs['title'],
                'content' =>$inputs['content'],
             ]);
             $blog->save();
             \DB::commit();

         }catch(\Throwable $e){
             \DB::rollback();
             abort(500);
         }
 
         \Session::flash('err_msg' ,'ブログを更新しました');
         return redirect (route('blogs'));

    }

    public function delete($id)
    {

        // もし該当する詳細のIDがなければリダイレクトしていく
        if(empty($id)){
            // sessioonとはエラーメッセージのこと
            \Session::flash('err_msg' ,'データがありません');
            return redirect (route('blogs'));
        }

        Blog::destroy($id);
        // try{
        //     Blog::destory($id);
        // }catch(\Throwable $e){
        //     abort(500);
        // }
      

        \Session::flash('err_msg' ,'データを削除しました');
        return redirect (route('blogs'));
    } 
}
