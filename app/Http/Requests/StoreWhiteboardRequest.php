<?php

namespace App\Http\Requests;

use Illuminate\Support\Facades\Gate;
use App\Models\Whiteboard;
use Illuminate\Foundation\Http\FormRequest;

class StoreWhiteboardRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return Gate::allows('create', Whiteboard::class);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name'        => 'required|string|max:255',
            'description' => 'nullable|string',
        ];
    }
}
