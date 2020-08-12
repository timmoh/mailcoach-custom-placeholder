<?php

namespace Timmoh\MailcoachCustomPlaceholder\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\Mailcoach\Models\EmailList;

class Placeholder extends Model
{
    public $table = 'mailcoach_email_list_placeholders';

    public $guarded = [];

    public $casts = [
        'name' => 'string',
        'description' => 'string',
        'replace_value' => 'string',
    ];

    public function emailList(): BelongsTo
    {
        return $this->belongsTo(EmailList::class);
    }

    public function scopeEmailList(Builder $query, EmailList $emailList): void
    {
        $query->where('email_list_id', $emailList->id);
    }
}
