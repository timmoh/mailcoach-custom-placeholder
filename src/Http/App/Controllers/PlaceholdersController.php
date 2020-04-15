<?php

namespace Timmoh\MailcoachCustomPlaceholder\Http\App\Controllers;

use Timmoh\MailcoachCustomPlaceholder\Http\App\Queries\EmailListPlaceholdersQuery;
use Timmoh\MailcoachCustomPlaceholder\Http\App\Requests\CreatePlaceholderRequest;
use Timmoh\MailcoachCustomPlaceholder\Http\App\Requests\UpdatePlaceholderRequest;
use Spatie\Mailcoach\Models\EmailList;
use Timmoh\MailcoachCustomPlaceholder\Models\Placeholder;

class PlaceholdersController {

    public function index(EmailList $emailList) {
        $placeholdersQuery = new EmailListPlaceholdersQuery($emailList);
        return view('mailcoach::app.emailLists.placeholder.partials.index',
            [
                'emailList'              => $emailList,
                'placeholders'           => $placeholdersQuery->paginate(),
                'totalPlaceholdersCount' => Placeholder::query()->emailList($emailList)->count(),
            ]);
    }

    public function store(CreatePlaceholderRequest $request, EmailList $emailList) {

        $placeholder = Placeholder::create([
            'name'          => $request->name,
            'description'   => $request->description,
            'replace_value' => $request->replace_value,
            'email_list_id' => $emailList->id,
        ]);
        flash()->success("Placeholder ::{$placeholder->name}:: was created.");

        return back();
    }

    public function edit(EmailList $emailList, Placeholder $placeholder) {
        return view('mailcoach::app.emailLists.placeholder.partials.edit',
            [
                'emailList'   => $emailList,
                'placeholder' => $placeholder,
            ]);
    }

    public function update(UpdatePlaceholderRequest $request, EmailList $emailList, Placeholder $placeholder) {
        $placeholder->update([
            'name'          => $request->name,
            'description'   => $request->description,
            'replace_value' => $request->replace_value,
        ]);

        flash()->success("Placeholder ::{$placeholder->name}:: was updated.");

        return redirect()->route('mailcoach.emailLists.placeholders', $emailList);
    }

    public function destroy(EmailList $emailList, Placeholder $placeholder) {
        $placeholder->delete();

        flash()->success("Placeholder ::{$placeholder->name}:: was deleted.");
        Timmoh\MailcoachCustomPlaceholder\Support\Replacers\EmailListPlaceholderReplacer::class;
        return back();
    }

    public function duplicate(EmailList $emailList, Placeholder $placeholder) {
        /** @var \Timmoh\MailcoachCustomPlaceholder\Models\Placeholder $duplicatePlaceholder */
        $duplicatePlaceholder = Placeholder::create([
            'name'          => "Duplicate.{$placeholder->name}",
            'description'   => $placeholder->description,
            'email_list_id' => $placeholder->email_list_id,
            'replace_value' => $placeholder->replace_value,
        ]);

        flash()->success("Placeholder ::{$placeholder->name}:: was duplicated.");

        return redirect()->route('mailcoach.emailLists.placeholder.edit',
            [
                $emailList,
                $duplicatePlaceholder,
            ]);
    }

}
