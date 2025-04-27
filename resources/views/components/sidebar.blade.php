<nav class="sidebar">
    <x-bluelock-logo class="sidebar-logo" />

    <ul class="menu">
        <li>
            <a href="{{ route('dashboard') }}" class="menu-item">
                <img src="{{ asset('pictures/home.png') }}" alt="Home"> <span>Home</span>
            </a>
        </li>
        <li>
            <a href="{{ route('bluesport') }}" class="menu-item">
                <img src="{{ asset('pictures/football.png') }}" alt="Sport"> <span>Sport</span>
            </a>
        </li>
        <li>
            <a href="{{ route('blueevent') }}" class="menu-item">
                <img src="{{ asset('pictures/event.png') }}" alt="Events"> <span>Events</span>
            </a>
        </li>
        <li>
            <a href="{{ route('teams.index') }}" class="menu-item">
                <img src="{{ asset('pictures/team.png') }}" alt="Team"> <span>Team</span>
            </a>
        </li>
        <li>
            <a href="{{ route('blueresult') }}" class="menu-item">
                <img src="{{ asset('pictures/result.png') }}" alt="Results"> <span>Results</span>
            </a>
        </li>
        <li>
            <a href="{{ route('profile.edit') }}" class="menu-item">
                <img src="{{ asset('pictures/setting.png') }}" alt="Settings"> <span>Settings</span>
            </a>
        </li>
        <li class="menu-item profile">
            <a href="{{ route('account.show') }}">
                <img src="{{ Auth::user()->profile_photo_path ? asset('storage/' . Auth::user()->profile_photo_path) : asset('pictures/pop.png') }}" class="nav-profile-pic" alt="Profile">
                <span>{{ Auth::user()->name }}</span>
            </a>
        </li>
    </ul>
{{--    Source ChatGPT--}}
    <a href="{{ auth()->user()->usertype === 'admin' ? route('admin.dashboard') : route('dashboard') }}">
        <button class="locker-btn1">
            {{ auth()->user()->usertype === 'admin' ? 'ADMIN' : 'LOCKER' }}
        </button>
    </a>

</nav>

<style>
    .sidebar {
        position: fixed;
        top: 0;
        left: 0;
        width: 230px;
        height: 100vh;
        background: #f6f9fc;
        border-right: 1px solid #dbe2ef;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        padding: 25px 20px;
        box-shadow: 4px 0 15px rgba(0, 0, 0, 0.05);
        font-family: 'Segoe UI', sans-serif;
    }

    .sidebar-logo {
        margin-bottom: 30px;
        text-align: center;
    }

    .menu {
        list-style: none;
        padding: 0;
        margin: 0;
        flex-grow: 1;
    }

    .menu-item {
        display: flex;
        align-items: center;
        gap: 15px;
        padding: 12px 15px;
        margin-bottom: 10px;
        text-decoration: none;
        font-size: 16px;
        font-weight: 500;
        color: #1e1e2f;
        border-radius: 12px;
        transition: all 0.25s ease-in-out;
    }

    .menu-item:hover {
        background: #e3ecfb;
        color: #009ddc;
    }

    .menu-item img {
        width: 24px;
        height: 24px;
    }

    .menu-item span {
        flex: 1;
        white-space: nowrap;
    }

    /* Profil */
    .menu-item.profile img {
        width: 35px;
        height: 35px;
        border-radius: 50%;
        object-fit: cover;
        border: 2px solid #ccc;
    }

    /* Bouton Locker */
    .locker-btn1 {
        background: #009ddc;
        color: white;
        border: none;
        padding: 12px;
        font-size: 16px;
        border-radius: 12px;
        cursor: pointer;
        transition: 0.3s;
        width: 100%;
    }

    .locker-btn1:hover {
        background-color: #007bb5;
    }


</style>
