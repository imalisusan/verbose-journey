<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateTaskRequest extends FormRequest
{
    public function authorize()
    {
        return auth()->check(); 
    }

    public function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'project_id' => 'required|exists:projects,id',
        ];
    }
}
