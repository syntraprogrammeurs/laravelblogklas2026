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

    public function messages(): array
    {
        return [
            // Name
            'name.required' => 'De naam is een verplicht veld.',
            'name.string'   => 'De naam moet tekst zijn.',
            'name.min'      => 'De naam moet minimaal :min tekens bevatten.',
            'name.max'      => 'De naam mag maximaal :max tekens bevatten.',

            // Email
            'email.required' => 'Het e-mailadres is verplicht.',
            'email.email'    => 'Voer een geldig e-mailadres in.',
            'email.max'      => 'Het e-mailadres mag maximaal :max tekens bevatten.',
            'email.unique'   => 'Dit e-mailadres is al in gebruik.',

            // Role
            'role_id.required' => 'Selecteer een rol voor deze gebruiker.',
            'role_id.integer'  => 'De geselecteerde rol is ongeldig.',
            'role_id.exists'   => 'De geselecteerde rol bestaat niet in ons systeem.',

            // Is Active & Verified
            'is_active.required' => 'Geef aan of de gebruiker actief is.',
            'is_active.boolean'  => 'De waarde voor actief is ongeldig.',
            'verified.boolean'   => 'De waarde voor geverifieerd is ongeldig.',

            // Email Verified At
            'email_verified_at.date' => 'De verificatiedatum moet een geldige datum zijn.',

            // Password
            'password.string' => 'Het wachtwoord moet uit tekst bestaan.',
            'password.min'    => 'Het wachtwoord moet minimaal :min tekens lang zijn.',
            'password.max'    => 'Het wachtwoord mag maximaal :max tekens bevatten.',

            // Password Confirmation
            'password_confirmation.required_with' => 'Bevestig het nieuwe wachtwoord.',
            'password_confirmation.same'          => 'De wachtwoorden komen niet overeen.',
        ];
    }
}
