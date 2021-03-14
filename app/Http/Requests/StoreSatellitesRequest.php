<?php

namespace App\Http\Requests;

use League\Flysystem\Config;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class StoreSatellitesRequest extends FormRequest
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

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $satellite_names = ['kenobi', 'skywalker', 'sato'];
        return [
            'satellites' => 'required|array|size:3',
            'satellites.*.name' => [ 'required', 'string', Rule::in($satellite_names) ],
            'satellites.*.distance' => 'required|numeric',
            'satellites.*.message' => 'required|array',

        ];
    }
}
