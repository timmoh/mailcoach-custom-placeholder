<?php

namespace Timmoh\MailcoachCustomPlaceholder\Support\Replacers;

use Spatie\Mailcoach\Models\Campaign;
use Spatie\Mailcoach\Support\Replacers\Replacer;
use Timmoh\MailcoachCustomPlaceholder\Models\Placeholder;

class EmailListPlaceholderReplacer implements Replacer
{
    public function helpText(): array
    {
        //$placeholders = Placeholder::where(['email_list_id' => $campaign->email_list_id])->get();
        return [];
    }

    public function replace(string $text, Campaign $campaign): string
    {
        $placeholders = Placeholder::where(['email_list_id' => $campaign->email_list_id])->get();
        foreach ($placeholders as $placeholder) {
            $text = str_ireplace('::' . $placeholder->name . '::', $placeholder->replace_value, $text);
        }

        return $text;
    }
}
