@extends('layouts.app')

@section('content')
<div class="container mx-auto">
    <div class="w-full flex flex-row">
        <div class="w-1/4 p-4">
            Menú
        </div>
        <div class="w-3/4 p-4 bg-white rounded-md h-auto">
            <router-view></router-view>
        </div>
    </div>
    
</div>
    
@endsection
