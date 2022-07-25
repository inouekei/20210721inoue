@extends('layouts.default')
<style>
  .btn-find{
    display: block;
    width: 80pt;
    height: 29pt;
    margin-bottom: 10pt;
    background-color: white;
    border-style: solid;
    border-radius: 4pt;
    border-color: #bbff00;
    font-size: 9pt;      
    font-weight: bold;
    text-decoration: none;
    text-align: center;
    line-height: 29pt;
    color: #bbff00;
  }
  /* body{
    background-color: #2a2a80;
  }

  h2{
    margin-bottom: 10pt;
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
    height: 250pt;
    background-color: white;
    margin: 20vh auto;
    border-radius: 8pt;
    padding: 10pt 15pt;
  }

  .form-add{
    display: flex;
    justify-content: space-between;
    margin-bottom: 10pt;
  }

  .txt-add{
    width: 80%; 
    border-color: lightgray;     
    border-radius: 3pt;
    border-style: solid;
    border-width: 1pt;
  }

  .btn-add{
    border-color: magenta;
    color: magenta;
  }

  .tbl-todo{
    width: 100%;
    margin:auto;
    text-align: center;
  }

  .th-element{
    width: 150pt;
    height: 30pt;
  }

  .txt-update{
    width: 80%;
    height: 15pt;      
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
  } */
</style>
@section('title', 'Todo List')

@section('btn-find')
  <!-- <form action="/todo/find" method="get">
    @csrf
    <button class="btn-find">タスク検索</button>
  </form> -->
  <a class="btn-find" href="/todo/find">タスク検索</a>
@endsection

@section('top-action')
   action="/add"  method="post"
@endsection

@section('btn-top', '追加')

@section('top-tag')
  @foreach ($tags as $tag)
    <option value="{{$tag->id}}">
      {{$tag->content}}
    </option>
  @endforeach
@endsection
