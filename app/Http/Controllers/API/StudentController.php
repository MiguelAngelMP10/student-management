<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreStudentRequest;
use App\Mail\WelcomeStudentMail;
use App\Models\Student;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class StudentController extends Controller
{
    public function store(StoreStudentRequest $request): JsonResponse
    {
        $data = $request->validated();
        $data['registration_number'] = $this->generateRegistrationNumber();

        $student = Student::create($data);

        Mail::to($student->email)->send(new WelcomeStudentMail($student));

        return response()->json($student->load('branch'), 201);
    }

    private function generateRegistrationNumber(): string
    {
        $year = now()->year;
        $count = Student::whereYear('created_at', $year)->count() + 1;

        return 'UNI' . $year . str_pad($count, 3, '0', STR_PAD_LEFT);
    }

    public function index(): Collection
    {
        return Student::with('branch')->latest()->get();
    }

    public function show($registration_number): JsonResponse
    {
        $student = Student::with('branch')
            ->where('registration_number', $registration_number)
            ->firstOrFail();

        return response()->json($student);
    }
}
