<?php

namespace Timmoh\MailcoachCustomPlaceholder\Http\App\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Timmoh\MailcoachCustomPlaceholder\Rules\PlaceholderNamingRule;
use Timmoh\MailcoachCustomPlaceholder\Rules\ReservedPlaceholderRule;

class CreatePlaceholderRequest extends FormRequest {

    public function rules() {
        $emailList = $this->route()->parameter('emailList');

        return [
            'name' => [
                'required',
                'min:3',
                new PlaceholderNamingRule(),
                Rule::unique('mailcoach_email_list_placeholders')->where('email_list_id', $emailList->id),
                new ReservedPlaceholderRule($emailList),
            ],
        ];
    }
}
