<aside class="trending">
    <form action="{{ route('search') }}" method="GET">
        <input type="text" class="search-input" name="q" placeholder="Search..." required>
        <button type="submit">🔍</button>
    </form>



    <div class="section">
        <h3 class="section-title">TREND</h3>
        <div class="trend-card">
            <p>#BlueWave</p>
            <span>24.3K posts</span>
        </div>
        <div class="trend-card">
            <p>#LockerLife</p>
            <span>10.1K posts</span>
        </div>
    </div>

    <div class="section">
        <h3 class="section-title">PROPOSITION</h3>
        <div class="suggestion">
            <img src="{{ asset('pictures/pop.png') }}" alt="User">
            <div class="suggestion-info">
                <p class="name">Yuki R.</p>
                <a href="#" class="follow-btn">Voir</a>
            </div>
        </div>
        <div class="suggestion">
            <img src="{{ asset('pictures/pop.png') }}" alt="User">
            <div class="suggestion-info">
                <p class="name">Kaido S.</p>
                <a href="#" class="follow-btn">Voir</a>
            </div>
        </div>
    </div>

    <a href="#" class="more-link">See more profiles</a>
</aside>

<style>
    .trending {
        position: fixed;
        top: 0;
        right: 0;
        width: 270px;
        height: 100vh;
        background: #f6f9fc;
        border-left: 1px solid #dbe2ef;
        padding: 30px 20px;
        box-shadow: -4px 0 15px rgba(0, 0, 0, 0.05);
        display: flex;
        flex-direction: column;
        gap: 30px;
        font-family: 'Segoe UI', sans-serif;
    }

    /* Barre de recherche */
    .search-bar {
        display: flex;
        align-items: center;
        background: white;
        padding: 5px;
        border-radius: 20px;
        box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.2);
        margin-bottom: 15px;
    }

    .search-input {
        border: none;
        outline: none;
        flex-grow: 1;
        padding: 8px;
        border-radius: 20px;
        font-size: 14px;
    }

    .search-btn {
        background: none;
        border: none;
        cursor: pointer;
        font-size: 18px;
        padding: 5px;
    }

    .section-title {
        font-size: 18px;
        font-weight: 600;
        color: #333;
        margin-bottom: 15px;
    }

    .trend-card {
        background: #ffffff;
        padding: 12px 15px;
        border-radius: 12px;
        margin-bottom: 10px;
        box-shadow: 0 2px 5px rgba(0,0,0,0.05);
        transition: background-color 0.2s ease-in-out;
    }

    .trend-card:hover {
        background-color: #e3ecfb;
    }

    .trend-card p {
        font-weight: 500;
        margin: 0;
        color: #1e1e2f;
    }

    .trend-card span {
        font-size: 13px;
        color: #666;
    }

    .suggestion {
        display: flex;
        align-items: center;
        gap: 10px;
        margin-bottom: 15px;
    }

    .suggestion img {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        object-fit: cover;
        border: 2px solid #ccc;
    }

    .suggestion-info {
        display: flex;
        flex-direction: column;
    }

    .suggestion-info .name {
        font-size: 14px;
        font-weight: 500;
        margin-bottom: 2px;
    }

    .follow-btn {
        font-size: 13px;
        color: #009ddc;
        text-decoration: none;
        font-weight: 600;
        transition: color 0.2s;
    }

    .follow-btn:hover {
        color: #007bb5;
    }

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

</style>
