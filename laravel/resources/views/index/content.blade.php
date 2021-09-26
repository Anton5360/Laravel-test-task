@extends('index.layout')

@section('title') Test task @endsection

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/index.css') }}">
@endsection

@section('main_content')
    @if(!empty($employees))
        <employees-table :employees="{{ json_encode($employees) }}"
                         :employees-per-page="{{ json_encode($perPage) }}"
                         :pages-quantity="{{ json_encode($pagesQuantity) }}"
                         :current-page="{{ json_encode($currentPage) }}"
                         :upload-xml-route="{{ json_encode(route('upload-xml')) }}"
                         :employee-list-route="{{ json_encode(route('all-employees-list')) }}"
                         :departments="{{ json_encode($departments) }}">

            <template v-slot:success>
                @if(session()->has('success'))
                    <h2 class="success-downloading">{{ session()->get('success') }}</h2>
                @endif
            </template>
            <template v-slot:error>
                @if($errors->any())
                    <h2 class="error-downloading">{{ $errors->first() }}</h2>
                @endif
            </template>
        </employees-table>
    @else
        <empty />
    @endif
@endsection
