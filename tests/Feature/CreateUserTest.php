<?php

namespace Tests\Feature;

use App\Models\Role;
use App\Models\RoleUser;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CreateUserTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    /** @test */
    public function an_user_can_be_created()
    {
        $this->seed();

        $name = $this->faker->name();
        $email = $this->faker->email();
        $roles = [Role::COMPANY_ROLE, Role::DELIVERY_ROLE];

        $response = $this->post(route('users.store'), [
            'name' => $name,
            'email' => $email,
            'roles' => $roles,
        ]);

        $this->assertDatabaseHas(User::class, [
            'name' => $name,
            'email' => $email,
        ]);

        foreach ($roles as $role) {
            $this->assertDatabaseHas(RoleUser::class, [
                'user_id' => 21,
                'role_id' => $role,
            ]);
        }

        $response->assertStatus(302);
        $response->assertRedirect(route('users'));
    }

    /** @test */
    public function a_name_is_required()
    {
        $this->seed();

        $name = '';
        $email = $this->faker->email();
        $roles = [Role::COMPANY_ROLE, Role::DELIVERY_ROLE];

        $response = $this->post(route('users.store'), [
            'name' => $name,
            'email' => $email,
            'roles' => $roles,
        ]);

        $response->assertSessionHasErrors('name');
    }

    /** @test */
    public function a_email_is_required()
    {
        $this->seed();

        $name = $this->faker->name();
        $email = '';
        $roles = [Role::COMPANY_ROLE, Role::DELIVERY_ROLE];

        $response = $this->post(route('users.store'), [
            'name' => $name,
            'email' => $email,
            'roles' => $roles,
        ]);

        $response->assertSessionHasErrors('email');
    }

    /** @test */
    public function a_email_is_unique()
    {
        $this->seed();

        $name = $this->faker->name();
        $email = $this->faker->email();
        $roles = [Role::COMPANY_ROLE, Role::DELIVERY_ROLE];

        User::create([
            'name' => $name,
            'email' => $email,
            'roles' => $roles,
        ]);

        $response = $this->post(route('users.store'), [
            'name' => $name,
            'email' => $email,
            'roles' => $roles,
        ]);

        $response->assertSessionHasErrors('email');
    }

    /** @test */
    public function a_roles_are_required()
    {
        $this->seed();

        $name = $this->faker->name();
        $email = $this->faker->email();
        $roles = [];

        $response = $this->post(route('users.store'), [
            'name' => $name,
            'email' => $email,
            'roles' => $roles,
        ]);

        $response->assertSessionHasErrors('roles');
    }

    /** @test */
    public function a_roles_are_valid()
    {
        $this->seed();

        $name = $this->faker->name();
        $email = $this->faker->email();
        $max = max(array_keys(Role::ROLES));
        $roles = [++$max, ++$max];

        $response = $this->post(route('users.store'), [
            'name' => $name,
            'email' => $email,
            'roles' => $roles,
        ]);

        $response->assertSessionHasErrors('roles');
    }

    /** @test */
    public function a_user_can_see_the_create_user_page()
    {
        $response = $this->get(route('users.create'));

        $response->assertViewIs('users.create');

        $roles = Role::ROLES;

        $response->assertViewHas('roles', $roles);
    }
}
