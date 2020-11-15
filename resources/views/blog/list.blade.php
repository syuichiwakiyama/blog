@extends('blog.layout')

@section('title' ,'ブログ一覧')

@section('content')
<div class="row">
  <div class="col-md-10 col-md-offset-2">
      <h2>ブログ記事一覧</h2>
      @if(session('err_msg'))
        <p class="text-danger">
            {{session('err_msg')}}
        </p>
      @endif  
      <table class="table table-striped">
          <tr>
              <th>記事番号</th>
              <th>タイトル</th>
              <th>日付</th>
              <th></th>
              <th></th>
          </tr>
            @foreach($blogs as $blog)
          <tr>
              <td>{{$blog->id}}</td>
              <!-- 詳細画面に飛ぶのでblog/{{$blog->id}}  <=はデータベースから取ってきた投稿の詳細IDになる -->
              <td><a href="/blog/{{$blog->id}}">{{$blog->title}}</a></td>
              <td>{{$blog ->updated_at}}</td>
              <td><a class="btn btn-primary" href="blog/edit/{{$blog->id}}" role="button">編集</a></td>

              <form method="POST" action="{{ route ('delete' , $blog->id) }}" onSubmit="return checkDelete()">
              @csrf
              <td><button class="btn btn-danger" type="submit" onclick=>削除</button></td>


          </tr>
            @endforeach  
      </table>
  </div>
</div>

<script>
function checkDelete(){
    if(window.confirm('削除してよろしいですか？')){
        return true;
    } else {
        return false;
    }
}
</script>
@endsection


   