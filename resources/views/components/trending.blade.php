<aside class="trending">
    <!-- Barre de recherche -->
    <x-search-bar></x-search-bar>

    <h3>TENDANCE</h3>
    <h3>PROPOSITION</h3>
    <a href="#">More profil</a>
</aside>

<style>
    .trending {
        position: fixed;
        top: 0px; /* Adapte cette valeur à la hauteur de ta navbar */
        right: 0;
        background-color: #e0e5f1;
        padding: 20px;
        width: 250px;
        height: 109vh;
        box-shadow: 5px 0 20px rgba(0, 0, 0, 0.5);
        z-index: 100;
    }

    .trending h3 {
        margin-bottom: 15px;
        font-size: 18px;
    }

    .trending p {
        margin-bottom: 20px;
    }

    .suggestion {
        display: flex;
        align-items: center;
        margin-bottom: 15px;
    }

    .suggestion img {
        width: 30px;
        border-radius: 50%;
        margin-right: 10px;
    }
</style>
