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
            <x-icon-label icon="fas fa-exchange-alt" text="Create placeholder"/>
        </button>

        <x-modal title="Create placeholder" name="create-placeholder" :open="$errors->any()">
            @include('mailcoach::app.emailLists.placeholder.partials.create')
        </x-modal>

        @if($placeholders->count() || $searching)
            <div class="table-filters">
                <x-search placeholder="Filter placeholders…"/>
            </div>
        @endif
    </div>

    @if($placeholders->count())
        <table class="table table-fixed">
            <thead>
            <tr>
                <x-th sort-by="name" sort-default>@lang('Name')</x-th>
                <x-th sort-by="description" class="md:table-cell">@lang('Description')</x-th>
                <x-th sort-by="replace_value" class="">@lang('Value')</x-th>
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
                    <td class="hidden | md:table-cell">{{ $placeholder->description }}</td>
                    <td class="">{{ $placeholder->replace_value }}</td>

                    <td class="td-action">
                        <div class="dropdown" data-dropdown>
                            <button class="icon-button" data-dropdown-trigger>
                                <i class="fas fa-ellipsis-v | dropdown-trigger-rotate"></i>
                            </button>
                            <ul class="dropdown-list dropdown-list-left | hidden" data-dropdown-list>
                                <li>
                                    <x-form-button
                                        :action="route('mailcoach.emailLists.placeholder.duplicate', [$emailList, $placeholder])"
                                    >
                                        <x-icon-label icon="fa-random" text="Duplicate" />
                                    </x-form-button>
                                </li>
                                <li>
                                    <x-form-button
                                        :action="route('mailcoach.emailLists.placeholder.delete', [$emailList, $placeholder])"
                                        method="DELETE" data-confirm="true" :data-confirm-text="'Are you sure you want to delete placeholder ::' . $placeholder->name . '::?'">
                                        <x-icon-label icon="fa-trash-alt" text="Delete" :caution="true"/>
                                    </x-form-button>
                                </li>
                            </ul>
                        </div>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>

        <x-table-status
            name="placeholder"
            :paginator="$placeholders"
            :total-count="$totalPlaceholdersCount"
            :show-all-url="route('mailcoach.emailLists.placeholders', $emailList)"
        ></x-table-status>
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
