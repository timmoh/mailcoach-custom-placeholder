<x-mailcoach::layout-list
    :title="$placeholder->name"
    :originTitle="__('Placeholder')"
    :originHref="route('mailcoach.emailLists.placeholders', ['emailList' => $emailList])"
    :emailList="$emailList"
>

    <form
        class="form-grid"
        action="{{ route('mailcoach.emailLists.placeholder.edit', [$emailList, $placeholder]) }}"
        method="POST"
    >
        @csrf
        @method('PUT')

        <x-mailcoach::text-field :label="__('Name')" name="name" :value="$placeholder->name" required />
        <x-mailcoach::text-field :label="__('Description')" name="description" :value="$placeholder->description" />
        <x-mailcoach::html-field :label="__('Replacement')" name="replace_value" :value="$placeholder->replace_value" :placeholder="__('Replace with')" />


        <div class="form-buttons">
            <x-mailcoach::button :label="__('Save placeholder')" />
        </div>
    </form>
</x-mailcoach::layout-list>
