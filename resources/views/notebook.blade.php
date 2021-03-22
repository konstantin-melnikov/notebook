@extends('layouts.base')

@section('title', config('app.name') . ' - ' . 'Абоненты')

@section('content')
<div vue-app>
    <subscriber-page></subscriber-page>
</div>
@endsection
