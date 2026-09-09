            </main>
        </div>
    </div>

    <?php 
    require_once __DIR__ . '/editor-toolbar.php'; 
    if (ob_get_level() > 0) {
        ob_end_flush();
    }
    ?>
</body>
</html>
