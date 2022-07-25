<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>COACHTECH</title>
  </head>
  <style>
    body{
      background-color: #2a2a80;
    }

    header{
      display: flex;
      justify-content: space-between;
    }

    h2{
      margin-bottom: 10pt;
      line-height: 20pt;
    }

    p{
      line-height: 30pt;
      margin-right: 10pt;
    }

    form{
      /* height: 100%; */
      margin: auto;
    }

    ul{
      margin: 0pt;
      margin-left: 5pt;
      padding: 0pt;
      line-height: 10pt;
    }

    button{
      width: 48pt;
      height: 29pt;
      background-color: white;
      border-style: solid;
      border-radius: 4pt;
      font-size: 9pt;      
      font-weight: bold;
    }
    
    .div-todolist{
      width: 50vw;
      /* height: 250pt; */
      background-color: white;
      margin: 20vh auto;
      border-radius: 8pt;
      padding: 10pt 15pt;
      position: relative;
    }

    .login-info{
      display: flex;
    }

    .btn-logout{
      width: 70pt;
      border-color: red;
      color: red;
    }

    .form-top{
      display: flex;
      justify-content: space-between;
      margin-top: 3pt;
      margin-bottom: 10pt;
    }

    .txt-top{
      width: 80%; 
      border-color: lightgray;     
      border-radius: 3pt;
      border-style: solid;
      border-width: 1pt;
    }

    .tag-top{
      height: 30pt;
      border-color: lightgray;     
      border-radius: 3pt;
      border-style: solid;
      border-width: 1pt;
    }

    .btn-top{
      border-color: magenta;
      color: magenta;
    }

    .tbl-todo{
      width: 100%;
      margin: auto;
      margin-bottom: 30pt;
      text-align: center;
    }

    .th-element{
      width: 170pt;
      height: 30pt;
    }

    .txt-update{
      width: 80%;
      height: 20pt;      
      border-color: lightgray;     
      border-radius: 3pt;
      border-style: solid;
      border-width: 1pt;
    }

    .tag-update{
      height: 15pt;      
      height: 20pt;      
      border-color: lightgray;     
      border-radius: 3pt;
      border-style: solid;
      border-width: 1pt;
    }

    .btn-update{
      border-color: orange;
      color: orange;
    }

    .btn-delete{
      border-color: cyan;
      color: cyan;
    }
  </style>
  <body>
    <div class='div-todolist'>
      <header>
        <h2>@yield('title')</h2>
        <div class="login-info">
          <p>「{{$user}}」でログイン中</p>
            <form action="/logout" method="post">
              @csrf
              <button class='btn-logout'>ログアウト</button>
            </form>
        </div>
      </header>
      @yield('btn-find')
      @if (count($errors) > 0)
      <ul>
        @foreach ($errors->all() as $error)
        <li>
          {{$error}}
        </li>
        @endforeach
      </ul>
      @endif
      <form @yield('top-action') class="form-top">
        @csrf
        <input class="txt-top" type="text" name="content">
        <select class="tag-top" name="tag_id">
          @yield('top-tag')
        </select>              
        <button class="btn-top">@yield('btn-top')</button>
      </form>
      <table class="tbl-todo">
        <tr>
          <th class="th-element">作成日</th>
          <th class="th-element">タスク名</th>
          <th>タグ</th>
          <th>更新</th>
          <th>削除</th>
        </tr>
        @foreach ($todos as $todo)
        <tr>
          <td class="td-created-at">
            {{$todo->created_at}}
          </td>
          <td>
            <form action="/edit" method="post">
              @csrf
              <input class="txt-update" type="text" name="content" value="{{$todo->content}}">
          </td>
          <td>
              <select class="tag-update" name="tag_id">
                @foreach ($tags as $tag)
                  <option value="{{$tag->id}}" 
                    @if ($tag->id===$todo->tag->id)
                      selected
                    @endif
                  >
                  {{$tag->content}}</option>
                @endforeach
              </select>              
          </td>
          <td>
              <input type="hidden" name="id" value="{{$todo->id}}">
              @yield('hidden-input')              
              <button class="btn-update">更新</button>
            </form>
          </td>
          <td>
            <form action="/delete" method="post">
              @csrf
              <input type="hidden" name="id" value="{{$todo->id}}">
              @yield('hidden-input')              
              <button class="btn-delete">削除</button>
            </form>
          </td>
        </tr>
        @endforeach
      </table>
      @yield('btn-back')
    </div>
  </body>
</html>
