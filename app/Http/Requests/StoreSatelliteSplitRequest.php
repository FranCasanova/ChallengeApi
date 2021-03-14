<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class StoreSatelliteSplitRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    public function validationData()
    {
        $this->merge([
            'satellite' => [
                'name' => $this->satellite_name,
                'distance' => $this->distance,
                'message' => $this->message
            ]
        ]);
        return $this->all();
    }
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $satellite_names = ['kenobi', 'skywalker', 'sato'];
        return [
            'satellite.name' => [ 'required', 'string', Rule::in($satellite_names) ],
            'satellite.distance' => 'required|numeric',
            'satellite.message' => 'required|array',

        ];
    }
}
