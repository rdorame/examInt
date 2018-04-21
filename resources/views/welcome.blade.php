@extends('layouts.app')

@section('content')

            @if (Route::has('login'))
              @auth
                <div class="content">

                </div>

              @else
                <div class="content">
                    <div class="title m-b-md">
                        Warehouse Admin
                    </div>

                    <div class="links">
                        <p>Log in into your account or create a new one</p>
                    </div>
                </div>

              @endauth
            @endif

@endsection
