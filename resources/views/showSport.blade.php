<x-app-layout>
    <h1>CHOOSE YOUR SPORT</h1>
    <div class="main">
    @foreach($sports as $sport)
            <div class="sport">
                <p>{{$sport->name}}</p>
                @if($sport->isRegistered)
                    <form action="{{ route('deleteSport') }}" method="POST">
                        @csrf
                        <input type="hidden" name="sport_id" value="{{ $sport->id }}">
                        <button type="submit" class="locker-btn2" >ALREADY REGISTERED</button>
                    </form>

                @else
                    <form action="{{ route('addSport') }}" method="POST">
                        @csrf
                        <input type="hidden" name="sport_id" value="{{ $sport->id }}">
                        <button type="submit" class="locker-btn">REGISTER</button>
                    </form>
                @endif
            </div>
    @endforeach
    </div>
    <x-trending />
</x-app-layout>
<style>

    h1 {
        text-align: center;
        font-style: oblique;
    }

    .main {
        display: flex;
        flex-wrap: wrap;
        justify-content: space-between;
        align-content: center;
        align-items: center;
    }

    .sport {
        border: #dbdbdb 1px solid;
        flex: 1 1 30%;
        margin: 10px;
        padding: 40px;
        justify-content: center;
        align-items: center;
        align-content: center;
    }
    .sport p {
        padding: 8px;
        text-align: center;       /* Centre le texte */
        overflow: hidden;         /* Cache le texte qui dépasse si nécessaire */
        text-overflow: ellipsis;  /* Ajoute des points de suspension si le texte est trop long */
    }

    .locker-btn {
        flex: 1;
        padding: 10px;
        border: none;
        background-color: #009ddc;
        color: white;
        border-radius: 5px;
        cursor: pointer;
        transition: 0.3s;


    }
    .locker-btn2 {
        flex: 1;
        padding: 5px;
        background-color: white;
        border:#009ddc 1px solid;
        color: #009ddc;
        border-radius: 5px;
        cursor: pointer;
        transition: 0.3s;
    }

    .locker-btn:hover {
        background-color: #007bb5;
    }

</style>
