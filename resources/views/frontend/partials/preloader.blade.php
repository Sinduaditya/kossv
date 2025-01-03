<div
    id="preloader"
    class="fixed left-0 top-0 z-999999 d-flex h-100 w-100 align-items-center justify-content-center bg-white dark:bg-black"
>
    <div
        class="spinner-border text-primary"
        role="status"
    >
        <span class="sr-only">Loading...</span>
    </div>
</div>

<script>
    window.addEventListener('load', function() {
        document.getElementById('preloader').style.display = 'none';
    });
</script>


