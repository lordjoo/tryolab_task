<?php

namespace Tests\Feature;

use App\Models\Student;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class StudentApiResourceTest extends TestCase
{
//    use RefreshDatabase;

    public function test_resource() {
        $user = User::factory()->make();
        $user->save();
        $user->refresh();
        $token = $this->postJson('/api/auth/login', [
            'email' => $user->email,
            'password' => 'password'
        ]);
        $token->assertStatus(200)->assertJsonPath('data.token', $token->json()['data']['token']);
        $token = $token->json()["data"]['token'];

        $this->assertNotEmpty($token);
        $this->withHeader('Authorization', 'Bearer ' . $token);
        $this->getJson('/api/students')->assertStatus(200);

        $student = Student::factory()->make();
        $create_student = $this->postJson('/api/students', [
            'name' => $student->name,
            "school_id" => $student->school_id,
        ]);
        $create_student->assertStatus(200)->assertJsonPath('data.id', $create_student->json()['data']['id']);

        // try update student
        $update_student = $this->putJson('/api/students/' . $create_student->json()['data']['id'], [
            'name' => $student->name,
            "school_id" => $student->school_id,
        ]);
        $update_student->assertStatus(200)->assertJsonPath('data.id', $update_student->json()['data']['id']);

        // try to delete student
        $delete_student = $this->deleteJson('/api/students/' . $create_student->json()['data']['id']);
        $delete_student->assertStatus(200);
    }

}
