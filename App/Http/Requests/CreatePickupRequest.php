<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreatePickupRequest extends FormRequest
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
            'pickup' => 'required|array',
            'pickup.pickupAddress' => 'required|array',
            'pickup.pickupAddress.line1' => 'required|string|max:50',
            'pickup.pickupAddress.line2' => 'nullable|string|max:50',
            'pickup.pickupAddress.line3' => 'nullable|string|max:50',
            'pickup.pickupAddress.city' => 'nullable|string|max:50|required_without:pickup.pickupAddress.postalCode',
            'pickup.pickupAddress.countryCode' => 'required|string|size:2',
            'pickup.pickupAddress.postalCode' => 'nullable|required_without:pickup.pickupAddress.city|string|max:30',
            'pickup.pickupAddress.stateOrProvinceCode' => 'nullable|string|max:100',

            'pickup.pickupContact' => 'required|array',
            'pickup.pickupContact.department' => 'nullable|string|max:50',
            'pickup.pickupContact.name' => 'required|string|max:50',
            'pickup.pickupContact.title' => 'nullable|string|max:50',
            'pickup.pickupContact.company' => 'required|string|max:50',
            'pickup.pickupContact.phone1' => 'required|string|max:30',
            'pickup.pickupContact.phoneExt1' => 'nullable|string|max:20',
            'pickup.pickupContact.phone2' => 'nullable|string|max:30',
            'pickup.pickupContact.phoneExt2' => 'nullable|string|max:20',
            'pickup.pickupContact.fax' => 'nullable|string|max:30',
            'pickup.pickupContact.cell' => 'required|string|max:30',
            'pickup.pickupContact.email' => 'required|string|max:50',
            'pickup.pickupContact.type' => 'nullable|string|max:50',

            'pickup.pickupLocation' => 'required|string|max:50',
            'pickup.pickupDate' => 'required|string|max:50',
            'pickup.readyTime' => 'required|string|max:50',
            'pickup.lastPickupTime' => 'required|string|max:50',
            'pickup.closingTime' => 'required|string|max:50',
            'pickup.comments' => 'nullable|string|max:50',
            'pickup.reference1' => 'required|string|max:50',
            'pickup.reference2' => 'nullable|string|max:50',
            'pickup.vehicle' => 'nullable|string|max:50',
            'pickup.status' => 'required|string|max:10|in:Ready,Pending',

            'pickup.pickupItems' => 'required|array',
            'pickup.pickupItems.0.productGroup' => 'required|string|size:3|in:DOM,EXP',
            'pickup.pickupItems.0.productType' => 'nullable|string|size:3|in:PDX,PPX,PLX,DDX,DPX,GDX,GPX,EPX,OND',
            'pickup.pickupItems.0.paymentType' => 'required|size:1|in:P,C,3',
            'pickup.pickupItems.0.numberOfPieces' => 'required|integer|min:1|max:100',
            'pickup.pickupItems.0.shipmentWeight' => 'required|numeric|gt:0|max:100',
            'pickup.pickupItems.0.shipmentWeightUnit' => 'nullable|string|in:KG,LB',
            'pickup.pickupItems.0.numberOfShipment' => 'required|string|max:50',
            'pickup.pickupItems.0.packageType' => 'nullable|string|max:50',
            'pickup.pickupItems.0.volume.value' => 'required|numeric|max:100|gt:0',
            'pickup.pickupItems.0.volume.uit' => 'nullable|string|in:Cm3,Inch3',
            'pickup.pickupItems.0.cash.currency' => 'nullable|string|size:3',
            'pickup.pickupItems.0.cash.amount' => 'nullable|numeric|max:50',
            'pickup.pickupItems.0.extraCharges.currency' => 'nullable|string|size:3',
            'pickup.pickupItems.0.extraCharges.amount' => 'nullable|numeric|max:50',
            'pickup.pickupItems.0.dimensions.length' => 'nullable|string|max:50|required_with:pickup.pickupItems.0.dimensions.width|required_with:pickup.pickupItems.0.dimensions.height|required_with:pickup.pickupItems.0.dimensions.unit',
            'pickup.pickupItems.0.dimensions.width' => 'nullable|string|max:50|required_with:pickup.pickupItems.0.dimensions.length|required_with:pickup.pickupItems.0.dimensions.height|required_with:pickup.pickupItems.0.dimensions.unit',
            'pickup.pickupItems.0.dimensions.height' => 'nullable|string|max:50|required_with:pickup.pickupItems.0.dimensions.width|required_with:pickup.pickupItems.0.dimensions.length|required_with:pickup.pickupItems.0.dimensions.unit',
            'pickup.pickupItems.0.dimensions.unit' => 'nullable|string|max:50|required_with:pickup.pickupItems.0.dimensions.width|required_with:pickup.pickupItems.0.dimensions.height|required_with:pickup.pickupItems.0.dimensions.length',
            'pickup.pickupItems.0.comments' => 'nullable|string|max:50',

        ];
    }
}
