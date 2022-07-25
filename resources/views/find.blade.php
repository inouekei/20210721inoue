@extends('layouts.default')
<style>
  .btn-back{
    display: block;
    width: 40pt;
    height: 29pt;
    margin-bottom: 10pt;
    background-color: white;
    border-style: solid;
    border-radius: 4pt;
    border-color: gray;
    font-size: 9pt;      
    font-weight: bold;
    text-decoration: none;
    text-align: center;
    line-height: 29pt;
    color: gray;
    position: absolute;
    bottom: 0;
  }
</style>
@section('title', 'タスク検索')

@section('top-action')
   action="./search"  method="get"
@endsection

@section('btn-top', '検索')

@section('top-tag')
  <option></option>
  @foreach ($tags as $tag)
    <option value="{{$tag->id}}">
      {{$tag->content}}
    </option>
  @endforeach
@endsection

@section('hidden-input')
  <input type="hidden" name="key_txt" value="{{$input}}">
  @if(isset($tag_id))
    <input type="hidden" name="key_tag" value="{{$tag_id}}">
  @endif
@endsection

@section('btn-back')
  <a class="btn-back" href="/">戻る</a>
@endsection

