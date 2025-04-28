<button class="social-btn {{ $type }}-btn" id="{{ $id }}">
    {{ $slot }}
</button>

<style>
    .social-btn {
        background-color: #e0e5f1;
        border: none;
        padding: 12px;
        font-size: 16px;
        border-radius: 50px;
        cursor: pointer;
        margin-bottom: 10px;
        width: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
    }
</style>
