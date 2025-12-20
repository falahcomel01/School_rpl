<?php

namespace App\Http\Requests\Auth;

use Illuminate\Auth\Events\Lockout;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class LoginRequest extends FormRequest
{
    protected $field; // email atau username

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            "input_type" => ["required", "string"],
            "password" => ["required", "string"],
        ];
    }

    protected function prepareForValidation()
    {
        $input = $this->input("input_type");

        if (filter_var($input, FILTER_VALIDATE_EMAIL)) {
            $this->field = "email";
            $this->merge(["email" => $input]);
        } else {
            $this->field = "username";
            $this->merge(["username" => $input]);
        }
    }

    public function authenticate(): void
    {
        $this->ensureIsNotRateLimited();

        $credentials = [
            $this->field => $this->input("input_type"),
            "password" => $this->input("password"),
        ];

        if (! Auth::attempt($credentials, $this->boolean("remember"))) {
            RateLimiter::hit($this->throttleKey());

            throw ValidationException::withMessages([
                "input_type" => trans("auth.failed"),
            ]);
        }

        RateLimiter::clear($this->throttleKey());
    }

    public function ensureIsNotRateLimited(): void
    {
        if (! RateLimiter::tooManyAttempts($this->throttleKey(), 5)) {
            return;
        }

        event(new Lockout($this));

        $seconds = RateLimiter::availableIn($this->throttleKey());

        throw ValidationException::withMessages([
            'input_type' => trans('auth.throttle', [
                'seconds' => $seconds,
                'minutes' => ceil($seconds / 60),
            ]),
        ]);
    }

    public function throttleKey(): string
    {
        return Str::lower($this->input("input_type")) . '|' . $this->ip();
    }
}
