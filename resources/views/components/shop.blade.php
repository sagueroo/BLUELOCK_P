<aside class="shop">
    <!-- Coins + Info -->
    <div class="coins-section">
        <img src="{{ asset('pictures/coin.png') }}" alt="Coins" class="coin-icon">
        <p>{{ Auth::user()->coins ?? 0 }} coins</p>

        <!-- Icône Info -->
        <div class="info-icon">
            ℹ️
            <div class="info-popup">
                <strong>SOON....</strong>
                <p>Coin and Tier System:</p>
                Take on challenges, earn as many coins as possible, and dominate your club!
                Use your coins to unlock rare jerseys and showcase your supremacy.
                Every completed challenge brings you closer to the top — more challenges, more rewards, more glory.
                Climb the ranks, evolve your club, and make your name stand out among the elite!

            </div>
        </div>
    </div>

    <!-- Challenges -->
    <div class="challenge-card locked">
        <h3>Challenges</h3>

        <div class="challenge">
            <p>Publish 10 posts</p>
            <span>Progress: ?? /10</span>
            <div class="reward-row">
                <small class="reward">Reward: 250
                    <img src="{{ asset('pictures/coin.png') }}" alt="Coins" class="coin-coin">
                </small>
                <button class="claim-btn" disabled>Claim</button>
            </div>
        </div>

        <div class="challenge">
            <p>Get 5 followers</p>
            <span>Progress: ?? /5</span>
            <div class="reward-row">
                <small class="reward">Reward: 150
                    <img src="{{ asset('pictures/coin.png') }}" alt="Coins" class="coin-coin">
                </small>
                <button class="claim-btn" disabled>Claim</button>
            </div>
        </div>
    </div>
    <!-- Tier System -->
    <div class="tier-card locked">
        <h3>Tiers</h3>

        <div class="tier-list">
            <div class="tier">
                <p>Junior</p><span>0 - 5 followers</span>
            </div>
            <div class="tier">
                <p>Recruit</p><span>6 - 20 followers</span>
            </div>
            <div class="tier">
                <p>Substitute</p><span>21 - 50 followers</span>
            </div>
            <div class="tier">
                <p>Starter</p><span>51 - 100 followers</span>
            </div>
            <div class="tier">
                <p>Captain</p><span>101 - 500 followers</span>
            </div>
            <div class="tier">
                <p>Legend</p><span>501 - 1000 followers</span>
            </div>
            <div class="tier">
                <p>Icon</p><span>1001 - 5000 followers</span>
            </div>
            <div class="tier">
                <p>President</p><span>5001+ followers</span>
            </div>
        </div>
    </div>


    <!-- See more -->
    <a href="{{ route('teams.challenges') }}" class="more-link">See all challenges</a>
</aside>

<style>
    .shop {
        position: fixed;
        top: 0;
        right: 0;
        width: 270px;
        height: 100vh;
        background: #f6f9fc;
        padding: 30px 20px;
        box-shadow: -4px 0 15px rgba(0, 0, 0, 0.05);
        display: flex;
        flex-direction: column;
        gap: 30px;
        font-family: 'Segoe UI', sans-serif;
    }

    /* Coins */
    .coins-section {
        display: flex;
        align-items: center;
        gap: 10px;
        position: relative;
    }

    .coin-icon {
        width: 30px;
        height: 30px;
    }

    /* Petit ballon pour récompense */
    .coin-coin {
        width: 16px;
        height: 16px;
        vertical-align: middle;
        margin-left: 5px;
    }

    /* Icône Info */
    .info-icon {
        position: relative;
        font-size: 16px;
        cursor: pointer;
    }

    .info-popup {
        display: none;
        position: absolute;
        top: 30px;
        right: 0;
        width: 200px;
        background: #007bff;
        color: white;
        padding: 10px;
        border-radius: 8px;
        font-size: 12px;
        text-align: center;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.15);
        z-index: 10;
    }

    .info-icon:hover .info-popup {
        display: block;
    }

    /* Défis */
    .challenge-card {
        background: #ece5e5;
        padding: 15px;
        border-radius: 10px;
        box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
        position: relative;
        overflow: hidden;
    }

    .challenge-card h3 {
        margin-top: 0;
        margin-bottom: 10px;
        font-size: 18px;
        color: #888888;
    }

    .challenge {
        margin-bottom: 20px;
        opacity: 0.7;
    }

    .challenge p {
        font-weight: 600;
        margin: 0;
        color: #555555;
    }

    .challenge span {
        font-size: 13px;
        color: #666666;
    }

    /* Ligne récompense + bouton */
    .reward-row {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-top: 5px;
    }

    /* Récompenses */
    .reward {
        font-size: 12px;
        color: #444444;
        display: flex;
        align-items: center;
    }

    /* Bouton désactivé */
    .claim-btn {
        background-color: #ccc;
        color: #666;
        font-size: 12px;
        padding: 5px 10px;
        border: none;
        border-radius: 5px;
        cursor: not-allowed;
        opacity: 0.7;
    }

    /* Cadenas en haut à droite */
    .challenge-card.locked::after {
        content: "🔒";
        position: absolute;
        top: 10px;
        right: 10px;
        font-size: 1.5rem;
        color: #999;
        opacity: 0.6;
        filter: grayscale(100%);
    }

    /* Voir plus */
    .more-link {
        margin-top: auto;
        text-align: center;
        font-weight: 600;
        color: #009ddc;
        text-decoration: none;
        transition: color 0.2s;
    }

    .more-link:hover {
        color: #007bb5;
    }
    /* Tier System */
    .tier-card {
        background: #ece5e5;
        padding: 15px;
        border-radius: 10px;
        box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
        display: flex;
        flex-direction: column;
        gap: 10px;
        margin-top: 20px;
        position: relative;
        overflow: hidden;
    }

    /* Ajouter le cadenas pour tier aussi */
    .tier-card.locked::after {
        content: "🔒";
        position: absolute;
        top: 10px;
        right: 10px;
        font-size: 1.5rem;
        color: #999;
        opacity: 0.6;
        filter: grayscale(100%);
    }

    .tier-card h3 {
        margin-top: 0;
        font-size: 18px;
        color: #888888;
    }

    .tier-list {
        max-height: 200px; /* hauteur max avant scroll */
        overflow-y: auto;
        display: flex;
        flex-direction: column;
        gap: 10px;
        padding-right: 5px;
    }

    /* Scroll custom */
    .tier-list::-webkit-scrollbar {
        width: 5px;
    }
    .tier-list::-webkit-scrollbar-thumb {
        background: #c4c4c4;
        border-radius: 10px;
    }
    .tier-list::-webkit-scrollbar-track {
        background: transparent;
    }

    .tier {
        background: #c5bebe;
        padding: 8px 10px;
        border-radius: 8px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        box-shadow: 0 1px 4px rgba(0,0,0,0.05);
        font-size: 14px;
    }

    .tier p {
        margin: 0;
        font-weight: bold;
        color: #333;
    }

    .tier span {
        font-size: 12px;
        color: #666;
    }

</style>
