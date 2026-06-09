<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name') ?? 'JobLister' }}</title>

    <link rel="shortcut icon" type="image/png" href="{{ asset('images/logo/joblister.png') }}" />

    <link rel="dns-prefetch" href="//fonts.gstatic.com">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">

    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    @stack('css')
</head>

<body>

    @yield('layout-holder')

    @if(!session()->has('db_connection'))
    <!-- DB Selector Modal -->
    <div class="modal fade" id="dbSelectorModal" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title">Choisir la base de données</h5>
                </div>
                <div class="modal-body">
                    <p>Veuillez choisir la base de données à utiliser pour cette session :</p>
                    <p class="text-muted small">Sélectionnez <strong>MySQL</strong> si vous êtes en ligne, ou <strong>SQLite</strong> si vous êtes hors ligne.</p>
                </div>
                <div class="modal-footer justify-content-center">
                    <form action="{{ route('set-database') }}" method="POST" class="w-100 d-flex justify-content-around">
                        @csrf
                        <button type="submit" name="db_connection" value="mysql" class="btn btn-primary">MySQL (En ligne)</button>
                        <button type="submit" name="db_connection" value="sqlite" class="btn btn-secondary">SQLite (Hors ligne)</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @push('js')
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            $('#dbSelectorModal').modal({
                backdrop: 'static',
                keyboard: false
            });
            $('#dbSelectorModal').modal('show');
        });
    </script>
    @endpush
    @endif

    @include('sweetalert::alert')

    <script src="{{ asset('js/app.js') }}"></script>

    @stack('js')

</body>
</html>