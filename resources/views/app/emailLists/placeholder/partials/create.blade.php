<form class="form-grid" action="{{ route('mailcoach.emailLists.placeholder.store', $emailList) }}" method="POST">
    @csrf

    <x-mailcoach::text-field :label="__('Name')" name="name" required />
    <x-mailcoach::text-field :label="__('Description')" name="description" />

    <x-mailcoach::text-field :label="__('Replacement')" name="replace_value" :placeholder="__('Replace with')" />

    <div class="form-buttons">
        <x-mailcoach::button icon="fas fa-exchange-alt" :label="__('Create placeholder')"/>
        <button type="button" class="button-cancel" data-modal-dismiss>
            @lang('Cancel')
        </button>
    </div>
</form>
