<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreSoftwareRequest extends FormRequest
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
            'nome' => 'required|string',
            'software_imagem' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Valida a imagem

            // RequisitoSoftware Mínimos
            'cpu_min' => 'required|string',  // Requisito mínimo de CPU
            'gpu_min' => 'required|string',  // Requisito mínimo de GPU
            'ram_min' => 'required|string',  // Requisito mínimo de RAM
            'placa_mae_min' => 'nullable|string',  // Requisito mínimo de Placa Mãe
            'ssd_min' => 'nullable|string',  // Requisito mínimo de SSD
            'cooler_min' => 'nullable|string',  // Requisito mínimo de Cooler
            'fonte_min' => 'nullable|string',  // Requisito mínimo de Fonte

            // RequisitoSoftware Médios
            'cpu_med' => 'required|string',  // Requisito médio de CPU
            'gpu_med' => 'required|string',  // Requisito médio de GPU
            'ram_med' => 'required|string',  // Requisito médio de RAM
            'placa_mae_med' => 'nullable|string',  // Requisito médio de Placa Mãe
            'ssd_med' => 'nullable|string',  // Requisito médio de SSD
            'cooler_med' => 'nullable|string',  // Requisito médio de Cooler
            'fonte_med' => 'nullable|string',  // Requisito médio de Fonte

            // RequisitoSoftware Recomendados
            'cpu_rec' => 'required|string',  // Requisito recomendado de CPU
            'gpu_rec' => 'required|string',  // Requisito recomendado de GPU
            'ram_rec' => 'required|string',  // Requisito recomendado de RAM
            'placa_mae_rec' => 'nullable|string',  // Requisito recomendado de Placa Mãe
            'ssd_rec' => 'nullable|string',  // Requisito recomendado de SSD
            'cooler_rec' => 'nullable|string',  // Requisito recomendado de Cooler
            'fonte_rec' => 'nullable|string',  // Requisito recomendado de Fonte
        ];
    }
}
