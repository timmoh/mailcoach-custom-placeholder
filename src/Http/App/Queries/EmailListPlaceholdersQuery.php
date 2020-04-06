<?php

namespace Timmoh\MailcoachCustomPlaceholder\Http\App\Queries;

use Spatie\Mailcoach\Http\App\Queries\Filters\FuzzyFilter;
use Spatie\Mailcoach\Models\EmailList;
use Spatie\Mailcoach\Models\Placeholder;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class EmailListPlaceholdersQuery extends QueryBuilder {

    public function __construct(EmailList $emailList) {
        /*$query = Placeholder::query()
            ->addSelect(['subscriber_count' => function (Builder $query) {
                $query
                    ->selectRaw('count(id)')
                    ->from('mailcoach_email_list_subscriber_tags')
                    ->whereColumn('mailcoach_email_list_subscriber_tags.tag_id', 'mailcoach_tags.id');
            }]);*/
        $query = Placeholder::query();

        parent::__construct($query);

        $this
            ->where('email_list_id', $emailList->id)
            ->defaultSort('name')
            ->allowedSorts('name', 'replace_value')
            ->allowedFilters(
                AllowedFilter::custom('search',
                    new FuzzyFilter(
                        'name'
                    ))
            );
    }
}
