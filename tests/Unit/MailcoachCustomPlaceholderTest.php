<?php

namespace Timmoh\MailcoachCustomPlaceholder\Tests\Unit;

use Faker\Generator;
use Spatie\Mailcoach\Models\Campaign;
use Spatie\Mailcoach\Models\EmailList;
use Spatie\Snapshots\MatchesSnapshots;
use Timmoh\MailcoachCustomPlaceholder\Models\Placeholder;
use Timmoh\MailcoachCustomPlaceholder\Tests\Support\MailcoachCustomPlaceholderTestCase;

class MailcoachCustomPlaceholderTest extends MailcoachCustomPlaceholderTestCase {

    use MatchesSnapshots;

    /**
     * @test
     */
    public function onereplacer() {
        $faker           = app(Generator::class);
        $expectedContent = 'hello';
        $html            = "::customreplace::";

        $expectedHtml = $this->htmlbody($expectedContent);

        $emailList = EmailList::create(['name' => $faker->title]);
        /** @var \Spatie\Mailcoach\Models\Campaign */
        $campaign    = (new Campaign())->create([
            'html'          => $html,
            'email_list_id' => $emailList->id,
        ]);
        $placeholder = Placeholder::firstOrCreate([
            'name'          => 'customreplace',
            'replace_value' => $expectedContent,
            'email_list_id' => $emailList->id,
        ]);

        $this->execute($campaign);
        $campaign->refresh();
        $this->assertHtmlWithoutWhitespace($expectedHtml, $campaign->email_html);
    }

    /**
     * @test
     */
    public function oservalreplacers() {
        $faker           = app(Generator::class);
        $replacers       = ['customreplace1' => 'hello', 'customreplace2' => 'world', 'customreplace4' => 'everything ok?'];
        $expectedContent = 'helloworld::customreplace3::everything ok?';
        $html            = "::customreplace1::::customreplace2::::customreplace3::::customreplace4::";

        $expectedHtml = $this->htmlbody($expectedContent);

        $emailList = EmailList::create(['name' => $faker->title]);
        /** @var \Spatie\Mailcoach\Models\Campaign */
        $campaign = (new Campaign())->create([
            'html'          => $html,
            'email_list_id' => $emailList->id,
        ]);

        foreach ($replacers as $key => $value) {
            $placeholder = Placeholder::firstOrCreate([
                'name'          => $key,
                'replace_value' => $value,
                'email_list_id' => $emailList->id,
            ]);
        }

        $this->execute($campaign);
        $campaign->refresh();
        $this->assertHtmlWithoutWhitespace($expectedHtml, $campaign->email_html);
    }
}
