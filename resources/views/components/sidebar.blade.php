<nav class="sidebar">
    <x-bluelock-logo/>
    <ul class="menu">
        <li>
            <a href="{{ route('dashboard') }}">
                <img src="{{ asset('pictures/home.png') }}" alt="Home" class="w-6 h-6 inline mr-2"> BLUEHOME
            </a>
        </li>
        <li>
            <a href="{{ route('showSport') }}">
                <img src="{{ asset('pictures/football.png') }}" alt="Sport" class="w-6 h-6 inline mr-2"> BLUESPORT
            </a>
        </li>
        <li>
            <a href="{{ route('showEvent') }}">
                <img src="{{ asset('pictures/event.png') }}" alt="Events" class="w-6 h-6 inline mr-2"> BLUEVENT
            </a>
        </li>
        <li>
            <a href="#blueteam">
                <img src="{{ asset('pictures/team.png') }}" alt="Team" class="w-6 h-6 inline mr-2"> BLUETEAM
            </a>
        </li>
        <li>
            <a href="#bluelike">
                <img src="{{ asset('pictures/heart.png') }}" alt="Like" class="w-6 h-6 inline mr-2"> BLUELIKE
            </a>
        </li>
        <li>
            <a href="{{ route('blueresult') }}">
                <img src="{{ asset('pictures/message.png') }}" alt="Messages" class="w-6 h-6 inline mr-2"> BLUERESULT
            </a>
        </li>
        <li>
            <a href="{{ route('profile.edit') }}">
                <img src="{{ asset('pictures/setting.png') }}" alt="Settings" class="w-6 h-6 inline mr-2"> BLUESET
            </a>
        </li>

        <li class="profile">
            <a href="{{ route('account.show') }}">
                <img src="{{ Auth::user()->profile_photo_path ? asset('storage/' . Auth::user()->profile_photo_path) : asset('pictures/pop.png') }}"
                     alt="Photo de profil"
                     class="nav-profile-pic">
                {{ Auth::user()->name }}
            </a>
        </li>
    </ul>
    <button class="locker-btn1">LOCKER</button>
</nav>
<style>
    /* Sidebar générale */
    .sidebar {
        position: fixed;
        top: -65px; /* Ajuster selon la hauteur de la navbar */
        left: 0;
        background-color: #e0e5f1;
        padding: 20px;
        width: 210px;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        height: 109vh;
        box-shadow: 5px 0 10px rgba(0, 0, 0, 0.1);

    }

    /* Logo */
    .sidebar .logo img {
        width: 100%;
        margin-bottom: -110px;
    }

    /* Menu de la sidebar */
    .sidebar ul {
        list-style: none;
        padding-bottom: 10px;
        padding-left: 0px;
    }

    .sidebar ul li {
        margin: 15px 0;
    }

    .sidebar ul li a {
        text-decoration: none;
        color: #2d2d2d;
        font-weight: bold;
        display: flex;
        align-items: center;
        padding: 10px;
        border-radius: 5px;
        transition: background-color 0.3s ease;
    }

    .sidebar ul li a:hover {
        background-color: #d6dce8;
    }

    /* Photo de profil dans la navbar */
    .nav-profile-pic {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        object-fit: cover;
        margin-right: 10px;
        border: 2px solid #ddd;
    }

    /* Bouton LOCKER */
    .locker-btn1 {
        background-color: #009ddc;
        color: #fff;
        border: none;
        padding: 10px;
        font-size: 16px;
        border-radius: 5px;
        cursor: pointer;
        width: 100%;
        text-align: center;
        transition: background-color 0.3s ease;
        margin-bottom: 60px;
    }

    .locker-btn1:hover {
        background-color: #007bb5;
    }

</style>
