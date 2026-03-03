<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UserIndexRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true; //later gaan we hier policies toepassen
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            // Search
//            Nullable betekent:
//het veld mag ontbreken of null zijn, verdere validatie wordt dan niet toegepast.
//    Rule:in betekent:
//de waarde moet exact overeenkomen met één van de opgegeven toegelaten waarden. Dus enkel deze kolommen mogen gebruikt worden
            'q' => ['nullable', 'string', 'max:100'],

            // Filters
            'role' => ['nullable', 'integer', 'min:1'],
            'status' => ['nullable', Rule::in(['active', 'inactive'])],
            'verified' => ['nullable', Rule::in(['yes', 'no'])],

            // Sorting
            'sort' => ['nullable', Rule::in(['id', 'name', 'email', 'created_at', 'is_active'])],
            'dir' => ['nullable', Rule::in(['asc', 'desc'])],

            // Per page
            'per_page' => ['nullable', Rule::in([10, 25, 50, 100])],
        ];
    }
    /**
     * Defaults + normalisatie.
     * Controller en view krijgen altijd dezelfde keys en types.
     */
    public function defaults(): array
    {
        $v = $this->validated();

        return [
            'q' => (string) ($v['q'] ?? ''),

            'role' => $v['role'] ?? null,
            'status' => $v['status'] ?? null,
            'verified' => $v['verified'] ?? null,

            'sort' => (string) ($v['sort'] ?? 'created_at'),
            'dir' => (string) ($v['dir'] ?? 'desc'),

            'per_page' => (int) ($v['per_page'] ?? 10),
        ];
    }

}
