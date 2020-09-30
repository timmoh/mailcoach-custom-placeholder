<?php
use Faker\Generator;
use Illuminate\Support\Str;
use Spatie\Mailcoach\Models\EmailList;
use Timmoh\MailcoachCustomPlaceholder\Models\Placeholder;

$factory->define(Placeholder::class, function (Generator $faker) {
    return [
        'name' => Str::random(10),
        'description' => $faker->sentence,
        'replace_value' => $faker->colorName,
        'email_list_id' => fn () => factory(EmailList::class)->create(['uuid' => (string)Str::uuid()]),
    ];
});
