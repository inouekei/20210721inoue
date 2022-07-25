<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Tag;
use App\Models\Todo;
use App\Models\User;


class InoueTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */

     public function testTag()
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
        $this->assertDatabaseMissing('tags', ['content' => $tag_content,]);
    }

     public function testUser(){
        //user
        User::factory()->count(5)->create();
        $count = User::get()->count();
        $this->assertEquals(5, $count);
        $first_record_id = User::first()->id;
        $last_record_id = User::all()->last()->id;
        $user =User::find(rand($first_record_id, $first_record_id));
        $user_name = $user->name;
        $user_password = $user->password;
        $user_email = $user->email;
        $this->assertDatabaseHas('users', ['name' => $user_name, 'password' => $user_password, 'email' => $user_email,]);
        $user->delete();
        $this->assertDatabaseMissing('users', ['name' => $user_name, 'password' => $user_password, 'email' => $user_email,]);
    }

    public function testTodo(){
        //todo
        User::factory()->count(5)->create();
        Tag::factory()->count(5)->create();
        Todo::factory()->count(5)->create();
        $count = Todo::get()->count();
        $this->assertEquals(5, $count);
        $first_record_id = Todo::first()->id;
        $last_record_id = Todo::all()->last()->id;
        $todo =Todo::find(rand($first_record_id, $first_record_id));
        $todo_content = $todo->content;
        $todo_tag_id = $todo->tag_id;
        $todo_user_id = $todo->user_id;
        $this->assertDatabaseHas('todos', ['content' => $todo_content, 'tag_id' => $todo_tag_id, 'user_id' => $todo_user_id,]);
        $todo->delete();
        $this->assertDatabaseMissing('todos', ['content' => $todo_content, 'tag_id' => $todo_tag_id, 'user_id' => $todo_user_id,]);
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
            $content_null_data, ['content' => 'content', 'tag_id' => null]
        );

        $todo = new Todo();
        try{
            $todo->fill($content_null_data)->save();
        } catch (\Exception $e) {
        }
        $this ->assertDatabaseMissing('todos', $content_null_data);
        try{
            $todo->fill($content_maxplus_data)->save();
        } catch (\Exception $e) {
        }
        $this ->assertDatabaseMissing('todos', $content_maxplus_data);
        try{
            $todo->fill($tag_null_data)->save();
        } catch (\Exception $e) {
        }
        $this ->assertDatabaseMissing('todos', $tag_null_data);
    }

    public function testRejectUserRegistrations()
    {
        $name_null_data = [
            'name' => null,
            'email' => '123@5.jp',
            'password' => '12345678',
        ];
        $name_maxplus_data = array_replace(
            $name_null_data, ['name' => '12345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890']
        );
        $email_null_data = array_replace(
            $name_null_data, ['name' => 'user','email' => null]
        );
        $email_maxplus_data = array_replace(
            $name_null_data, ['name' => 'user','email' => '12345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890@5.jp']
        );
        $email_minminus_data = array_replace(
            $name_null_data, ['name' => 'user','email' => '12@4.jp']
        );
        $email_notmail_data = array_replace(
            $name_null_data, ['name' => 'user','email' => '12345678']
        );
        $password_null_data = array_replace(
            $name_null_data, ['name' => 'user','password' => null]
        );
        $password_maxplus_data = array_replace(
            $name_null_data, ['name' => 'user','password' => '12345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890']
        );
        $password_minminus_data = array_replace(
            $name_null_data, ['name' => 'user','password' => '1234567']
        );

        $user = new User();
        try{
            $todo->fill($name_null_data)->save();
        } catch (\Exception $e) {
        }
        $this ->assertDatabaseMissing('users', $name_null_data);
        try{
            $todo->fill($name_maxplus_data)->save();
        } catch (\Exception $e) {
        }
        $this ->assertDatabaseMissing('users', $name_maxplus_data);
        try{
            $todo->fill($email_null_data)->save();
        } catch (\Exception $e) {
        }
        $this ->assertDatabaseMissing('users', $email_null_data);
        try{
            $todo->fill($email_maxplus_data)->save();
        } catch (\Exception $e) {
        }
        $this ->assertDatabaseMissing('users', $email_maxplus_data);
        try{
            $todo->fill($email_minminus_data)->save();
        } catch (\Exception $e) {
        }
        $this ->assertDatabaseMissing('users', $email_minminus_data);
        try{
            $todo->fill($email_notmail_data)->save();
        } catch (\Exception $e) {
        }
        $this ->assertDatabaseMissing('users', $email_notmail_data);
        try{
            $todo->fill($password_null_data)->save();
        } catch (\Exception $e) {
        }
        $this ->assertDatabaseMissing('users', $password_null_data);
        try{
            $todo->fill($password_maxplus_data)->save();
        } catch (\Exception $e) {
        }
        $this ->assertDatabaseMissing('users', $password_maxplus_data);
        try{
            $todo->fill($password_minminus_data)->save();
        } catch (\Exception $e) {
        }
        $this ->assertDatabaseMissing('users', $password_minminus_data);
    }

    public function testAccess()
    {
        $this->user = User::factory()->create();

        $this->get('/')->assertStatus(302);
        $this->ActingAs($this->user)->get('/')->assertOk();
        $this->ActingAs($this->user)->post('/add')->assertStatus(302);
        // $this->ActingAs($this->user)->json('POST', route('add'))->assertOk();
        $this->ActingAs($this->user)->post('/edit')->assertStatus(302);
        $this->ActingAs($this->user)->post('/delete')->assertStatus(302);
        $this->ActingAs($this->user)->get('/todo/find')->assertOk();
        $this->ActingAs($this->user)->get('/todo/search')->assertOk();

    }
}
