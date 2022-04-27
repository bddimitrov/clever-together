<?php

namespace Tests\Feature;

use App\Models\Role;
use App\Models\RoleUser;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ShowUsersTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_user_list_is_shown()
    {
        $this->seed();

        // @TODO pagination can be added lately

        $users = User::all();

        $response = $this->get(route('users'));

        $response->assertViewIs('users.index');

        $response->assertViewHas('users', $users);
    }

    /** @test */
    public function a_user_can_sort_by_email_asc()
    {
        $this->seed();

        $users = User::all()->sortBy('email');

        $response = $this->get(route('users') . '?email=asc');

        $data = $response->viewData('users');

        $this->assertEquals($users->pluck('id'), $data->pluck('id'));
    }

    /** @test */
    public function a_user_can_sort_by_email_desc()
    {
        $this->seed();

        $users = User::all()->sortByDesc('email');

        $response = $this->get(route('users') . '?email=desc');

        $data = $response->viewData('users');

        $this->assertEquals($users->pluck('id'), $data->pluck('id'));
    }

    /** @test */
    public function a_user_can_sort_by_name_asc()
    {
        $this->seed();

        $users = User::all()->sortBy('name');

        $response = $this->get(route('users') . '?name=asc');

        $data = $response->viewData('users');

        $this->assertEquals($users->pluck('id'), $data->pluck('id'));
    }

    /** @test */
    public function a_user_can_sort_by_name_desc()
    {
        $this->seed();

        $users = User::all()->sortByDesc('name');

        $response = $this->get(route('users') . '?name=desc');

        $data = $response->viewData('users');

        $this->assertEquals($users->pluck('id'), $data->pluck('id'));
    }
}
