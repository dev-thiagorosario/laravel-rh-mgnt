<?php

namespace Tests\Feature;

use App\Models\Departament;
use App\Models\User;
use Carbon\CarbonImmutable;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class AuthNavigationTest extends TestCase
{
    use RefreshDatabase;

    public function test_guest_is_redirected_to_login_when_accessing_protected_pages(): void
    {
        $this->get(route('dashboard'))
            ->assertRedirect(route('login'));

        $this->get(route('user.profile'))
            ->assertRedirect(route('login'));
    }

    public function test_login_redirects_authenticated_user_to_dashboard(): void
    {
        $department = Departament::factory()->create();
        $user = User::factory()->create([
            'departament_id' => $department->id,
            'email' => 'gestor@example.com',
            'password' => Hash::make('secret123'),
        ]);

        $response = $this->post(route('login.authenticate'), [
            'email' => $user->email,
            'password' => 'secret123',
        ]);

        $response->assertRedirect(route('dashboard'));
        $this->assertAuthenticatedAs($user);
    }

    public function test_authenticated_user_is_redirected_from_login_page_to_dashboard(): void
    {
        $department = Departament::factory()->create();
        $user = User::factory()->create([
            'departament_id' => $department->id,
        ]);

        $response = $this->actingAs($user)->get(route('login'));

        $response->assertRedirect(route('dashboard'));
    }

    public function test_authenticated_user_can_view_dashboard(): void
    {
        $department = Departament::factory()->create(['name' => 'Tecnologia']);
        $user = User::factory()->create([
            'departament_id' => $department->id,
            'role' => 'manager',
        ]);

        $response = $this->actingAs($user)->get(route('dashboard'));

        $response->assertOk();
        $response->assertSeeText('Visão geral');
        $response->assertSeeText('Ver meu perfil');
        $response->assertSee(route('user.profile'));
        $response->assertSeeText('Adicionar colaborador');
    }

    public function test_authenticated_user_can_view_profile_page_with_own_data(): void
    {
        $department = Departament::factory()->create(['name' => 'Tecnologia']);
        $user = User::factory()->create([
            'departament_id' => $department->id,
            'name' => 'Thiago Souza',
            'email' => 'thiago@example.com',
            'role' => 'manager',
            'created_at' => CarbonImmutable::create(2026, 3, 1, 10, 15, 0),
        ]);

        $response = $this->actingAs($user)->get(route('user.profile'));

        $response->assertOk();
        $response->assertSeeText('Perfil do Usuário');
        $response->assertSeeText('Thiago Souza');
        $response->assertSeeText('thiago@example.com');
        $response->assertSeeText('manager');
        $response->assertSeeText('Tecnologia');
        $response->assertSeeText('01/03/2026 10:15');
    }

    public function test_admin_sees_all_sidebar_shortcuts_on_dashboard(): void
    {
        $department = Departament::factory()->create(['name' => 'Tecnologia']);
        $user = User::factory()->create([
            'departament_id' => $department->id,
            'role' => 'admin',
        ]);

        $response = $this->actingAs($user)->get(route('dashboard'));

        $response->assertOk();
        $response->assertSeeTextInOrder([
            'Home',
            'Todos Colaboradores',
            'Departamentos',
            'Adicionar Colaborador',
            'Colaboradores do Departamento',
            'Perfil do Usuário',
        ]);
    }
}
