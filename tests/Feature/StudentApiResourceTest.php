<?php

namespace Tests\Feature;

use App\Models\Student;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class StudentApiResourceTest extends TestCase
{
    use RefreshDatabase;

    private mixed $token;

    public function set_token()
    {
        $user = User::factory()->create();
        $token = $this->postJson('/api/auth/login', [
            'email' => $user->email,
            'password' => 'password'
        ]);
        $token->assertStatus(200)->assertJsonPath('data.token', $token->json()['data']['token']);
        $this->token = $token->json()["data"]['token'];
        $this->assertNotEmpty($token);
        $this->withHeader('Authorization', 'Bearer ' . $this->token);
    }

    public function test_get_students_endpoint_return_status_ok()
    {
        $this->set_token();
        $this->getJson('/api/students')->assertStatus(200);
    }

    public function test_create_and_edit_students_endpoint_return_status_ok() {
        $this->set_token();
        $student = Student::factory()->make();
        $create_student = $this->postJson('/api/students', [
            'name' => $student->name,
            "school_id" => $student->school_id,
        ]);
        $create_student->assertStatus(200)->assertJsonPath('data.id', $create_student->json()['data']['id']);

        $update_student = $this->putJson('/api/students/' . $create_student->json()['data']['id'], [
            'name' => $student->name,
            "school_id" => $student->school_id,
        ]);
        $update_student->assertStatus(200)->assertJsonPath('data.id', $update_student->json()['data']['id']);

    }

    public function test_delete_student_endpoint_return_status_ok() {
        $this->set_token();
        $delete_student = $this->deleteJson('/api/students/' . Student::factory()->create()->id);
        $delete_student->assertStatus(200);
    }

}
