<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UserUpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        /**
         * Later vervangen we dit door policies.
         * Nu laten we update toe zolang auth/verified middleware actief is.
         */
        return true;
    }

    protected function prepareForValidation(): void
    {
        /**
         * We hergebruiken dezelfde normalisatie als bij store:
         * - checkbox verified (1/0) omzetten naar email_verified_at datetime/null
         *
         * Waarom hier?
         * - controller blijft clean
         * - view blijft simpel (checkbox)
         */
        $this->merge([
            'email_verified_at' => $this->boolean('verified') ? now() : null,
        ]);
    }

    public function rules(): array
    {
        /**
         * We halen de huidige user id uit de route.
         * Bij resource routes is de parameter meestal {user}.
         * Laravel geeft via route model binding een User instance,
         * maar hier nemen we enkel de id nodig voor unique except.
         */
        $userId = $this->route('user')?->id;

        return [
            // Basisvelden
            'name' => ['required', 'string', 'min:2', 'max:255'],

            /**
             * Email moet uniek blijven, behalve voor de huidige user.
             * Zonder ignore() zou "zelfde email bewaren" altijd falen.
             */
            'email' => [
                'required',
                'email',
                'max:255',
                Rule::unique('users', 'email')->ignore($userId),
            ],

            // Foreign key exists
            'role_id' => ['required', 'integer', Rule::exists('roles', 'id')],

            // Boolean value komt binnen als "1"/"0"
            'is_active' => ['required', 'boolean'],

            // Checkbox is optioneel
            'verified' => ['nullable', 'boolean'],

            // Genormaliseerd veld dat we effectief opslaan
            'email_verified_at' => ['nullable', 'date'],

            /**
             * Password is bij update meestal optioneel.
             * Als het leeg is, mogen we het niet wijzigen.
             */
            'password' => ['nullable', 'string', 'min:8', 'max:255'],

            /**
             * Confirmation alleen verplicht als password ingevuld is.
             * confirmed verwacht veld password_confirmation.
             */
            'password_confirmation' => ['required_with:password', 'same:password'],
        ];
    }
}
