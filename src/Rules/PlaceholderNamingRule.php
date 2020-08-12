<?php

namespace Timmoh\MailcoachCustomPlaceholder\Rules;

use Illuminate\Contracts\Validation\Rule;

class PlaceholderNamingRule implements Rule
{
    private string $message = 'Allowed chars, numbers and special characters (dot,underline,minus)';

    /** @var string */
    protected string $attribute;

    /** @var string */
    protected string $re = '/^[a-zA-Z0-9._-]+$/im';

    public function message()
    {
        return $this->message;
    }

    public function passes($attribute, $value)
    {
        $this->attribute = $attribute;

        return (preg_match($this->re, $value, $matches));
    }
}
