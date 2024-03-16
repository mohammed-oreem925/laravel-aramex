<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateShipmentRequest extends FormRequest
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
            'shipments.*.reference1' => 'nullable|string|max:50',
            'shipments.*.reference2' => 'nullable|string|max:50',
            'shipments.*.reference3' => 'nullable|string|max:50',

            'shipments.*.foreignHAWB' => 'nullable|string|max:50|required_with:shipments.*.details.number',
            'shipments.*.transporttype' => 'nullable|integer|in:0,1',

            'shipments.*.shipper.reference1' => 'nullable|string|max:50',
            'shipments.*.shipper.reference2' => 'nullable|string|max:50',
            'shipments.*.shipper.address.line1' => 'required|string|max:50',
            'shipments.*.shipper.address.line2' => 'nullable|string|max:50',
            'shipments.*.shipper.address.line3' => 'nullable|string|max:50',
            'shipments.*.shipper.address.city' => 'nullable|string|max:50|required_without:shipments.*.shipper.address.postalCode',
            'shipments.*.shipper.address.countryCode' => 'required|string|size:2',
            'shipments.*.shipper.address.postalCode' => 'nullable|required_without:shipments.*.shipper.address.city|string|max:30',
            'shipments.*.shipper.address.stateOrProvinceCode' => 'nullable|string|max:100',
            'shipments.*.shipper.contact.department' => 'nullable|string|max:50',
            'shipments.*.shipper.contact.name' => 'required|string|max:50',
            'shipments.*.shipper.contact.title' => 'nullable|string|max:50',
            'shipments.*.shipper.contact.company' => 'required|string|max:50',
            'shipments.*.shipper.contact.phone1' => 'required|string|max:30',
            'shipments.*.shipper.contact.phoneExt1' => 'nullable|string|max:20',
            'shipments.*.shipper.contact.phone2' => 'nullable|string|max:30',
            'shipments.*.shipper.contact.phoneExt2' => 'nullable|string|max:20',
            'shipments.*.shipper.contact.fax' => 'nullable|string|max:30',
            'shipments.*.shipper.contact.cell' => 'required|string|max:30',
            'shipments.*.shipper.contact.email' => 'required|string|max:50',
            'shipments.*.shipper.contact.type' => 'nullable|string|max:50',

            'shipments.*.consignee.reference1' => 'nullable|string|max:50',
            'shipments.*.consignee.reference2' => 'nullable|string|max:50',
            'shipments.*.consignee.address.line1' => 'required|string|max:50',
            'shipments.*.consignee.address.line2' => 'nullable|string|max:50',
            'shipments.*.consignee.address.line3' => 'nullable|string|max:50',
            'shipments.*.consignee.address.city' => 'nullable|required_without:shipments.*.consignee.address.postalCode|string|max:50',
            'shipments.*.consignee.address.countryCode' => 'required|string|size:2',
            'shipments.*.consignee.address.postalCode' => 'nullable|required_without:shipments.*.consignee.address.city|string|max:30',
            'shipments.*.consignee.address.stateOrProvinceCode' => 'nullable|string|max:100',
            'shipments.*.consignee.contact.department' => 'nullable|string|max:50',
            'shipments.*.consignee.contact.name' => 'required|string|max:50',
            'shipments.*.consignee.contact.title' => 'nullable|string|max:50',
            'shipments.*.consignee.contact.company' => 'required|string|max:50',
            'shipments.*.consignee.contact.phone1' => 'required|string|max:30',
            'shipments.*.consignee.contact.phoneExt1' => 'nullable|string|max:20',
            'shipments.*.consignee.contact.phone2' => 'nullable|string|max:30',
            'shipments.*.consignee.contact.phoneExt2' => 'nullable|string|max:20',
            'shipments.*.consignee.contact.fax' => 'nullable|string|max:30',
            'shipments.*.consignee.contact.cell' => 'required|string|max:30',
            'shipments.*.consignee.contact.email' => 'required|string|max:50',
            'shipments.*.consignee.contact.type' => 'nullable|string|max:50',

            'shipments.*.thirdParty.reference1' => 'nullable|string|max:50',
            'shipments.*.thirdParty.reference2' => 'nullable|string|max:50',
            'shipments.*.thirdParty.address.line1' => 'nullable|required_if:shipments.*.details.paymentType,3|string|max:50',
            'shipments.*.thirdParty.address.line2' => 'nullable|string|max:50',
            'shipments.*.thirdParty.address.line3' => 'nullable|string|max:50',
            'shipments.*.thirdParty.address.city' => ['nullable', 'string', 'max:50', function ($attribute, $value, $fail) {
                preg_match('/^shipments\.(\d+)\./', $attribute, $matches);
                $index = $matches[1] ?? null;

                if ($index !== null) {
                    $paymentType = $this->input("shipments.$index.details.paymentType");
                    $thirdPartyPostalCode = $this->input("shipments.$index.thirdParty.address.postalCode");

                    if ($paymentType == 3 && empty($thirdPartyPostalCode) && empty($value)) {
                        $fail($attribute . ' is required when paymentType is 3 and third Party PostalCode is not filled.');
                    }
                }
            }],
            'shipments.*.thirdParty.address.countryCode' => 'nullable|required_if:shipments.*.details.paymentType,3|string|size:2',
            'shipments.*.thirdParty.address.postalCode' => ['nullable', 'string', 'max:30', function ($attribute, $value, $fail) {
                preg_match('/^shipments\.(\d+)\./', $attribute, $matches);
                $index = $matches[1] ?? null;

                if ($index !== null) {
                    $paymentType = $this->input("shipments.$index.details.paymentType");
                    $thirdPartyCity = $this->input("shipments.$index.thirdParty.address.city");

                    if ($paymentType == 3 && empty($thirdPartyCity) && empty($value)) {
                        $fail($attribute . ' is required when paymentType is 3 and third Party City is not filled.');
                    }
                }
            }],
            'shipments.*.thirdParty.address.stateOrProvinceCode' => 'nullable|string|max:100',
            'shipments.*.thirdParty.contact.department' => 'nullable|string|max:50',
            'shipments.*.thirdParty.contact.name' => 'nullable|required_if:shipments.*.details.paymentType,3|string|max:50',
            'shipments.*.thirdParty.contact.title' => 'nullable|string|max:50',
            'shipments.*.thirdParty.contact.company' => 'nullable|required_if:shipments.*.details.paymentType,3|string|max:50',
            'shipments.*.thirdParty.contact.phone1' => 'nullable|required_if:shipments.*.details.paymentType,3|string|max:30',
            'shipments.*.thirdParty.contact.contact.phoneExt1' => 'nullable|string|max:20',
            'shipments.*.thirdParty.contact.phone2' => 'nullable|string|max:30',
            'shipments.*.thirdParty.contact.phoneExt2' => 'nullable|string|max:20',
            'shipments.*.thirdParty.contact.fax' => 'nullable|string|max:30',
            'shipments.*.thirdParty.contact.cell' => 'nullable|required_if:shipments.*.details.paymentType,3|string|max:30',
            'shipments.*.thirdParty.contact.email' => 'nullable|required_if:shipments.*.details.paymentType,3|string|max:50',
            'shipments.*.thirdParty.contact.type' => 'nullable|string|max:50',

            'shipments.*.shippingDateTime' => 'required|date|date_format:Y-m-d\TH:i',
            'shipments.*.dueDate' => 'nullable|date|date_format:Y-m-d\TH:i|after:shippingDateTime',
            'shipments.*.comments' => 'nullable|string',
            'shipments.*.pickupLocation' => 'nullable|string',
            'shipments.*.accountingInstructions' => 'nullable|string',
            'shipments.*.operationsInstructions' => 'nullable|string',
            'shipments.*.attachments' => 'nullable|array',
            'shipments.*.attachments.*' => 'nullable|file|max:2048',
            'shipments.*.pickupGUID' => 'nullable|string',
            'shipments.*.number' => 'nullable|string',

            'shipments.*.details.dimensions.length' => 'nullable|numeric|max:100|required_with:shipments.*.details.dimensions.width|required_with:shipments.*.details.dimensions.height',
            'shipments.*.details.dimensions.width' => 'nullable|numeric|max:100|required_with:shipments.*.details.dimensions.length|required_with:shipments.*.details.dimensions.height',
            'shipments.*.details.dimensions.height' => 'nullable|numeric|max:100|required_with:shipments.*.details.dimensions.length|required_with:shipments.*.details.dimensions.width',
            'shipments.*.details.dimensions.unit' => 'nullable|string|in:CM,M|required_with:shipments.*.details.dimensions.length|required_with:shipments.*.details.dimensions.width|required_with:shipments.*.details.dimensions.length',
            'shipments.*.details.actualWeight' => 'required|array',
            'shipments.*.details.actualWeight.value' => 'required|numeric',
            'shipments.*.details.actualWeight.weightUnit' => 'nullable|string|in:KG,LB',
            'shipments.*.details.origin' => 'required|string|size:2',
            'shipments.*.details.numberOfPieces' => 'required|integer|max:100|min:1',
            'shipments.*.details.productGroup' => 'required|string|size:3|in:EXP,DOM',
            'shipments.*.details.productType' => 'required|string|size:3|in:PDX,PPX,PLX,DDX,DPX,GDX,GPX,EPX,OND',
            'shipments.*.details.paymentType' => 'required|size:1|in:P,C,3',
            'shipments.*.details.paymentOptions' => 'nullable|required_if:shipments.*.details.paymentType,C|string|in:ASCC,ARCC,CASH,ACCT,PPST,CRDT',
            'shipments.*.details.services' => 'nullable|array|max:25',
            'shipments.*.details.descOfGoods' => 'required|string|max:100',
            'shipments.*.details.customsValue' => 'nullable|array',
            'shipments.*.details.customsValue.currency' => 'nullable|string|size:3|required_with:shipments.*.details.customsValue.amount',
            'shipments.*.details.customsValue.amount' => 'nullable|numeric|required_with:shipments.*.details.customsValue.currency|required_if:productType,PPX,DPX,GDX,DPX,EPX',
            'shipments.*.details.services' => 'nullable|array|max:25',
            'shipments.*.details.cashOnDelivery.currency' => 'nullable|string|size:3|required_with:shipments.*.details.cashOnDelivery.amount',
            'shipments.*.details.cashOnDelivery.amount' => ['nullable', 'numeric', 'required_with:shipments.*.details.cashOnDelivery.currency', function ($attribute, $value, $fail) {
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
            'shipments.*.details.insurance.currency' => 'nullable|string|size:3|required_with:shipments.*.details.insurance.amount',
            'shipments.*.details.insurance.amount' => 'nullable|numeric|required_with:shipments.*.details.insurance.currency',
            'shipments.*.details.additional.currency' => 'nullable|string|size:3|required_with:shipments.*.details.additional.amount',
            'shipments.*.details.additional.amount' => 'nullable|numeric|required_with:shipments.*.details.additional.currency',
            'shipments.*.details.additional.desc' => ['nullable', 'string', function ($attribute, $value, $fail) {
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
            'shipments.*.details.collect.currency' => 'nullable|string|size:3|required_with:shipments.*.details.collect.amount',
            'shipments.*.details.collect.amount' => ['nullable', 'required_with:shipments.*.details.collect.currency', function ($attribute, $value, $fail) {
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
            'shipments.*.details.items.*.packagetype' => 'nullable|string|required_with:items.*.quantity|required_with:items.*.weight|required_with:items.*.weightUnit|required_with:items.*.comments',
            'shipments.*.details.items.*.quantity' => 'nullable|integer|min:1|max:100|required_with:items.*.packagetype|required_with:items.*.weight|required_with:items.*.weightUnit|required_with:items.*.comments',
            'shipments.*.details.items.*.weight' => 'nullable|numeric|required_with:items.*.packagetype|required_with:items.*.quantity|required_with:items.*.weightUnit|required_with:items.*.comments',
            'shipments.*.details.items.*.weightUnit' => 'nullable|string|in:KG,LB',
            'shipments.*.details.items.*.comments' => 'nullable|string|max:1000|required_with:items.*.packagetype|required_with:items.*.weight|required_with:items.*.weightUnit|required_with:items.*.quantity',
        ];
    }
}
