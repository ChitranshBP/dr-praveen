<!-- CMS Hyperlink & Rich Text Toolbar Component -->
<div id="cms-link-modal" class="fixed inset-0 z-50 bg-slate-900/60 backdrop-blur-sm hidden items-center justify-center p-4">
    <div class="bg-white w-full max-w-lg rounded-2xl shadow-2xl border border-slate-200 overflow-hidden transform transition-all">
        <!-- Modal Header -->
        <div class="px-6 py-4 bg-slate-50 border-b border-slate-100 flex items-center justify-between">
            <div class="flex items-center space-x-2">
                <span class="w-7 h-7 rounded-lg bg-blue-50 text-brand-blue flex items-center justify-center text-sm font-bold">
                    <i class="fas fa-link"></i>
                </span>
                <h3 class="text-sm font-bold text-slate-800">Insert / Convert Hyperlink</h3>
            </div>
            <button type="button" onclick="cmsCloseLinkModal()" class="text-slate-400 hover:text-slate-600 text-lg">&times;</button>
        </div>

        <!-- Modal Body -->
        <div class="p-6 space-y-4 text-xs">
            <!-- Text to display -->
            <div>
                <label class="block font-bold text-slate-700 mb-1">Text to Display (Anchor Text)</label>
                <input type="text" id="cms-link-text" placeholder="e.g. Stroke Care / Click here" class="w-full px-3.5 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-xs font-semibold text-slate-800 focus:bg-white focus:ring-2 focus:ring-blue-500 focus:outline-none">
                <p class="text-[10px] text-slate-400 mt-1">If you selected text before clicking, it appears here automatically.</p>
            </div>

            <!-- Page Presets Dropdown -->
            <div>
                <label class="block font-bold text-slate-700 mb-1">Select Website Page (Internal Link)</label>
                <select id="cms-link-presets" onchange="cmsSelectPresetLink(this.value)" class="w-full px-3.5 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-xs font-semibold text-slate-800 focus:bg-white focus:ring-2 focus:ring-blue-500 focus:outline-none">
                    <option value="">-- Choose a Website Page or enter custom URL below --</option>
                    <optgroup label="Core Pages">
                        <option value="/">Home Page (/)</option>
                        <option value="/about">About Dr. Praveen Gupta (/about)</option>
                        <option value="/why-choose-dr-praveen-gupta">Why Choose Us</option>
                        <option value="/services">All Services Directory (/services)</option>
                        <option value="/team">Our Medical Team (/team)</option>
                        <option value="/contact-us-top-neurologist-delhi-ncr">Contact & Clinic Info</option>
                        <option value="/enquire">Landing Page (/enquire)</option>
                    </optgroup>
                    <optgroup label="Conditions & Clinical Care">
                        <option value="/stroke">Stroke Management (/stroke)</option>
                        <option value="/epilepsy">Epilepsy & Seizures (/epilepsy)</option>
                        <option value="/parkinsons">Parkinson's Disease (/parkinsons)</option>
                        <option value="/migraine">Migraine Care (/migraine)</option>
                        <option value="/headache">Headache Clinic (/headache)</option>
                        <option value="/movement">Movement Disorders (/movement)</option>
                        <option value="/ms">Multiple Sclerosis (/ms)</option>
                        <option value="/vertigo">Vertigo Clinic (/vertigo)</option>
                        <option value="/neuropathy">Peripheral Neuropathy (/neuropathy)</option>
                        <option value="/brain-tumor-surgery">Brain Tumor Surgery (/brain-tumor-surgery)</option>
                        <option value="/functional-neurosurgery">Functional Neurosurgery / DBS (/functional-neurosurgery)</option>
                        <option value="/spine-surgery">Spine Surgery (/spine-surgery)</option>
                        <option value="/neurovascular-surgery">Neurovascular Surgery (/neurovascular-surgery)</option>
                        <option value="/memory-clinic">Memory Clinic / Dementia (/memory-clinic)</option>
                        <option value="/brain-health-center">Brain Health Center (/brain-health-center)</option>
                        <option value="/neuro-rehabilitation-center">Neuro-Rehabilitation Hub (/neuro-rehabilitation-center)</option>
                        <option value="/rtms-therapy">rTMS Therapy Center (/rtms-therapy)</option>
                        <option value="/neurocritical-acute-stroke-care">Neurocritical & Acute Stroke Care</option>
                    </optgroup>
                    <optgroup label="Consultation & Help">
                        <option value="/neurology-consultation">Consultation Guide</option>
                        <option value="/online-neurologist-consultation">Online Video Consultation</option>
                        <option value="/neurology-second-opinion">Second Opinion Request</option>
                        <option value="/emergency-neurology-care">Emergency Care</option>
                        <option value="/brain-stroke-helpline">24/7 Stroke Helpline</option>
                        <option value="/patient-reviews">Patient Reviews & Testimonials</option>
                        <option value="/patient-success-stories">Success Stories</option>
                        <option value="/videos">Videos Hub</option>
                        <option value="/blog">Health Blogs</option>
                        <option value="/dr-praveen-gupta-blog">Articles Library</option>
                    </optgroup>
                </select>
            </div>

            <!-- Custom URL Input -->
            <div>
                <label class="block font-bold text-slate-700 mb-1">Target URL / Web Address</label>
                <input type="text" id="cms-link-url" placeholder="e.g. /stroke or https://..." class="w-full px-3.5 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-xs font-mono font-medium text-slate-800 focus:bg-white focus:ring-2 focus:ring-blue-500 focus:outline-none">
            </div>

            <!-- Link Options -->
            <div class="flex items-center space-x-4 pt-1">
                <label class="flex items-center space-x-2 cursor-pointer select-none">
                    <input type="checkbox" id="cms-link-target" class="w-4 h-4 text-blue-600 rounded border-slate-300 focus:ring-blue-500">
                    <span class="text-slate-700 font-semibold">Open in New Tab (target="_blank")</span>
                </label>
            </div>
        </div>

        <!-- Modal Footer -->
        <div class="px-6 py-3.5 bg-slate-50 border-t border-slate-100 flex items-center justify-end space-x-2">
            <button type="button" onclick="cmsCloseLinkModal()" class="px-4 py-2 bg-slate-200 hover:bg-slate-300 text-slate-700 font-bold text-xs rounded-xl transition-colors">Cancel</button>
            <button type="button" onclick="cmsApplyLink()" class="px-5 py-2 bg-brand-blue hover:bg-blue-700 text-white font-bold text-xs rounded-xl shadow-md transition-all flex items-center space-x-1.5">
                <i class="fas fa-check"></i>
                <span>Insert Hyperlink</span>
            </button>
        </div>
    </div>
</div>

<script>
(function() {
    var activeTextarea = null;
    var savedSelection = { start: 0, end: 0, text: '' };

    function initToolbarForTextarea(ta) {
        if (ta.dataset.hasToolbar) return;
        ta.dataset.hasToolbar = 'true';

        // Container wrapper
        var wrapper = document.createElement('div');
        wrapper.className = 'cms-editor-wrapper relative mb-2';
        ta.parentNode.insertBefore(wrapper, ta);

        // Toolbar HTML
        var toolbar = document.createElement('div');
        toolbar.className = 'flex flex-wrap items-center gap-1.5 p-2 bg-slate-100/90 border border-slate-200 rounded-t-xl text-xs font-semibold text-slate-700 border-b-0';
        toolbar.innerHTML = `
            <span class="text-[10px] font-bold text-slate-400 uppercase tracking-wider mr-1"><i class="fas fa-tools text-brand-blue mr-1"></i>Format:</span>
            
            <button type="button" class="tb-btn tb-link px-2.5 py-1 bg-white hover:bg-blue-50 text-brand-blue hover:text-blue-700 border border-slate-200 rounded-lg shadow-sm flex items-center space-x-1 transition-all" title="Insert or Convert Selected Text into a Hyperlink">
                <i class="fas fa-link text-[11px]"></i>
                <span class="font-bold text-[11px]">Add Link</span>
            </button>
            
            <div class="w-px h-4 bg-slate-200 mx-1"></div>

            <button type="button" class="tb-btn tb-bold px-2 py-1 bg-white hover:bg-slate-50 border border-slate-200 rounded-lg shadow-sm" title="Bold Text (<strong>...</strong>)">
                <i class="fas fa-bold text-[10px]"></i>
            </button>
            
            <button type="button" class="tb-btn tb-italic px-2 py-1 bg-white hover:bg-slate-50 border border-slate-200 rounded-lg shadow-sm" title="Italic Text (<em>...</em>)">
                <i class="fas fa-italic text-[10px]"></i>
            </button>
            
            <button type="button" class="tb-btn tb-gradient px-2 py-1 bg-white hover:bg-slate-50 border border-slate-200 rounded-lg shadow-sm text-brand-blue" title="Gradient Highlight (<span class='gradient-text'>...</span>)">
                <i class="fas fa-magic text-[10px] text-cyan-600"></i>
                <span class="text-[10px] font-bold">Gradient</span>
            </button>

            <button type="button" class="tb-btn tb-cyan px-2 py-1 bg-white hover:bg-slate-50 border border-slate-200 rounded-lg shadow-sm text-cyan-600" title="Cyan Highlight (<span class='text-cyan-accent'>...</span>)">
                <i class="fas fa-palette text-[10px]"></i>
                <span class="text-[10px] font-bold">Cyan Text</span>
            </button>

            <button type="button" class="tb-btn tb-bullet px-2 py-1 bg-white hover:bg-slate-50 border border-slate-200 rounded-lg shadow-sm" title="Insert Bullet (•)">
                <span class="text-[11px] font-bold">&bull; Bullet</span>
            </button>

            <div class="ml-auto flex items-center space-x-1">
                <button type="button" class="tb-btn tb-preview px-2.5 py-1 bg-white hover:bg-slate-50 border border-slate-200 rounded-lg shadow-sm text-slate-600 flex items-center space-x-1" title="Toggle Live Preview of Formatted Content & Links">
                    <i class="fas fa-eye text-[10px] text-emerald-600"></i>
                    <span class="text-[10px] font-bold">Live Preview</span>
                </button>
            </div>
        `;

        wrapper.appendChild(toolbar);
        wrapper.appendChild(ta);

        // Adjust textarea border radius
        ta.classList.remove('rounded-xl', 'rounded-2xl');
        ta.classList.add('rounded-b-xl');

        // Live Preview Box
        var previewBox = document.createElement('div');
        previewBox.className = 'cms-preview-box hidden mt-2 p-3.5 bg-slate-50 border border-slate-200 rounded-xl text-xs leading-relaxed text-slate-700';
        wrapper.appendChild(previewBox);

        // Wire toolbar buttons
        toolbar.querySelector('.tb-link').addEventListener('click', function() {
            openLinkModalFor(ta);
        });

        toolbar.querySelector('.tb-bold').addEventListener('click', function() {
            wrapSelection(ta, '<strong>', '</strong>');
        });

        toolbar.querySelector('.tb-italic').addEventListener('click', function() {
            wrapSelection(ta, '<em>', '</em>');
        });

        toolbar.querySelector('.tb-gradient').addEventListener('click', function() {
            wrapSelection(ta, '<span class="gradient-text">', '</span>');
        });

        toolbar.querySelector('.tb-cyan').addEventListener('click', function() {
            wrapSelection(ta, '<span class="text-cyan-accent font-semibold">', '</span>');
        });

        toolbar.querySelector('.tb-bullet').addEventListener('click', function() {
            insertAtCursor(ta, '• ');
        });

        toolbar.querySelector('.tb-preview').addEventListener('click', function() {
            if (previewBox.classList.contains('hidden')) {
                previewBox.classList.remove('hidden');
                updatePreview();
                this.classList.add('bg-emerald-50', 'text-emerald-700', 'border-emerald-300');
            } else {
                previewBox.classList.add('hidden');
                this.classList.remove('bg-emerald-50', 'text-emerald-700', 'border-emerald-300');
            }
        });

        function updatePreview() {
            var raw = ta.value;
            // Convert markdown [text](url) to <a>
            raw = raw.replace(/\[([^\]]+)\]\((https?:\/\/[^\s\)\"]+|\/[^\s\)\"]+|tel:[^\s\)\"]+|mailto:[^\s\)\"]+)\)/gi, function(m, t, u) {
                return '<a href="' + u + '" class="text-blue-600 hover:text-cyan-600 underline font-semibold" target="_blank">' + t + '</a>';
            });
            // Convert newlines to breaks
            var html = raw.replace(/\n/g, '<br>');
            previewBox.innerHTML = '<strong class="text-[10px] uppercase tracking-wider text-slate-400 block mb-1.5"><i class="fas fa-eye text-emerald-500 mr-1"></i>Live Preview:</strong><div class="prose prose-xs max-w-none text-slate-800">' + html + '</div>';
        }

        ta.addEventListener('input', function() {
            if (!previewBox.classList.contains('hidden')) {
                updatePreview();
            }
        });
    }

    function wrapSelection(ta, before, after) {
        var start = ta.selectionStart;
        var end = ta.selectionEnd;
        var val = ta.value;
        var selected = val.substring(start, end) || 'text';
        var replacement = before + selected + after;
        ta.value = val.substring(0, start) + replacement + val.substring(end);
        ta.focus();
        ta.setSelectionRange(start + before.length, start + before.length + selected.length);
        ta.dispatchEvent(new Event('input', { bubbles: true }));
    }

    function insertAtCursor(ta, text) {
        var start = ta.selectionStart;
        var end = ta.selectionEnd;
        var val = ta.value;
        ta.value = val.substring(0, start) + text + val.substring(end);
        ta.focus();
        ta.setSelectionRange(start + text.length, start + text.length);
        ta.dispatchEvent(new Event('input', { bubbles: true }));
    }

    function openLinkModalFor(ta) {
        activeTextarea = ta;
        savedSelection.start = ta.selectionStart;
        savedSelection.end = ta.selectionEnd;
        savedSelection.text = ta.value.substring(ta.selectionStart, ta.selectionEnd).trim();

        var textInput = document.getElementById('cms-link-text');
        var urlInput = document.getElementById('cms-link-url');
        var presets = document.getElementById('cms-link-presets');
        var targetBox = document.getElementById('cms-link-target');

        textInput.value = savedSelection.text || '';
        urlInput.value = '';
        presets.value = '';
        targetBox.checked = false;

        var modal = document.getElementById('cms-link-modal');
        modal.classList.remove('hidden');
        modal.classList.add('flex');

        if (!savedSelection.text) {
            textInput.focus();
        } else {
            urlInput.focus();
        }
    }

    window.cmsCloseLinkModal = function() {
        var modal = document.getElementById('cms-link-modal');
        modal.classList.add('hidden');
        modal.classList.remove('flex');
        if (activeTextarea) activeTextarea.focus();
    };

    window.cmsSelectPresetLink = function(val) {
        if (val) {
            document.getElementById('cms-link-url').value = val;
            var textInput = document.getElementById('cms-link-text');
            if (!textInput.value) {
                var sel = document.getElementById('cms-link-presets');
                var optText = sel.options[sel.selectedIndex].text.replace(/\s*\(\/.*?\)/, '');
                textInput.value = optText;
            }
        }
    };

    window.cmsApplyLink = function() {
        if (!activeTextarea) return;

        var text = document.getElementById('cms-link-text').value.trim();
        var url = document.getElementById('cms-link-url').value.trim();
        var targetBlank = document.getElementById('cms-link-target').checked;

        if (!url) {
            alert('Please enter a target URL or select a website page from the list.');
            return;
        }

        if (!text) {
            text = url;
        }

        var linkHtml = '';
        if (targetBlank) {
            linkHtml = '<a href="' + url + '" target="_blank" rel="noopener noreferrer">' + text + '</a>';
        } else {
            linkHtml = '<a href="' + url + '">' + text + '</a>';
        }

        var val = activeTextarea.value;
        var start = savedSelection.start;
        var end = savedSelection.end;

        activeTextarea.value = val.substring(0, start) + linkHtml + val.substring(end);
        activeTextarea.focus();
        activeTextarea.setSelectionRange(start + linkHtml.length, start + linkHtml.length);
        activeTextarea.dispatchEvent(new Event('input', { bubbles: true }));

        cmsCloseLinkModal();
    };

    // Auto-discover all textareas on DOM load
    document.addEventListener('DOMContentLoaded', function() {
        document.querySelectorAll('textarea').forEach(function(ta) {
            initToolbarForTextarea(ta);
        });
    });

})();
</script>
