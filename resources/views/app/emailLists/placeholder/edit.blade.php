@extends('mailcoach::app.emailLists.layouts.placeholder', ['placeholder' => $placeholder])

@section('header')
    <nav>
        <ul class="breadcrumbs">
            <li>
                <a href="{{ route('mailcoach.emailLists') }}">
                    <span class="breadcrumb">@lang('Lists')</span>
                </a>
            </li>
            <li>
                <a href="{{ route('mailcoach.emailLists.subscribers', $placeholder->emailList) }}">
                    <span class="breadcrumb">{{ $placeholder->emailList->name }}</span>
                </a>
            </li>
            <li>
                <a href="{{ route('mailcoach.emailLists.placeholders', $emailList) }}">
                    <span class="breadcrumb">@lang('Placeholders')</span>
                </a>
            </li>
            <li>
                <span class="breadcrumb">{{ $placeholder->name }}</span>
            </li>
        </ul>
    </nav>
@endsection

@section('placeholder')
    <form
        class="form-grid"
        action="{{ route('mailcoach.emailLists.placeholder.edit', [$emailList, $placeholder]) }}"
        method="POST"
    >
        @csrf
        @method('PUT')

        <x-text-field :label="__('Name')" name="name" :value="$placeholder->name" required />
        <x-text-field :label="__('Description')" name="description" :value="$placeholder->description" />
        <x-text-field :label="__('Replacement')" name="replace_value" :value="$placeholder->replace_value" :placeholder="__('Replace with')" />


        <div class="form-buttons">
            <button type="submit" class="button">
                <x-icon-label icon="fas fa-exchange-alt" :text="__('Save placeholder')" />
            </button>
        </div>
    </form>
@endsection
