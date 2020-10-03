@extends('mailcoach::app.layouts.app', [
    'title' => (isset($titlePrefix) ?  $titlePrefix . ' | ' : '') . $placeholder->name
])

@section('header')
    <nav>
        <ul class="breadcrumbs">
            <li>
                <a href="{{ route('mailcoach.emailLists') }}">
                    <span class="breadcrumb">@lang('Lists')</span>
                </a>
            </li>
            <li><a href="{{ route('mailcoach.emailLists.subscribers', $placeholder->emailList) }}"><span class="breadcrumb">{{ $placeholder->emailList->name }}</span></a></li>
            <li><a href="{{ route('mailcoach.emailLists', $placeholder->emailList) }}"><span class="breadcrumb">@lang('Placeholder')</span></a></li>
            @yield('breadcrumbs')
        </ul>
    </nav>
@endsection

@section('content')
    <nav class="tabs">
        <ul>
            <x-mailcoach::navigation-item :href="route('mailcoach.emailLists.placeholder.edit', [$placeholder->emailList, $placeholder])">
                <x-mailcoach::icon-label icon="fas fa-exchange-alt" :text="__('Placeholder details')" />
            </x-mailcoach::navigation-item>
        </ul>
    </nav>

    <section class="card">
        @yield('placeholder')
    </section>
@endsection
