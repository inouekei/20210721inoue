<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class InoueTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */

     public function testModels()
    {
        //tag
        Tag::factory()->count(5)->create();
        $count = Tag::get()->count();
        $this->assertEquals(5, $count);
        $first_record_id = Tag::first()->id;
        $last_record_id = Tag::all()->last()->id;
        $tag =Tag::find(rand($first_record_id, $first_record_id));
        $tag_content = $tag->content;
        $this->assertDatabaseHas('tags', ['content' => $tag_content,]);
        $tag->delete();
        $this->assertDatabaseHas('tags', ['content' => $tag_content,]);
        $delete_tag = Tag::where('content', $tag_content)->first();
        $this->assertEmpty($delete_tag);

        //todo
        Todo::factory()->count(5)->create();
        $count = Todo::get()->count();
        $this->assertEquals(5, $count);
        $first_record_id = Todo::first()->id;
        $last_record_id = Todo::all()->last()->id;
        $todo =Todo::find(rand($first_record_id, $first_record_id));
        $todo_content = $todo->content;
        $todo_tag_id = $todo->tag_id;
        $todo_user_id = $todo->user_id;
        $this->assertDatabaseHas('todos', ['content' => $todo_content, 'tag_id' => $todo_tag_id, 'todo_user_id' => $todo_user_id,]);
        $todo->delete();
        $this->assertDatabaseHas('todos', ['content' => $todo_content, 'tag_id' => $todo_tag_id, 'todo_user_id' => $todo_user_id,]);
        $delete_todo = Todo::where(['content' => $todo_content, 'tag_id' => $todo_tag_id, 'user_id' => $todo_user_id])->first();
        $this->assertEmpty($delete_todo);
    }

    public function testRejectTodoRegistrations()
    {
        $content_null_data = [
            'content' => null,
            'user_id' => 1,
            'tag_id' => 1,
        ];
        $content_maxplus_data = array_replace(
            $content_null_data, ['content' => '123456789012345678901']
        );
        $tag_null_data = array_replace(
            $content_null_data, ['tag_id' => null]
        );

        $todo = new Todo();
        try{
            $todo->fill($content_null_data)->save();
        } catch (\Exception $e) {
            $this ->assertDatabaseMissing('todos', $content_null_data);
        }
        try{
            $todo->fill($content_maxplus_data)->save();
        } catch (\Exception $e) {
            $this ->assertDatabaseMissing('todos', $content_maxplus_data);
        }
        try{
            $todo->fill($tag_null_data)->save();
        } catch (\Exception $e) {
            $this ->assertDatabaseMissing('todos', $tag_null_data);
        }
            
        
    }
    public function testAccess()
    {
        $this->user = factory(User::class)->create();

        $this->get('/')>assertStatus(302);
        $this->ActingAs($this->user)->get('/')->assertOk;
        $this->ActingAs($this->user)->json('POST', route('/add'))->assertOk;
        $this->ActingAs($this->user)->json('POST', route('/edit'))->assertOk;
        $this->ActingAs($this->user)->json('POST', route('/delete'))->assertOk;
        $this->ActingAs($this->user)->get('/todo/find')->assertOk;
        $this->ActingAs($this->user)->get('/todo/find')->assertOk;

    }
}
