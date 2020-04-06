<?php

namespace Timmoh\MailcoachCustomPlaceholderSupport\Support\Replacers;

use Spatie\Mailcoach\Models\Campaign;

class EmailListPlaceholderReplacer implements Replacer
{
    public function helpText(): array
    {
        //$placeholders = $campaign->emailList()->placeholders()->pluck(['name','description']);
        return [];
    }

    public function replace(string $html, Campaign $campaign): string
    {
        $html = $campaign->email_html;
        foreach($placeholders = $campaign->emailList->placeholders As $placeholder) {
            $html = str_ireplace('::'.$placeholder->name.'::', $placeholder->replace_value, $html);
        }
        return $html;
    }
}
