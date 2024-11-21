<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateSoftwareRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            // Validações gerais para o software
            'nome' => 'required|string|max:255',
            'tipo' => 'required|string|max:255',
            'descricao' => 'required|string',
            'peso' => 'required|string|max:255',
            'software_imagem' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',

            // Requisitos Mínimos
            'cpu_min' => 'required|string|max:255',
            'gpu_min' => 'required|string|max:255',
            'ram_min' => 'required|string|max:255',

            // Requisitos Médios
            'cpu_med' => 'nullable|string|max:255',
            'gpu_med' => 'nullable|string|max:255',
            'ram_med' => 'nullable|string|max:255',

            // Requisitos Recomendados
            'cpu_rec' => 'nullable|string|max:255',
            'gpu_rec' => 'nullable|string|max:255',
            'ram_rec' => 'nullable|string|max:255',
        ];
    }
}
