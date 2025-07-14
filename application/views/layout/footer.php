<footer class="footer d-flex justify-content-between align-items-center px-3 py-2 border-top">
    <p class="mb-0 fs-11 text-muted text-uppercase fw-medium">
        &copy; <span id="currentYear"></span> Warrgyizmorsch Private Limited
    </p>
    <nav class="d-flex gap-3">
        <a href="#" class="fs-11 fw-semibold text-uppercase text-muted text-decoration-none">Help</a>
        <a href="#" class="fs-11 fw-semibold text-uppercase text-muted text-decoration-none">Terms</a>
        <a href="#" class="fs-11 fw-semibold text-uppercase text-muted text-decoration-none">Privacy</a>
    </nav>
</footer>

<!-- JavaScript for dynamic year -->
<script>
    document.getElementById('currentYear').textContent = new Date().getFullYear();
</script>
