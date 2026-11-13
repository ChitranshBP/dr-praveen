<?php
/**
 * Media picker modal + shared JS for image fields and drag-and-drop lists.
 * Included once per CMS page from includes/footer.php.
 */
?>
<!-- Media Library Picker -->
<div id="cms-media-modal" class="hidden fixed inset-0 z-[70] bg-black/60 backdrop-blur-sm flex items-center justify-center p-4">
    <div class="bg-white rounded-3xl w-full max-w-5xl max-h-[92vh] flex flex-col shadow-2xl overflow-hidden">
        <div class="flex items-center justify-between px-5 py-3.5 border-b border-slate-100 gap-3 flex-wrap">
            <h3 class="text-sm font-bold text-slate-900 flex items-center"><i class="fas fa-photo-film text-brand-blue mr-2"></i> Media Library</h3>
            <div class="flex items-center gap-2 flex-1 justify-end min-w-0">
                <select id="cms-media-folder" class="px-2.5 py-1.5 bg-slate-50 border border-slate-200 rounded-lg text-xs font-semibold max-w-[200px]"></select>
                <input type="search" id="cms-media-search" placeholder="Search file name…" class="px-3 py-1.5 bg-slate-50 border border-slate-200 rounded-lg text-xs w-40 sm:w-56">
                <label class="inline-flex items-center space-x-1.5 px-3 py-1.5 rounded-lg bg-brand-blue text-white text-xs font-bold cursor-pointer hover:bg-blue-700">
                    <i class="fas fa-upload text-[10px]"></i><span>Upload</span>
                    <input type="file" id="cms-media-upload" accept=".png,.jpg,.jpeg,.webp,.gif" class="hidden" multiple>
                </label>
                <button type="button" id="cms-media-close" class="w-8 h-8 rounded-lg hover:bg-slate-100 text-slate-500"><i class="fas fa-times"></i></button>
            </div>
        </div>
        <div id="cms-media-status" class="hidden px-5 py-2 text-xs font-semibold bg-amber-50 text-amber-800 border-b border-amber-100"></div>
        <div id="cms-media-grid" class="flex-1 overflow-y-auto p-4 grid grid-cols-3 sm:grid-cols-4 md:grid-cols-6 gap-3 content-start"></div>
        <div class="flex items-center justify-between px-5 py-3 border-t border-slate-100 text-xs text-slate-500">
            <span id="cms-media-count"></span>
            <div class="flex items-center gap-2">
                <button type="button" id="cms-media-prev" class="px-3 py-1.5 rounded-lg border border-slate-200 font-semibold disabled:opacity-40">‹ Prev</button>
                <span id="cms-media-page"></span>
                <button type="button" id="cms-media-next" class="px-3 py-1.5 rounded-lg border border-slate-200 font-semibold disabled:opacity-40">Next ›</button>
            </div>
        </div>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/Sortable/1.15.0/Sortable.min.js"></script>
<script>
(function () {
    var CSRF = <?php echo json_encode(function_exists('cms_csrf_token') ? cms_csrf_token() : ''); ?>;
    var modal = document.getElementById('cms-media-modal');
    var grid = document.getElementById('cms-media-grid');
    var folderSel = document.getElementById('cms-media-folder');
    var search = document.getElementById('cms-media-search');
    var status = document.getElementById('cms-media-status');
    var state = { page: 1, pages: 1, folder: '', q: '', callback: null, uploadFolder: 'library', loadedFolders: false };

    function setStatus(msg, isError) {
        if (!msg) { status.classList.add('hidden'); return; }
        status.textContent = msg;
        status.className = 'px-5 py-2 text-xs font-semibold border-b ' + (isError ? 'bg-red-50 text-red-700 border-red-100' : 'bg-amber-50 text-amber-800 border-amber-100');
    }

    function load() {
        grid.innerHTML = '<div class="col-span-full py-10 text-center text-slate-400 text-xs"><i class="fas fa-spinner fa-spin mr-1"></i> Loading…</div>';
        var url = 'api-media.php?action=list&page=' + state.page + '&folder=' + encodeURIComponent(state.folder) + '&q=' + encodeURIComponent(state.q);
        fetch(url, { credentials: 'same-origin' }).then(function (r) { return r.json(); }).then(function (d) {
            if (d.error) { setStatus(d.error, true); return; }
            if (!state.loadedFolders) {
                folderSel.innerHTML = '<option value="">All folders</option>' + d.folders.map(function (f) {
                    return '<option value="' + f.key + '">' + f.label + '</option>';
                }).join('');
                folderSel.value = state.folder;
                state.loadedFolders = true;
            }
            state.pages = d.pages;
            document.getElementById('cms-media-count').textContent = d.total + ' image' + (d.total === 1 ? '' : 's');
            document.getElementById('cms-media-page').textContent = 'Page ' + d.page + ' / ' + d.pages;
            document.getElementById('cms-media-prev').disabled = d.page <= 1;
            document.getElementById('cms-media-next').disabled = d.page >= d.pages;
            if (!d.items.length) {
                grid.innerHTML = '<div class="col-span-full py-10 text-center text-slate-400 text-xs">No images here yet. Use Upload to add some.</div>';
                return;
            }
            grid.innerHTML = '';
            d.items.forEach(function (it) {
                var b = document.createElement('button');
                b.type = 'button';
                b.className = 'group text-left rounded-xl border border-slate-200 overflow-hidden hover:border-brand-blue hover:shadow-md bg-white';
                b.innerHTML = '<div class="aspect-square bg-slate-100 overflow-hidden"><img src="' + it.url + '" alt="" loading="lazy" class="w-full h-full object-cover group-hover:scale-105 transition-transform"></div>' +
                    '<div class="p-1.5 text-[10px] text-slate-600 truncate" title="' + it.path + '">' + it.name + '</div>';
                b.addEventListener('click', function () { choose(it.path); });
                grid.appendChild(b);
            });
        }).catch(function () { setStatus('Could not load the media library.', true); });
    }

    function choose(path) {
        if (state.callback) state.callback(path);
        close();
    }
    function open(cb, folder) {
        state.callback = cb;
        state.uploadFolder = folder || 'library';
        state.page = 1;
        setStatus('');
        modal.classList.remove('hidden');
        load();
    }
    function close() { modal.classList.add('hidden'); state.callback = null; }

    document.getElementById('cms-media-close').addEventListener('click', close);
    modal.addEventListener('click', function (e) { if (e.target === modal) close(); });
    document.addEventListener('keydown', function (e) { if (e.key === 'Escape' && !modal.classList.contains('hidden')) close(); });
    document.getElementById('cms-media-prev').addEventListener('click', function () { if (state.page > 1) { state.page--; load(); } });
    document.getElementById('cms-media-next').addEventListener('click', function () { if (state.page < state.pages) { state.page++; load(); } });
    folderSel.addEventListener('change', function () { state.folder = this.value; state.page = 1; load(); });
    var searchTimer;
    search.addEventListener('input', function () { clearTimeout(searchTimer); var v = this.value; searchTimer = setTimeout(function () { state.q = v; state.page = 1; load(); }, 250); });

    document.getElementById('cms-media-upload').addEventListener('change', function () {
        var files = Array.prototype.slice.call(this.files || []);
        if (!files.length) return;
        var input = this;
        setStatus('Uploading ' + files.length + ' file(s)…');
        var last = null;
        var chain = Promise.resolve();
        files.forEach(function (file) {
            chain = chain.then(function () {
                var fd = new FormData();
                fd.append('action', 'upload');
                fd.append('folder', state.uploadFolder);
                fd.append('csrf_token', CSRF);
                fd.append('file', file);
                return fetch('api-media.php', { method: 'POST', body: fd, credentials: 'same-origin' }).then(function (r) { return r.json(); }).then(function (d) {
                    if (d.error) throw new Error(d.error);
                    last = d.item;
                });
            });
        });
        chain.then(function () {
            setStatus('');
            input.value = '';
            if (files.length === 1 && last) { choose(last.path); return; }
            state.folder = ''; state.page = 1; load();
        }).catch(function (e) { setStatus('Upload failed: ' + e.message, true); input.value = ''; });
    });

    window.cmsPickImage = open;

    // ---- Image fields ------------------------------------------------------
    function wireImageField(field) {
        if (field.dataset.wired) return;
        field.dataset.wired = '1';
        var hidden = field.querySelector('.cms-image-path');
        var preview = field.querySelector('.cms-image-preview');
        var label = field.querySelector('.cms-image-pathlabel');
        var clearBtn = field.querySelector('.cms-image-clear');
        var fileInput = field.querySelector('.cms-image-file');
        function setPath(path, previewUrl) {
            hidden.value = path;
            label.textContent = path || 'No image selected';
            if (path || previewUrl) {
                preview.innerHTML = '<img src="' + (previewUrl || ('../' + path.replace(/^\/+/, ''))) + '" alt="" class="w-full h-full object-cover">';
                clearBtn.classList.remove('hidden');
            } else {
                preview.innerHTML = '<i class="fas fa-image text-xl"></i>';
                clearBtn.classList.add('hidden');
            }
        }
        field.querySelector('.cms-image-choose').addEventListener('click', function () {
            open(function (path) { if (fileInput) fileInput.value = ''; setPath(path); }, field.dataset.folder || 'library');
        });
        clearBtn.addEventListener('click', function () { if (fileInput) fileInput.value = ''; setPath(''); });
        if (fileInput) {
            fileInput.addEventListener('change', function () {
                var f = this.files && this.files[0];
                if (!f) return;
                var reader = new FileReader();
                reader.onload = function (e) {
                    label.textContent = 'New upload: ' + f.name;
                    preview.innerHTML = '<img src="' + e.target.result + '" alt="" class="w-full h-full object-cover">';
                    clearBtn.classList.remove('hidden');
                };
                reader.readAsDataURL(f);
            });
        }
    }
    window.cmsWireImageFields = function (scope) {
        (scope || document).querySelectorAll('.cms-image-field').forEach(wireImageField);
    };

    // ---- Drag-and-drop lists ---------------------------------------------
    function toast(msg, ok) {
        var t = document.createElement('div');
        t.className = 'fixed bottom-4 right-4 z-[80] px-4 py-2.5 rounded-xl text-xs font-bold shadow-lg ' + (ok ? 'bg-emerald-600 text-white' : 'bg-red-600 text-white');
        t.textContent = msg;
        document.body.appendChild(t);
        setTimeout(function () { t.remove(); }, 2500);
    }
    function wireSortable(list) {
        if (list.dataset.sortableWired || typeof Sortable === 'undefined') return;
        list.dataset.sortableWired = '1';
        var handle = list.querySelector('.drag-handle') ? '.drag-handle' : undefined;
        Sortable.create(list, {
            animation: 150,
            handle: handle,
            draggable: list.dataset.sortableItem || '[data-id], .sortable-item',
            ghostClass: 'opacity-40',
            onEnd: function () {
                // Renumber visible position badges, if any.
                list.querySelectorAll('.sort-position').forEach(function (el, i) { el.textContent = i + 1; });
                var url = list.dataset.reorderUrl;
                if (!url) return;
                var fd = new FormData();
                fd.append('action', list.dataset.reorderAction || 'reorder');
                fd.append('csrf_token', CSRF);
                list.querySelectorAll('[data-id]').forEach(function (row) { fd.append('ids[]', row.dataset.id); });
                fetch(url, { method: 'POST', body: fd, credentials: 'same-origin', headers: { 'X-Requested-With': 'XMLHttpRequest' } })
                    .then(function (r) { return r.ok ? r.text() : Promise.reject(new Error('HTTP ' + r.status)); })
                    .then(function () { toast('Order saved', true); })
                    .catch(function () { toast('Could not save the new order', false); });
            }
        });
    }
    window.cmsWireSortables = function (scope) {
        (scope || document).querySelectorAll('[data-sortable]').forEach(wireSortable);
    };

    document.addEventListener('DOMContentLoaded', function () {
        window.cmsWireImageFields(document);
        window.cmsWireSortables(document);
    });
})();
</script>
