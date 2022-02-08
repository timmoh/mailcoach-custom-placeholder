<?php

namespace Timmoh\MailcoachCustomPlaceholder\Rules;

use Illuminate\Contracts\Validation\Rule;
use Spatie\Mailcoach\Domain\Audience\Models\EmailList;

class ReservedPlaceholderRule implements Rule
{
    /**
     * @var EmailList
     */
    protected EmailList $emailList;

    /** @var string */
    protected string $attribute;

    /** @var array */
    protected array $reservedPlaceholders = [
        'webviewUrl',
        'subscriber.first_name',
        'subscriber.email',
        'list.name',
        'unsubscribeUrl',
    ];

    public function __construct(EmailList $emailList)
    {
        $this->emailList = $emailList;
    }

    public function passes($attribute, $value)
    {
        $this->attribute = $attribute;

        return ! in_array($value, $this->reservedPlaceholders);
    }

    public function message()
    {
        return __(
            'mailcoach::messages.email_list_reservedplaceholder',
            [
                'attribute' => $this->attribute,
            ]
        );
    }
}
