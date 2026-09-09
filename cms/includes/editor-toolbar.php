<?php
/**
 * CMS Rich Text WYSIWYG Editor Suite (Excel & Word Ribbon Edition)
 * Provides Font Family, Font Size, Headings, Bold/Italic/Underline/Strike/Sub/Super, 
 * Text & Background Color Pickers, Left/Center/Right/Justify, Indent, Lists, 
 * Hyperlinks, Images, Videos, Excel Tables, Horizontal Dividers, Undo/Redo, Fullscreen & HTML Code View.
 */
?>
<!-- Hidden File Input for WYSIWYG Image Uploads -->
<input type="file" id="quill-image-file-input" accept="image/*" class="hidden" style="display: none;">

<!-- Modal for Inserting / Editing Videos -->
<div id="cms-video-modal" class="fixed inset-0 bg-black/60 backdrop-blur-sm z-50 flex items-center justify-center hidden p-4">
    <div class="bg-white rounded-2xl max-w-md w-full p-6 shadow-2xl space-y-4 animate-fade-in border border-slate-200">
        <div class="flex items-center justify-between pb-3 border-b border-slate-100">
            <h3 class="text-sm font-bold text-slate-800 flex items-center">
                <i class="fas fa-video text-brand-blue mr-2"></i> Embed Video
            </h3>
            <button type="button" onclick="closeCmsVideoModal()" class="text-slate-400 hover:text-slate-600 text-lg leading-none">&times;</button>
        </div>
        <div>
            <label class="block text-xs font-bold text-slate-700 mb-1">YouTube or Vimeo Video URL</label>
            <input type="url" id="cms-video-url" placeholder="https://www.youtube.com/watch?v=... or https://youtu.be/..." class="w-full px-3.5 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-xs font-medium focus:bg-white focus:ring-2 focus:ring-blue-500 focus:outline-none">
            <p class="text-[10px] text-slate-400 mt-1">Accepts standard YouTube, YouTube Shorts, or Vimeo URLs.</p>
        </div>
        <div class="flex items-center justify-end space-x-2 pt-2">
            <button type="button" onclick="closeCmsVideoModal()" class="px-4 py-2 bg-slate-100 hover:bg-slate-200 text-slate-700 font-bold text-xs rounded-xl">Cancel</button>
            <button type="button" onclick="confirmCmsVideoEmbed()" class="px-5 py-2 bg-brand-blue hover:bg-blue-700 text-white font-bold text-xs rounded-xl shadow-md">Insert Video</button>
        </div>
    </div>
</div>

<!-- Modal for Inserting Tables (Excel Style) -->
<div id="cms-table-modal" class="fixed inset-0 bg-black/60 backdrop-blur-sm z-50 flex items-center justify-center hidden p-4">
    <div class="bg-white rounded-2xl max-w-sm w-full p-6 shadow-2xl space-y-4 animate-fade-in border border-slate-200">
        <div class="flex items-center justify-between pb-3 border-b border-slate-100">
            <h3 class="text-sm font-bold text-slate-800 flex items-center">
                <i class="fas fa-table text-brand-blue mr-2"></i> Insert Table (Excel Style)
            </h3>
            <button type="button" onclick="closeCmsTableModal()" class="text-slate-400 hover:text-slate-600 text-lg leading-none">&times;</button>
        </div>
        <div class="grid grid-cols-2 gap-3">
            <div>
                <label class="block text-xs font-bold text-slate-700 mb-1">Number of Rows</label>
                <input type="number" id="cms-table-rows" min="1" max="20" value="3" class="w-full px-3 py-2 bg-slate-50 border border-slate-200 rounded-xl text-xs font-semibold focus:bg-white focus:ring-2 focus:ring-blue-500 focus:outline-none">
            </div>
            <div>
                <label class="block text-xs font-bold text-slate-700 mb-1">Number of Columns</label>
                <input type="number" id="cms-table-cols" min="1" max="10" value="3" class="w-full px-3 py-2 bg-slate-50 border border-slate-200 rounded-xl text-xs font-semibold focus:bg-white focus:ring-2 focus:ring-blue-500 focus:outline-none">
            </div>
        </div>
        <div class="flex items-center space-x-2 pt-1">
            <input type="checkbox" id="cms-table-header" checked class="w-4 h-4 text-brand-blue rounded border-slate-300 focus:ring-blue-500">
            <label for="cms-table-header" class="text-xs font-medium text-slate-700 cursor-pointer">Include Styled Header Row</label>
        </div>
        <div class="flex items-center justify-end space-x-2 pt-2 border-t border-slate-100">
            <button type="button" onclick="closeCmsTableModal()" class="px-4 py-2 bg-slate-100 hover:bg-slate-200 text-slate-700 font-bold text-xs rounded-xl">Cancel</button>
            <button type="button" onclick="confirmCmsTableInsert()" class="px-5 py-2 bg-brand-blue hover:bg-blue-700 text-white font-bold text-xs rounded-xl shadow-md flex items-center space-x-1.5">
                <i class="fas fa-plus"></i>
                <span>Insert Table</span>
            </button>
        </div>
    </div>
</div>

<script>
(function() {
    if (typeof Quill === 'undefined') return;

    // Register Style Attributors for clean inline CSS output (renders directly on website)
    const SizeStyle = Quill.import('attributors/style/size');
    SizeStyle.whitelist = ['10px', '12px', '14px', '16px', '18px', '20px', '24px', '28px', '32px', '36px', '48px'];
    Quill.register(SizeStyle, true);

    const FontStyle = Quill.import('attributors/style/font');
    FontStyle.whitelist = ['sans-serif', 'Arial', 'Georgia', 'Times New Roman', 'Trebuchet MS', 'Verdana', 'Roboto', 'monospace', 'serif'];
    Quill.register(FontStyle, true);

    const AlignStyle = Quill.import('attributors/style/align');
    Quill.register(AlignStyle, true);

    const DirectionStyle = Quill.import('attributors/style/direction');
    Quill.register(DirectionStyle, true);

    let activeQuillInstance = null;

    // Video URL Helper
    function formatVideoUrl(url) {
        if (!url) return null;
        url = url.trim();
        
        let ytShort = url.match(/youtu\.be\/([a-zA-Z0-9_-]+)/i);
        if (ytShort) return 'https://www.youtube.com/embed/' + ytShort[1];
        
        let ytStandard = url.match(/[?&]v=([a-zA-Z0-9_-]+)/i) || url.match(/\/shorts\/([a-zA-Z0-9_-]+)/i) || url.match(/\/embed\/([a-zA-Z0-9_-]+)/i);
        if (ytStandard) return 'https://www.youtube.com/embed/' + ytStandard[1];

        let vimeo = url.match(/vimeo\.com\/([0-9]+)/i);
        if (vimeo) return 'https://player.vimeo.com/video/' + vimeo[1];

        return url;
    }

    // Video Modal Handlers
    window.closeCmsVideoModal = function() {
        const m = document.getElementById('cms-video-modal');
        if (m) m.classList.add('hidden');
        const inp = document.getElementById('cms-video-url');
        if (inp) inp.value = '';
    };

    window.confirmCmsVideoEmbed = function() {
        const inp = document.getElementById('cms-video-url');
        const rawUrl = inp ? inp.value : '';
        const embedUrl = formatVideoUrl(rawUrl);
        if (embedUrl && activeQuillInstance) {
            const range = activeQuillInstance.getSelection(true);
            activeQuillInstance.insertEmbed(range.index, 'video', embedUrl, Quill.sources.USER);
            activeQuillInstance.setSelection(range.index + 1, Quill.sources.SILENT);
        }
        closeCmsVideoModal();
    };

    // Table Modal Handlers
    window.closeCmsTableModal = function() {
        const m = document.getElementById('cms-table-modal');
        if (m) m.classList.add('hidden');
    };

    window.confirmCmsTableInsert = function() {
        if (!activeQuillInstance) return;
        const rows = parseInt(document.getElementById('cms-table-rows').value, 10) || 3;
        const cols = parseInt(document.getElementById('cms-table-cols').value, 10) || 3;
        const hasHeader = document.getElementById('cms-table-header').checked;

        let html = '<table style="width: 100%; border-collapse: collapse; margin: 16px 0; border: 1px solid #cbd5e1; font-size: 14px;">';
        
        if (hasHeader) {
            html += '<thead><tr style="background-color: #f1f5f9;">';
            for (let c = 1; c <= cols; c++) {
                html += '<th style="border: 1px solid #cbd5e1; padding: 10px 12px; text-align: left; font-weight: 700; color: #1e293b;">Header ' + c + '</th>';
            }
            html += '</tr></thead>';
        }

        html += '<tbody>';
        for (let r = 1; r <= rows; r++) {
            const bg = (r % 2 === 0) ? ' style="background-color: #f8fafc;"' : '';
            html += '<tr' + bg + '>';
            for (let c = 1; c <= cols; c++) {
                html += '<td style="border: 1px solid #cbd5e1; padding: 10px 12px; color: #334155;">Data ' + r + '-' + c + '</td>';
            }
            html += '</tr>';
        }
        html += '</tbody></table><p><br></p>';

        const range = activeQuillInstance.getSelection(true);
        activeQuillInstance.clipboard.dangerouslyPasteHTML(range.index, html);
        closeCmsTableModal();
    };

    // Global Image Upload Handler
    const imageInput = document.getElementById('quill-image-file-input');
    if (imageInput) {
        imageInput.addEventListener('change', function() {
            if (!this.files || !this.files[0] || !activeQuillInstance) return;
            const file = this.files[0];
            const formData = new FormData();
            formData.append('image', file);

            const range = activeQuillInstance.getSelection(true);
            
            fetch('api-upload.php', {
                method: 'POST',
                body: formData
            })
            .then(res => res.json())
            .then(data => {
                if (data.success && data.url) {
                    activeQuillInstance.insertEmbed(range.index, 'image', data.url, Quill.sources.USER);
                    activeQuillInstance.setSelection(range.index + 1, Quill.sources.SILENT);
                } else {
                    alert(data.error || 'Failed to upload image.');
                }
            })
            .catch(err => {
                console.error('Image upload failed', err);
                alert('Image upload failed. Please try again.');
            })
            .finally(() => {
                imageInput.value = '';
            });
        });
    }

    // Initialize Rich Editor on textareas
    document.addEventListener('DOMContentLoaded', function() {
        const targetTextareas = document.querySelectorAll(
            'textarea[name="content"], textarea[name="section1_text"], textarea[name="about"], textarea[name="hero_desc"], textarea.wysiwyg-editor, textarea.rich-editor'
        );

        targetTextareas.forEach(function(textarea, idx) {
            if (textarea.dataset.quillInitialized) return;
            textarea.dataset.quillInitialized = 'true';

            // Create wrapper
            const wrapper = document.createElement('div');
            wrapper.className = 'quill-editor-wrapper space-y-1 my-2';

            // Top Status Bar
            const topBar = document.createElement('div');
            topBar.className = 'flex items-center justify-between px-2 py-1 bg-slate-100 rounded-t-xl border-t border-l border-r border-slate-200 text-[11px] text-slate-600 font-semibold';
            topBar.innerHTML = `
                <div class="flex items-center space-x-2">
                    <span class="inline-flex items-center text-brand-blue font-bold">
                        <i class="fas fa-file-signature mr-1.5 text-xs"></i> Rich Text & Formatting Editor
                    </span>
                    <span class="text-slate-300">|</span>
                    <span class="text-slate-400 font-normal">Excel / Word Style Toolbar</span>
                </div>
                <div class="flex items-center space-x-3">
                    <button type="button" class="fullscreen-toggle-btn text-slate-600 hover:text-brand-blue font-bold flex items-center space-x-1 transition-colors" title="Toggle Fullscreen">
                        <i class="fas fa-expand"></i>
                        <span>Fullscreen</span>
                    </button>
                    <button type="button" class="html-toggle-btn text-brand-blue hover:text-blue-800 font-bold hover:underline flex items-center space-x-1 transition-colors" title="Switch between Visual & HTML code">
                        <i class="fas fa-code"></i>
                        <span>HTML Code View</span>
                    </button>
                </div>
            `;

            // Custom Toolbar Container
            const toolbarContainer = document.createElement('div');
            toolbarContainer.id = 'quill-custom-toolbar-' + idx;
            toolbarContainer.className = 'ql-toolbar-container bg-slate-50 border border-slate-200 p-2 flex flex-wrap items-center gap-1';
            toolbarContainer.innerHTML = `
                <!-- Group: History (Undo/Redo) -->
                <span class="ql-formats">
                    <button class="ql-undo" type="button" title="Undo (Ctrl+Z)"><i class="fas fa-undo"></i></button>
                    <button class="ql-redo" type="button" title="Redo (Ctrl+Y)"><i class="fas fa-redo"></i></button>
                </span>

                <!-- Group: Font Style, Size & Headings -->
                <span class="ql-formats">
                    <select class="ql-font" title="Font Style / Family">
                        <option selected value="sans-serif">Default Font</option>
                        <option value="Arial">Arial</option>
                        <option value="Georgia">Georgia</option>
                        <option value="Times New Roman">Times New Roman</option>
                        <option value="Trebuchet MS">Trebuchet MS</option>
                        <option value="Verdana">Verdana</option>
                        <option value="Roboto">Roboto</option>
                        <option value="monospace">Monospace</option>
                        <option value="serif">Serif</option>
                    </select>
                    <select class="ql-size" title="Font Size">
                        <option value="10px">10px (Tiny)</option>
                        <option value="12px">12px (Small)</option>
                        <option value="14px" selected>14px (Normal)</option>
                        <option value="16px">16px (Medium)</option>
                        <option value="18px">18px (Large)</option>
                        <option value="20px">20px (XL)</option>
                        <option value="24px">24px (2XL)</option>
                        <option value="28px">28px (3XL)</option>
                        <option value="32px">32px (4XL)</option>
                        <option value="36px">36px (5XL)</option>
                        <option value="48px">48px (Huge)</option>
                    </select>
                    <select class="ql-header" title="Heading Level">
                        <option selected>Normal Text</option>
                        <option value="1">Heading 1 (Main Title)</option>
                        <option value="2">Heading 2 (Section Title)</option>
                        <option value="3">Heading 3 (Subhead)</option>
                        <option value="4">Heading 4 (Minor)</option>
                        <option value="5">Heading 5</option>
                        <option value="6">Heading 6</option>
                    </select>
                </span>

                <!-- Group: Text Styling & Boldness -->
                <span class="ql-formats">
                    <button class="ql-bold" type="button" title="Bold (Ctrl+B)"><i class="fas fa-bold"></i></button>
                    <button class="ql-italic" type="button" title="Italic (Ctrl+I)"><i class="fas fa-italic"></i></button>
                    <button class="ql-underline" type="button" title="Underline (Ctrl+U)"><i class="fas fa-underline"></i></button>
                    <button class="ql-strike" type="button" title="Strikethrough"><i class="fas fa-strikethrough"></i></button>
                    <button class="ql-script" value="sub" type="button" title="Subscript (X₂)"><i class="fas fa-subscript"></i></button>
                    <button class="ql-script" value="super" type="button" title="Superscript (X²)"><i class="fas fa-superscript"></i></button>
                </span>

                <!-- Group: Colors & Highlighting -->
                <span class="ql-formats">
                    <select class="ql-color" title="Font / Text Color"></select>
                    <select class="ql-background" title="Text Highlight / Background Color"></select>
                </span>

                <!-- Group: Alignment & Indentation -->
                <span class="ql-formats">
                    <button class="ql-align" value="" type="button" title="Align Left"><i class="fas fa-align-left"></i></button>
                    <button class="ql-align" value="center" type="button" title="Align Center"><i class="fas fa-align-center"></i></button>
                    <button class="ql-align" value="right" type="button" title="Align Right"><i class="fas fa-align-right"></i></button>
                    <button class="ql-align" value="justify" type="button" title="Justify"><i class="fas fa-align-justify"></i></button>
                    <button class="ql-indent" value="-1" type="button" title="Decrease Indent"><i class="fas fa-outdent"></i></button>
                    <button class="ql-indent" value="+1" type="button" title="Increase Indent"><i class="fas fa-indent"></i></button>
                </span>

                <!-- Group: Lists & Blocks -->
                <span class="ql-formats">
                    <button class="ql-list" value="ordered" type="button" title="Numbered List"><i class="fas fa-list-ol"></i></button>
                    <button class="ql-list" value="bullet" type="button" title="Bullet List"><i class="fas fa-list-ul"></i></button>
                    <button class="ql-blockquote" type="button" title="Quote Block"><i class="fas fa-quote-left"></i></button>
                    <button class="ql-code-block" type="button" title="Code Snippet"><i class="fas fa-code"></i></button>
                </span>

                <!-- Group: Media, Tables & Links -->
                <span class="ql-formats">
                    <button class="ql-link" type="button" title="Insert / Edit Hyperlink"><i class="fas fa-link"></i></button>
                    <button class="ql-image" type="button" title="Insert Image (Upload or URL)"><i class="fas fa-image"></i></button>
                    <button class="ql-video" type="button" title="Embed Video (YouTube / Vimeo)"><i class="fas fa-video"></i></button>
                    <button class="ql-table" type="button" title="Insert Excel Table Grid"><i class="fas fa-table"></i></button>
                    <button class="ql-hr" type="button" title="Insert Horizontal Divider Line"><i class="fas fa-minus"></i></button>
                </span>

                <!-- Group: Clean Formatting -->
                <span class="ql-formats">
                    <button class="ql-clean" type="button" title="Clear Formatting (Remove Styles)"><i class="fas fa-eraser"></i></button>
                </span>
            `;

            // Quill Editor Container
            const quillContainer = document.createElement('div');
            quillContainer.id = 'quill-editor-' + idx;
            quillContainer.className = 'bg-white rounded-b-xl shadow-sm';
            quillContainer.style.minHeight = textarea.rows > 5 ? '280px' : '180px';

            // Insert into DOM
            textarea.parentNode.insertBefore(wrapper, textarea);
            wrapper.appendChild(topBar);
            wrapper.appendChild(toolbarContainer);
            wrapper.appendChild(quillContainer);
            textarea.classList.add('hidden');
            textarea.style.display = 'none';

            // Instantiate Quill
            const quill = new Quill(quillContainer, {
                theme: 'snow',
                placeholder: 'Type or format rich content here...',
                modules: {
                    toolbar: {
                        container: toolbarContainer
                    },
                    history: {
                        delay: 1000,
                        maxStack: 100,
                        userOnly: true
                    }
                }
            });

            // Set initial content
            if (textarea.value) {
                quill.root.innerHTML = textarea.value;
            }

            // Sync on change
            quill.on('text-change', function() {
                textarea.value = quill.root.innerHTML === '<p><br></p>' ? '' : quill.root.innerHTML;
            });

            // Form Submit handler
            const parentForm = textarea.closest('form');
            if (parentForm) {
                parentForm.addEventListener('submit', function() {
                    if (quillContainer.style.display !== 'none') {
                        textarea.value = quill.root.innerHTML === '<p><br></p>' ? '' : quill.root.innerHTML;
                    }
                });
            }

            // Custom Undo / Redo Click Handlers
            toolbarContainer.querySelectorAll('.ql-undo').forEach(function(btn) {
                btn.addEventListener('click', function() {
                    quill.history.undo();
                });
            });
            toolbarContainer.querySelectorAll('.ql-redo').forEach(function(btn) {
                btn.addEventListener('click', function() {
                    quill.history.redo();
                });
            });

            // Custom Table Click Handler
            toolbarContainer.querySelectorAll('.ql-table').forEach(function(btn) {
                btn.addEventListener('click', function() {
                    activeQuillInstance = quill;
                    const m = document.getElementById('cms-table-modal');
                    if (m) m.classList.remove('hidden');
                });
            });

            // Custom Horizontal Divider Click Handler
            toolbarContainer.querySelectorAll('.ql-hr').forEach(function(btn) {
                btn.addEventListener('click', function() {
                    const range = quill.getSelection(true);
                    quill.clipboard.dangerouslyPasteHTML(range.index, '<hr style="border: 0; border-top: 2px solid #e2e8f0; margin: 20px 0;" /><p><br></p>');
                });
            });

            // Custom Image Handler
            const toolbar = quill.getModule('toolbar');
            toolbar.addHandler('image', function() {
                activeQuillInstance = quill;
                const choice = confirm("Click 'OK' to Upload an Image from your computer (Recommended: 800×600 px).\nClick 'Cancel' to insert an Image URL directly.");
                if (choice) {
                    if (imageInput) imageInput.click();
                } else {
                    const url = prompt('Enter Image URL:');
                    if (url) {
                        const range = quill.getSelection(true);
                        quill.insertEmbed(range.index, 'image', url, Quill.sources.USER);
                        quill.setSelection(range.index + 1, Quill.sources.SILENT);
                    }
                }
            });

            // Custom Video Handler
            toolbar.addHandler('video', function() {
                activeQuillInstance = quill;
                const m = document.getElementById('cms-video-modal');
                if (m) m.classList.remove('hidden');
                const inp = document.getElementById('cms-video-url');
                if (inp) inp.focus();
            });

            // Fullscreen Toggle Handler
            const fullscreenBtn = topBar.querySelector('.fullscreen-toggle-btn');
            if (fullscreenBtn) {
                fullscreenBtn.addEventListener('click', function() {
                    wrapper.classList.toggle('cms-quill-fullscreen-mode');
                    const isFull = wrapper.classList.contains('cms-quill-fullscreen-mode');
                    fullscreenBtn.innerHTML = isFull 
                        ? '<i class="fas fa-compress text-brand-blue"></i> <span class="text-brand-blue">Exit Fullscreen</span>'
                        : '<i class="fas fa-expand"></i> <span>Fullscreen</span>';
                });
            }

            // HTML Code View Toggle Handler
            let isHtmlView = false;
            const toggleBtn = topBar.querySelector('.html-toggle-btn');
            if (toggleBtn) {
                toggleBtn.addEventListener('click', function() {
                    isHtmlView = !isHtmlView;
                    if (isHtmlView) {
                        textarea.value = quill.root.innerHTML;
                        textarea.classList.remove('hidden');
                        textarea.style.display = 'block';
                        textarea.className = 'w-full px-4 py-3 bg-slate-900 text-green-400 font-mono text-xs rounded-b-xl border border-slate-700 leading-relaxed focus:ring-2 focus:ring-blue-500 focus:outline-none';
                        quillContainer.style.display = 'none';
                        toolbarContainer.style.display = 'none';
                        toggleBtn.innerHTML = '<i class="fas fa-eye text-emerald-600 mr-1"></i> <span class="text-emerald-700">Visual WYSIWYG View</span>';
                    } else {
                        quill.root.innerHTML = textarea.value;
                        textarea.classList.add('hidden');
                        textarea.style.display = 'none';
                        quillContainer.style.display = 'block';
                        toolbarContainer.style.display = 'flex';
                        toggleBtn.innerHTML = '<i class="fas fa-code text-brand-blue mr-1"></i> <span>HTML Code View</span>';
                    }
                });
            }
        });
    });
})();
</script>
