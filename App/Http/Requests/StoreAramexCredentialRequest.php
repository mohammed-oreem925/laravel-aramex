<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreAramexCredentialRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'username' => 'required|string',
            'password' => 'required|string',
            'country_code' => 'required|string|size:2',
            'entity' => 'required|string|size:3',
            'testNumber' => 'nullable|required_without:liveNumber|required_with:testPin|string',
            'liveNumber' => 'nullable|required_without:testNumber|required_with:livePin|string',
            'testPin' => 'nullable|required_without:livePin|required_with:testNumber|string',
            'livePin' => 'nullable|required_without:testPin|required_with:liveNumber|string',
            'user_id' => 'required|string',
        ];
    }
}
