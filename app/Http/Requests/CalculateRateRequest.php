<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CalculateRateRequest extends FormRequest
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
            'rate.origin.address.line1' => 'required|string|max:50',
            'rate.origin.address.line2' => 'nullable|string|max:50',
            'rate.origin.address.line3' => 'nullable|string|max:50',
            'rate.origin.address.city' => 'nullable|string|max:50|required_without:rate.origin.address.postalCode',
            'rate.origin.address.countryCode' => 'required|string|size:2',
            'rate.origin.address.postalCode' => 'nullable|required_without:rate.origin.address.city|string|max:30',
            'rate.origin.address.stateOrProvinceCode' => 'nullable|string|max:100',

            'rate.destination.address.line1' => 'required|string|max:50',
            'rate.destination.address.line2' => 'nullable|string|max:50',
            'rate.destination.address.line3' => 'nullable|string|max:50',
            'rate.destination.address.city' => 'nullable|string|max:50|required_without:rate.destination.address.postalCode',
            'rate.destination.address.countryCode' => 'required|string|size:2',
            'rate.destination.address.postalCode' => 'nullable|required_without:rate.destination.address.city|string|max:30',
            'rate.destination.address.stateOrProvinceCode' => 'nullable|string|max:100',

            'rate.details.dimensions.length' => 'nullable|numeric|max:100|required_with:rate.details.dimensions.width|required_with:rate.details.dimensions.height',
            'rate.details.dimensions.width' => 'nullable|numeric|max:100|required_with:rate.details.dimensions.length|required_with:rate.details.dimensions.height',
            'rate.details.dimensions.height' => 'nullable|numeric|max:100|required_with:rate.details.dimensions.length|required_with:rate.details.dimensions.width',
            'rate.details.dimensions.unit' => 'nullable|string|in:CM,M|required_with:rate.details.dimensions.length|required_with:rate.details.dimensions.width|required_with:rate.details.dimensions.length',
            'rate.details.actualWeight' => 'required|array',
            'rate.details.actualWeight.value' => 'required|numeric',
            'rate.details.actualWeight.weightUnit' => 'nullable|string|in:KG,LB',
            'rate.details.origin' => 'required|string|size:2',
            'rate.details.numberOfPieces' => 'required|integer|max:100|min:1',
            'rate.details.productGroup' => 'required|string|size:3|in:EXP,DOM',
            'rate.details.productType' => 'required|string|size:3|in:PDX,PPX,PLX,DDX,DPX,GDX,GPX,EXP,OND',
            'rate.details.paymentType' => 'required|size:1|in:P,C,3',
            'rate.details.paymentOptions' => 'nullable|required_if:rate.details.paymentType,C|string|in:ASCC,ARCC,CASH,ACCT,PPST,CRDT',
            'rate.details.services' => 'nullable|array|max:25',
            'rate.details.descOfGoods' => 'required|string|max:100',
            'rate.details.customsValue' => 'nullable|array',
            'rate.details.customsValue.currency' => 'nullable|string|size:3|required_with:rate.details.customsValue.amount',
            'rate.details.customsValue.amount' => 'nullable|numeric|required_with:rate.details.customsValue.currency|required_if:productType,PPX,DPX,GDX,DPX,EPX',
            'rate.details.services' => 'nullable|array|max:25',
            'rate.details.cashOnDelivery.currency' => 'nullable|string|size:3|required_with:rate.details.cashOnDelivery.amount',
            'rate.details.cashOnDelivery.amount' => ['nullable', 'numeric', 'required_with:rate.details.cashOnDelivery.currency', function ($attribute, $value, $fail) {
                preg_match('/^shipments\.(\d+)\./', $attribute, $matches);
                $index = $matches[1] ?? null;

                if ($index !== null) {
                    $services = $this->input("shipments.$index.details.services");

                    if (in_array('COD', $services ?? [])) {
                        if (empty($value)) {
                            $fail($attribute . ' is required when services contains COD.');
                        }
                    }
                }
            }],
            'rate.details.insurance.currency' => 'nullable|string|size:3|required_with:rate.details.insurance.amount',
            'rate.details.insurance.amount' => 'nullable|numeric|required_with:rate.details.insurance.currency',
            'rate.details.additional.currency' => 'nullable|string|size:3|required_with:rate.details.additional.amount',
            'rate.details.additional.amount' => 'nullable|numeric|required_with:rate.details.additional.currency',
            'rate.details.additional.desc' => ['nullable', 'string', function ($attribute, $value, $fail) {
                preg_match('/^shipments\.(\d+)\./', $attribute, $matches);
                $index = $matches[1] ?? null;

                if ($index !== null) {
                    $paymentType = $this->input("shipments.$index.details.paymentType");
                    $additionalAmount = $this->input("shipments.$index.details.additionalAmount");

                    if ($paymentType == 3 && $additionalAmount) {
                        if (empty($value)) {
                            $fail($attribute . ' is required when paymentType is 3 and additionalAmount is filled.');
                        }
                    }
                }
            }],
            'rate.details.collect.currency' => 'nullable|string|size:3|required_with:rate.details.collect.amount',
            'rate.details.collect.amount' => ['nullable', 'required_with:rate.details.collect.currency', function ($attribute, $value, $fail) {
                preg_match('/^shipments\.(\d+)\./', $attribute, $matches);
                $index = $matches[1] ?? null;

                if ($index !== null) {
                    $paymentType = $this->input("shipments.$index.details.paymentType");
                    $paymentOptions = $this->input("shipments.$index.details.paymentOptions");

                    if ($paymentType == 'C' && $paymentOptions == 'ARCC') {
                        if (empty($value)) {
                            $fail($attribute . ' is required when paymentType is C and paymentOptions is ARCC.');
                        }
                    }
                }
            }],
            'rate.details.items.*.packagetype' => 'nullable|string|required_with:items.*.quantity|required_with:items.*.weight|required_with:items.*.weightUnit|required_with:items.*.comments',
            'rate.details.items.*.quantity' => 'nullable|integer|min:1|max:100|required_with:items.*.packagetype|required_with:items.*.weight|required_with:items.*.weightUnit|required_with:items.*.comments',
            'rate.details.items.*.weight' => 'nullable|numeric|required_with:items.*.packagetype|required_with:items.*.quantity|required_with:items.*.weightUnit|required_with:items.*.comments',
            'rate.details.items.*.weightUnit' => 'nullable|string|in:KG,LB',
            'rate.details.items.*.comments' => 'nullable|string|max:1000|required_with:items.*.packagetype|required_with:items.*.weight|required_with:items.*.weightUnit|required_with:items.*.quantity',
            'rate.preferedCurrency' => 'nullable|string|size:3',
        ];
    }
}
