<div class="search-bar">
    <input type="text" placeholder="Rechercher..." class="search-input" required>
    <button type="submit" class="search-btn">🔍</button>
</div>

<style>
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
</style>
