@extends('layouts.datatables-home-master')

@section('meta')
<meta name="csrf-token" content="{{ csrf_token() }}" />
@stop

@section('css')
<link rel="stylesheet" type="text/css" href="{{ asset('css/nav/home.css') }}" />
<link rel="stylesheet" type="text/css" href="{{ asset('css/nav/nav.css') }}" />
<link rel="stylesheet" href="{{ asset('css/app.css') }}">
<style>

</style>

@stop



@section('customjs')
<script type="text/javascript" charset="utf-8" src="./jquery.js"></script>
<script src="{{ asset('js/app.js') }}" defer></script>

@stop

<?php include 'db_mapping.php'; ?>


@section('nav')

@stop



@section('menu_action')


@stop



@section('content')
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <x-validation-errors />
                    <x-success-message />

                    <form method="POST" action="{{ route('jobbookprofile.update') }}">
                        @method('PUT')
                        @csrf
                        <div class="grid grid-cols-2 gap-6">
                            <div class="grid grid-rows-2 gap-6">
                                <div>
                                    <x-label for="name" :value="__('Name')" />
                                    <x-input id="name" class="block mt-1 w-full" type="text" name="name" value="{{ auth()->user()->name }}" autofocus />
                                </div>
                                <div>
                                    <x-label for="email" :value="__('Email')" />
                                    <x-input id="email" class="block mt-1 w-full" type="email" name="email" value="{{ auth()->user()->email }}" autofocus />
                                </div>
                            </div>
                            <div class="grid grid-rows-2 gap-6">
                                <div>
                                    <x-label for="new_password" :value="__('New password')" />
                                    <x-input id="new_password" class="block mt-1 w-full"
                                             type="password"
                                             name="password"
                                             autocomplete="new-password" />
                                </div>
                                <div>
                                    <x-label for="confirm_password" :value="__('Confirm password')" />
                                    <x-input id="confirm_password" class="block mt-1 w-full"
                                             type="password"
                                             name="password_confirmation"
                                             autocomplete="confirm-password" />
                                </div>
                            </div>
                        </div>
                        <div class="flex items-center justify-end mt-4">
                            <x-button class="ml-3">
                                {{ __('Update') }}
                            </x-button>
                        </div>
                    </form>





                </div>
            </div>
        </div>
    </div>
@stop



@push('scripts')

@endpush

