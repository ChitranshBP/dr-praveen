<?php
/**
 * CMS Rich Text WYSIWYG Editor Suite (Quill.js Snow Edition)
 * Provides Headings, Bold/Italic/Underline, Left/Center/Right/Justify, Lists, Hyperlinks, Images, Videos, HTML Source View
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

<script>
(function() {
    if (typeof Quill === 'undefined') return;

    let activeQuillInstance = null;

    // Custom Video Format Handler for YouTube / Vimeo
    function formatVideoUrl(url) {
        if (!url) return null;
        url = url.trim();
        
        // YouTube short: youtu.be/ID
        let ytShort = url.match(/youtu.be/([a-zA-Z0-9_-]+)/i);
        if (ytShort) {
            return 'https://www.youtube.com/embed/' + ytShort[1];
        }
        
        // YouTube standard: youtube.com/watch?v=ID or /shorts/ID
        let ytStandard = url.match(/[?&]v=([a-zA-Z0-9_-]+)/i) || url.match(//shorts/([a-zA-Z0-9_-]+)/i) || url.match(//embed/([a-zA-Z0-9_-]+)/i);
        if (ytStandard) {
            return 'https://www.youtube.com/embed/' + ytStandard[1];
        }

        // Vimeo: vimeo.com/ID
        let vimeo = url.match(/vimeo.com/([0-9]+)/i);
        if (vimeo) {
            return 'https://player.vimeo.com/video/' + vimeo[1];
        }

        return url;
    }

    window.closeCmsVideoModal = function() {
        document.getElementById('cms-video-modal').classList.add('hidden');
        document.getElementById('cms-video-url').value = '';
    };

    window.confirmCmsVideoEmbed = function() {
        const rawUrl = document.getElementById('cms-video-url').value;
        const embedUrl = formatVideoUrl(rawUrl);
        if (embedUrl && activeQuillInstance) {
            const range = activeQuillInstance.getSelection(true);
            activeQuillInstance.insertEmbed(range.index, 'video', embedUrl, Quill.sources.USER);
            activeQuillInstance.setSelection(range.index + 1, Quill.sources.SILENT);
        }
        closeCmsVideoModal();
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
            
            // Upload to server
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

    // Initialize Quill on Textareas
    document.addEventListener('DOMContentLoaded', function() {
        // Target editable content fields (Page body, Blog content, Doctor bio, About summary, etc.)
        const targetTextareas = document.querySelectorAll(
            'textarea[name="content"], textarea[name="section1_text"], textarea[name="about"], textarea.wysiwyg-editor, textarea.rich-editor'
        );

        targetTextareas.forEach(function(textarea, idx) {
            // Avoid double init
            if (textarea.dataset.quillInitialized) return;
            textarea.dataset.quillInitialized = 'true';

            // Create wrapper container
            const wrapper = document.createElement('div');
            wrapper.className = 'quill-editor-wrapper space-y-1 my-2';

            // Top bar with Source View toggle
            const topBar = document.createElement('div');
            topBar.className = 'flex items-center justify-between px-1 text-[11px] text-slate-500 font-medium';
            topBar.innerHTML = `
                <span><i class="fas fa-magic text-brand-blue mr-1"></i> Rich Content Editor</span>
                <button type="button" class="html-toggle-btn text-xs text-brand-blue font-bold hover:underline flex items-center space-x-1">
                    <i class="fas fa-code"></i>
                    <span>HTML Code View</span>
                </button>
            `;

            // Quill editor container
            const quillContainer = document.createElement('div');
            quillContainer.id = 'quill-editor-' + idx;
            quillContainer.className = 'bg-white rounded-xl shadow-sm';
            quillContainer.style.minHeight = textarea.rows > 5 ? '280px' : '180px';

            // Place wrapper before textarea and hide textarea
            textarea.parentNode.insertBefore(wrapper, textarea);
            wrapper.appendChild(topBar);
            wrapper.appendChild(quillContainer);
            textarea.classList.add('hidden');
            textarea.style.display = 'none';

            // Complete Snow Toolbar configuration
            const toolbarOptions = [
                [{ 'header': [1, 2, 3, 4, 5, 6, false] }],
                ['bold', 'italic', 'underline', 'strike'],
                [{ 'color': [] }, { 'background': [] }],
                [{ 'align': '' }, { 'align': 'center' }, { 'align': 'right' }, { 'align': 'justify' }],
                [{ 'list': 'ordered'}, { 'list': 'bullet' }],
                ['blockquote', 'code-block'],
                ['link', 'image', 'video'],
                ['clean']
            ];

            const quill = new Quill(quillContainer, {
                theme: 'snow',
                placeholder: 'Type or format rich content here...',
                modules: {
                    toolbar: toolbarOptions
                }
            });

            // Set initial content (supporting HTML)
            if (textarea.value) {
                quill.root.innerHTML = textarea.value;
            }

            // Sync on text change
            quill.on('text-change', function() {
                textarea.value = quill.root.innerHTML === '<p><br></p>' ? '' : quill.root.innerHTML;
            });

            // Sync on parent form submit
            const parentForm = textarea.closest('form');
            if (parentForm) {
                parentForm.addEventListener('submit', function() {
                    if (quillContainer.style.display !== 'none') {
                        textarea.value = quill.root.innerHTML === '<p><br></p>' ? '' : quill.root.innerHTML;
                    }
                });
            }

            // Custom Image Button Handler
            const toolbar = quill.getModule('toolbar');
            toolbar.addHandler('image', function() {
                activeQuillInstance = quill;
                const choice = confirm("Click 'OK' to Upload an Image from your computer (Recommended: 800×600 px).
Click 'Cancel' to insert an Image URL directly.");
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

            // Custom Video Button Handler
            toolbar.addHandler('video', function() {
                activeQuillInstance = quill;
                document.getElementById('cms-video-modal').classList.remove('hidden');
                document.getElementById('cms-video-url').focus();
            });

            // HTML Source View Toggle Handler
            let isHtmlView = false;
            const toggleBtn = topBar.querySelector('.html-toggle-btn');
            toggleBtn.addEventListener('click', function() {
                isHtmlView = !isHtmlView;
                if (isHtmlView) {
                    // Switch to raw HTML view
                    textarea.value = quill.root.innerHTML;
                    textarea.classList.remove('hidden');
                    textarea.style.display = 'block';
                    textarea.className = 'w-full px-3.5 py-2.5 bg-slate-900 text-green-400 font-mono text-xs rounded-xl border border-slate-700 leading-relaxed focus:ring-2 focus:ring-blue-500 focus:outline-none';
                    quillContainer.style.display = 'none';
                    quillContainer.previousElementSibling.style.display = 'none'; // hide toolbar
                    toggleBtn.innerHTML = '<i class="fas fa-eye text-emerald-600 mr-1"></i> <span class="text-emerald-700">Visual WYSIWYG View</span>';
                } else {
                    // Switch back to WYSIWYG
                    quill.root.innerHTML = textarea.value;
                    textarea.classList.add('hidden');
                    textarea.style.display = 'none';
                    quillContainer.style.display = 'block';
                    quillContainer.previousElementSibling.style.display = 'block'; // show toolbar
                    toggleBtn.innerHTML = '<i class="fas fa-code text-brand-blue mr-1"></i> <span>HTML Code View</span>';
                }
            });
        });
    });
})();
</script>
