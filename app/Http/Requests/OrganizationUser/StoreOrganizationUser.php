<?php

namespace App\Http\Requests\OrganizationUser;

use App\Models\Organization;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreOrganizationUser extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        $organization = $this->route('organization');
        return auth()->user()->can('storeOrganizationUser', $organization);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'user_id' => ['required', 'exists:users,id'],
            'role' => ['required', 'string', 'max:20'],
        ];
    }

    public function messages(): array
    {
        return [
            'user_id.required' => 'The user field is required',
            'user_id.exists' => 'The selected user does not exist',
            'role.required' => 'the role is required',
            'role.max' => 'The role must not exceed 20 characters',
        ];
    }
}
