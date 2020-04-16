<?php

namespace Timmoh\MailcoachCustomPlaceholder\Http\App\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Timmoh\MailcoachCustomPlaceholder\Rules\PlaceholderNamingRule;
use Timmoh\MailcoachCustomPlaceholder\Rules\ReservedPlaceholderRule;

class UpdatePlaceholderRequest extends FormRequest {

    public function rules(): array {
        $emailList = $this->route()->parameter('emailList');

        $placeholder = $this->route()->parameter('placeholder');

        return [
            'name' => [
                'required',
                'min:3',
                new PlaceholderNamingRule(),
                Rule::unique('mailcoach_email_list_placeholders', 'name')
                    ->where('email_list_id', $emailList)
                    ->ignore($placeholder->id),
                new ReservedPlaceholderRule($emailList),
            ],
        ];
    }
}
