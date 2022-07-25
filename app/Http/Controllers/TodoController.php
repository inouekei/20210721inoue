<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\TodoRequest;
use Illuminate\Support\Facades\Auth;
use App\Models\Todo;
use App\Models\Tag;
use App\Models\user;

class TodoController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $todos = Todo::where('user_id', $user->id)->get();
        $tags = Tag::all();
        $param = [
            'todos' => $todos,
            'user' => $user->name,
            'tags' =>$tags];
        return view('index', $param);
    }

    public function create(TodoRequest $request)
    {
        $user = Auth::user();
        $form = $request->all();
        $form['user_id'] = $user->id;
        Todo::create($form);
        return redirect('/');
    }

    public function update(TodoRequest $request)
    {
        $form = $request->all();
        unset($form['_token']);
        unset($form['key_txt']);
        unset($form['key_tag']);
        Todo::where('id', $request->id)->update($form);
        if(isset($request['key_txt'])){
            $redirect ='/todo/search?_token='.$request['_token'] . '&content=' . $request['key_txt'];
            if($request['key_tag']){
                $redirect = $redirect . '&tag_id=' . $request['key_tag'];
            }
            return redirect($redirect);
        }
        return redirect('/');
    }

    public function remove(Request $request)
    {
        if(isset($request['id'])){
            Todo::find($request->id)->delete();
            if(isset($request['key_txt'])){
                $redirect ='/todo/search?_token='.$request['_token'] . '&content=' . $request['key_txt'];
                if($request['key_tag']){
                    $redirect = $redirect . '&tag_id=' . $request['key_txt'];
                }
                return redirect($redirect);
            }
        }
        return redirect('/');
    }
    
    public function find()
    {        
        $user = Auth::user();
        $tags = Tag::all();
        $todos = [];
        $param = [
            'user' => $user->name, 
            'tags' => $tags, 
            'todos' => $todos, 
            'input'=>''];
        return view('find', $param);
    }

    public function search(Request $request)
    {
        $user = Auth::user();
        $tags = Tag::all();
        $todoquery = [['user_id', '=', $user->id]];
        if($request->content <> null){
            array_push($todoquery, ['content', 'LIKE BINARY', "%{$request->content}%"]);
        }
        if($request->tag_id <> null){
            array_push($todoquery, ['tag_id', '=', $request->tag_id]);
        }
        $todos = Todo::where($todoquery)->get();
        $param = [
            'user' => $user->name, 
            'tags' => $tags, 
            'todos' => $todos, 
            'input' => $request->content,
            'tag_id' => $request->tag_id];
        return view('find', $param);
    }
}
