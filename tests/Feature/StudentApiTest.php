<?php

namespace Tests\Feature;

use App\Mail\WelcomeStudentMail;
use App\Models\Branch;
use App\Models\Student;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Mail;
use Tests\TestCase;

class StudentApiTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_create_student()
    {
        Mail::fake();

        $branch = Branch::factory()->create();

        $response = $this->postJson('/api/students', [
            'first_name' => 'John',
            'last_name' => 'Doe',
            'email' => 'john@example.com',
            'branch_id' => $branch->id,
        ]);

        $response->assertStatus(201);
        $this->assertDatabaseHas('students', ['email' => 'john@example.com']);

        Mail::assertSent(WelcomeStudentMail::class, function ($mail) {
            return $mail->hasTo('john@example.com');
        });
    }

    public function test_cannot_create_student_with_duplicate_email()
    {
        $branch = Branch::factory()->create();

        Student::factory()->create([
            'email' => 'john@example.com',
            'branch_id' => $branch->id,
        ]);

        $response = $this->postJson('/api/students', [
            'first_name' => 'Jane',
            'last_name' => 'Smith',
            'email' => 'john@example.com',
            'branch_id' => $branch->id,
        ]);

        $response->assertStatus(422)
            ->assertJsonValidationErrors(['email']);
    }

    public function test_can_list_students()
    {
        $branch = Branch::factory()->create();
        Student::factory()->count(3)->create(['branch_id' => $branch->id]);

        $response = $this->getJson('/api/students');

        $response->assertStatus(200)
            ->assertJsonCount(3);
    }

    public function test_can_show_student_by_registration_number()
    {
        $branch = Branch::factory()->create();

        $student = Student::factory()->create([
            'registration_number' => 'UNI2025001',
            'branch_id' => $branch->id,
        ]);

        $response = $this->getJson('/api/students/' . $student->registration_number);

        $response->assertStatus(200)
            ->assertJsonFragment([
                'registration_number' => 'UNI2025001',
                'email' => $student->email,
            ]);
    }

    public function test_cannot_create_student_with_invalid_data()
    {
        $response = $this->postJson('/api/students', [
            'first_name' => '',
            'last_name' => '',
            'email' => 'invalid-email',
            'branch_id' => 9999,
        ]);

        $response->assertStatus(422)
            ->assertJsonValidationErrors(['first_name', 'last_name', 'email', 'branch_id']);
    }
}
