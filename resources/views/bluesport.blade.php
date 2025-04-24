<x-app-layout>
    <link rel="stylesheet" href="{{ asset('css/blueSport.css') }}">

    <h1>CHOOSE YOUR SPORT</h1>

    <div class="main">
        @foreach($sports as $sport)
            <div class="sport">
                <p>{{ $sport->name }}</p>
                @if($sport->isRegistered)
                    {{-- If user is already registered to this sport --}}
                    <form action="{{ route('deleteSport') }}" method="POST">
                        @csrf
                        <input type="hidden" name="sport_id" value="{{ $sport->id }}">
                        <button type="submit" class="locker-btn2">ALREADY REGISTERED</button>
                    </form>
                @else
                    {{-- If user is not registered yet --}}
                    <form action="{{ route('addSport') }}" method="POST">
                        @csrf
                        <input type="hidden" name="sport_id" value="{{ $sport->id }}">
                        <x-locker-btn />
                    </form>
                @endif
            </div>
        @endforeach
    </div>
    <x-trending />
</x-app-layout>
{{--DO--}}
