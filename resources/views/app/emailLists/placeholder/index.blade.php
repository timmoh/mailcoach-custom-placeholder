@extends('mailcoach::app.emailLists.layouts.edit', [
    'emailList' => $emailList,
    'titlePrefix' => __('Placeholders')
])

@section('breadcrumbs')
    <li>
        <a href="{{ route('mailcoach.emailLists.subscribers', $emailList) }}">
            <span class="breadcrumb">{{ $emailList->name }}</span>
        </a>
    </li>
    <li>
        <span class="breadcrumb">@lang('Placeholders')</span>
    </li>
@endsection

@section('emailList')
    <div class="table-actions">
        <button class="button" data-modal-trigger="create-placeholder">
            <x-mailcoach::icon-label icon="fas fa-exchange-alt" :text="__('Create placeholder')"/>
        </button>

        <x-mailcoach::modal :title="__('Create placeholder')" name="create-placeholder" :open="$errors->any()">
            @include('mailcoach::app.emailLists.placeholder.partials.create')
        </x-mailcoach::modal>

        @if($placeholders->count() || $searching)
            <div class="table-filters">
                <x-mailcoach::search :placeholder="__('Filter placeholders…')"/>
            </div>
        @endif
    </div>

    @if($placeholders->count())
        <table class="table table-fixed">
            <thead>
            <tr>
                <x-mailcoach::th sort-by="name" sort-default>@lang('Name')</x-mailcoach::th>
                <x-mailcoach::th sort-by="description" class="md:table-cell">@lang('Description')</x-mailcoach::th>
                <x-mailcoach::th sort-by="replace_value" class="">@lang('Value')</x-mailcoach::th>
                <th class="w-12"></th>
            </tr>
            </thead>
            <tbody>
            @foreach($placeholders as $placeholder)
                <tr>
                    <td class="markup-links">
                        <a class="break-words" href="{{ route('mailcoach.emailLists.placeholder.edit', [$emailList, $placeholder]) }}">
                            ::{{ $placeholder->name }}::
                        </a>
                    </td>
                    <td class="hidden | md:table-cell">{{ \Illuminate\Support\Str::of($placeholder->description)->limit(50, '...') }}</td>
                    <td class="">{{ \Illuminate\Support\Str::of($placeholder->replace_value)->limit(50, '...') }}</td>

                    <td class="td-action">
                        <div class="dropdown" data-dropdown>
                            <button class="icon-button" data-dropdown-trigger>
                                <i class="fas fa-ellipsis-v | dropdown-trigger-rotate"></i>
                            </button>
                            <ul class="dropdown-list dropdown-list-left | hidden" data-dropdown-list>
                                <li>
                                    <x-mailcoach::form-button
                                        :action="route('mailcoach.emailLists.placeholder.duplicate', [$emailList, $placeholder])"
                                    >
                                        <x-mailcoach::icon-label icon="fa-random" :text="__('Duplicate')" />
                                    </x-mailcoach::form-button>
                                </li>
                                <li>
                                    <x-mailcoach::form-button
                                        :action="route('mailcoach.emailLists.placeholder.delete', [$emailList, $placeholder])"
                                        method="DELETE" data-confirm="true" :data-confirm-text="'Are you sure you want to delete placeholder ::' . $placeholder->name . '::?'">
                                        <x-mailcoach::icon-label icon="fa-trash-alt" text="Delete" :caution="true"/>
                                    </x-mailcoach::form-button>
                                </li>
                            </ul>
                        </div>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>

        <x-mailcoach::table-status
            name="placeholder"
            :paginator="$placeholders"
            :total-count="$totalPlaceholdersCount"
            :show-all-url="route('mailcoach.emailLists.placeholders', $emailList)"
        ></x-mailcoach::table-status>
    @else
        <p class="alert alert-info">
            @if($searching)
                @lang('No placeholders found.')
            @else
                @lang('There are no placeholders for this list.')
            @endif
        </p>
    @endif
@endsection
