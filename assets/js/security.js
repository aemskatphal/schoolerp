/* Simple browser inspection deterrent - prevents right-click, F12, view source shortcuts */
(function () {
    function block(e) { e.preventDefault(); return false; }

    document.addEventListener('contextmenu', block);

    document.addEventListener('keydown', function (e) {
        var key = e.keyCode || e.which;
        if (key === 123) { block(e); return; } /* F12 */
        var ctrl = e.ctrlKey || e.metaKey;
        var shift = e.shiftKey;
        if (ctrl && shift && (key === 73 || key === 74 || key === 67)) { block(e); return; } /* Ctrl+Shift+I / J / C */
        if (ctrl && key === 85) { block(e); return; } /* Ctrl+U - view source */
        if (ctrl && key === 83) { block(e); return; } /* Ctrl+S - save page */
    });

    /* Prevent text selection outside form fields */
    document.addEventListener('selectstart', function (e) {
        var tag = e.target && e.target.tagName;
        if (tag === 'INPUT' || tag === 'TEXTAREA' || tag === 'SELECT') return;
        block(e);
    });
})();
