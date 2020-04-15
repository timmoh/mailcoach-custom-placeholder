<?php

namespace Timmoh\MailcoachCustomPlaceholder\Support\Replacers;

use Spatie\Mailcoach\Models\Campaign;
use Timmoh\MailcoachCustomPlaceholder\Models\Placeholder;

class EmailListPlaceholderReplacer {

    public function helpText(): array {
        //$placeholders = $campaign->emailList()->placeholders()->pluck(['name','description']);
        return [];
    }

    public function replace(string $html, Campaign $campaign): string {
        $html         = $campaign->email_html;
        $placeholders = Placeholder::where(['email_list_id' => $campaign->emailList->id])->get();
        foreach ($placeholders as $placeholder) {
            $html = str_ireplace('::' . $placeholder->name . '::', $placeholder->replace_value, $html);
        }
        return $html;
    }
}
