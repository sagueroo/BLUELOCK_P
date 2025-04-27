<x-app-layout>
    <link rel="stylesheet" href="{{ asset('css/clubs/all_challenges.css') }}">

    <div class="challenges-container">
        <h1 class="page-title">All Challenges</h1>

        <!-- Post Challenges -->
        <h2 class="section-title">Publish Posts</h2>
        <div class="challenge-list">
            <div class="challenge-card">Publish 10 posts
                <span class="reward">250 <img src="{{ asset('pictures/coin.png') }}" alt="Coin" class="reward-icon"></span>
            </div>
            <div class="challenge-card">Publish 20 posts
                <span class="reward">400 <img src="{{ asset('pictures/coin.png') }}" alt="Coin" class="reward-icon"></span>
            </div>
            <div class="challenge-card">Publish 50 posts
                <span class="reward">800 <img src="{{ asset('pictures/coin.png') }}" alt="Coin" class="reward-icon"></span>
            </div>
            <div class="challenge-card">Publish 100 posts
                <span class="reward">1200 <img src="{{ asset('pictures/coin.png') }}" alt="Coin" class="reward-icon"></span>
            </div>
            <div class="challenge-card">Publish 200 posts
                <span class="reward">2000 <img src="{{ asset('pictures/coin.png') }}" alt="Coin" class="reward-icon"></span>
            </div>
            <div class="challenge-card">Publish 500 posts
                <span class="reward">5000 <img src="{{ asset('pictures/coin.png') }}" alt="Coin" class="reward-icon"></span>
            </div>
        </div>

        <!-- Follower Challenges -->
        <h2 class="section-title">Gain Followers</h2>
        <div class="challenge-list">
            <div class="challenge-card">Reach 5 followers
                <span class="reward">150 <img src="{{ asset('pictures/coin.png') }}" alt="Coin" class="reward-icon"></span>
            </div>
            <div class="challenge-card">Reach 10 followers
                <span class="reward">300 <img src="{{ asset('pictures/coin.png') }}" alt="Coin" class="reward-icon"></span>
            </div>
            <div class="challenge-card">Reach 50 followers
                <span class="reward">700 <img src="{{ asset('pictures/coin.png') }}" alt="Coin" class="reward-icon"></span>
            </div>
            <div class="challenge-card">Reach 100 followers
                <span class="reward">1200 <img src="{{ asset('pictures/coin.png') }}" alt="Coin" class="reward-icon"></span>
            </div>
            <div class="challenge-card">Reach 500 followers
                <span class="reward">3000 <img src="{{ asset('pictures/coin.png') }}" alt="Coin" class="reward-icon"></span>
            </div>
            <div class="challenge-card">Reach 1000 followers
                <span class="reward">6000 <img src="{{ asset('pictures/coin.png') }}" alt="Coin" class="reward-icon"></span>
            </div>
            <div class="challenge-card">Reach 10,000 followers
                <span class="reward">20,000 <img src="{{ asset('pictures/coin.png') }}" alt="Coin" class="reward-icon"></span>
            </div>
        </div>

        <!-- Club & Events Challenges -->
        <h2 class="section-title">Clubs & Events</h2>
        <div class="challenge-list">
            <div class="challenge-card">Join a club
                <span class="reward">500 <img src="{{ asset('pictures/coin.png') }}" alt="Coin" class="reward-icon"></span>
            </div>
            <div class="challenge-card">Participate in 5 events
                <span class="reward">800 <img src="{{ asset('pictures/coin.png') }}" alt="Coin" class="reward-icon"></span>
            </div>
            <div class="challenge-card">Win 3 event matches
                <span class="reward">1500 <img src="{{ asset('pictures/coin.png') }}" alt="Coin" class="reward-icon"></span>
            </div>
        </div>

        <!-- Bonus Challenges -->
        <h2 class="section-title">Bonus</h2>
        <div class="challenge-list">
            <div class="challenge-card">Join the Barcelona club
                <span class="reward">400 <img src="{{ asset('pictures/coin.png') }}" alt="Coin" class="reward-icon"></span>
            </div>
            <div class="challenge-card">Buy a jersey
                <span class="reward">1000 <img src="{{ asset('pictures/coin.png') }}" alt="Coin" class="reward-icon"></span>
            </div>
            <div class="challenge-card">Upload a profile picture
                <span class="reward">500 <img src="{{ asset('pictures/coin.png') }}" alt="Coin" class="reward-icon"></span>
            </div>
        </div>

    </div>
</x-app-layout>
