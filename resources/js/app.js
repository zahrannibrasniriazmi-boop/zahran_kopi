document.addEventListener('DOMContentLoaded', () => {
    // 1. Toggle menu navigasi mobile & sidebar admin (dengan dukungan Escape & klik luar)
    document.querySelectorAll('[data-toggle-target]').forEach((trigger) => {
        trigger.addEventListener('click', () => {
            const targetId = trigger.getAttribute('data-toggle-target');
            const target = document.getElementById(targetId);
            if (!target) return;

            const isHidden = target.classList.toggle('hidden');
            trigger.setAttribute('aria-expanded', String(!isHidden));

            const backdropId = trigger.getAttribute('data-toggle-backdrop');
            if (backdropId) {
                document.getElementById(backdropId)?.classList.toggle('hidden', isHidden);
            }
        });
    });

    document.addEventListener('keydown', (event) => {
        if (event.key !== 'Escape') return;
        document.querySelectorAll('[data-toggle-target]').forEach((trigger) => {
            const target = document.getElementById(trigger.getAttribute('data-toggle-target'));
            if (target && !target.classList.contains('hidden') && trigger.getAttribute('aria-expanded') === 'true') {
                target.classList.add('hidden');
                trigger.setAttribute('aria-expanded', 'false');
                const backdropId = trigger.getAttribute('data-toggle-backdrop');
                if (backdropId) {
                    document.getElementById(backdropId)?.classList.add('hidden');
                }
            }
        });
    });

    // 2. Tutup notifikasi flash secara manual
    document.querySelectorAll('[data-dismiss-alert]').forEach((btn) => {
        btn.addEventListener('click', () => {
            btn.closest('[data-alert-box]')?.remove();
        });
    });

    // 3. Auto-slug saat mengetik nama produk/kategori (jika slug belum diubah manual)
    const slugSource = document.querySelector('[data-slug-source]');
    const slugTarget = document.querySelector('[data-slug-target]');
    if (slugSource && slugTarget) {
        let manuallyEdited = slugTarget.value.trim().length > 0 && slugTarget.dataset.isCreate !== 'true';
        slugTarget.addEventListener('input', () => {
            manuallyEdited = slugTarget.value.trim().length > 0;
        });
        slugSource.addEventListener('input', () => {
            if (manuallyEdited) return;
            const slug = slugSource.value
                .toLowerCase()
                .normalize('NFD')
                .replace(/[\u0300-\u036f]/g, '')
                .replace(/[^a-z0-9\s-]/g, '')
                .trim()
                .replace(/\s+/g, '-')
                .replace(/-+/g, '-');
            slugTarget.value = slug;
        });
    }

    // 4. Pratinjau gambar langsung saat memilih file upload
    const imageInput = document.querySelector('[data-image-input]');
    const imagePreview = document.querySelector('[data-image-preview]');
    const imagePlaceholder = document.querySelector('[data-image-placeholder]');
    const imageMeta = document.querySelector('[data-image-meta]');

    if (imageInput && imagePreview) {
        imageInput.addEventListener('change', (event) => {
            const file = event.target.files?.[0];
            if (!file) return;

            const sizeKb = Math.round(file.size / 1024);
            if (imageMeta) {
                imageMeta.textContent = `${file.name} (${sizeKb} KB)`;
                imageMeta.classList.remove('hidden');
            }

            const reader = new FileReader();
            reader.onload = (e) => {
                imagePreview.src = e.target.result;
                imagePreview.classList.remove('hidden');
                imagePlaceholder?.classList.add('hidden');
            };
            reader.readAsDataURL(file);
        });
    }

    // 5. Modal konfirmasi hapus yang ramah pengguna di dashboard admin
    const deleteModal = document.getElementById('delete-confirm-modal');
    const deleteItemName = document.getElementById('delete-item-name');
    const confirmDeleteBtn = document.getElementById('confirm-delete-btn');
    const cancelDeleteBtns = document.querySelectorAll('[data-close-delete-modal]');
    let pendingDeleteForm = null;

    document.querySelectorAll('[data-delete-trigger]').forEach((button) => {
        button.addEventListener('click', (e) => {
            e.preventDefault();
            pendingDeleteForm = button.closest('form');
            const label = button.getAttribute('data-item-name') || 'item ini';

            if (!deleteModal) {
                if (window.confirm(`Apakah Anda yakin ingin menghapus ${label}?`)) {
                    pendingDeleteForm?.submit();
                }
                return;
            }

            if (deleteItemName) {
                deleteItemName.textContent = label;
            }
            deleteModal.classList.remove('hidden');
            deleteModal.classList.add('flex');
        });
    });

    confirmDeleteBtn?.addEventListener('click', () => {
        pendingDeleteForm?.submit();
    });

    cancelDeleteBtns.forEach((btn) => {
        btn.addEventListener('click', () => {
            deleteModal?.classList.add('hidden');
            deleteModal?.classList.remove('flex');
            pendingDeleteForm = null;
        });
    });

    // 6. Pembuat pesan WhatsApp & stepper jumlah di halaman detail produk
    const waQtyInput = document.getElementById('wa-qty-input');
    const waOrderLinks = document.querySelectorAll('[data-wa-order-link]');
    const waSubtotalEl = document.getElementById('wa-subtotal');
    const qtyMinusBtn = document.querySelector('[data-qty-minus]');
    const qtyPlusBtn = document.querySelector('[data-qty-plus]');

    if (waQtyInput && waOrderLinks.length > 0) {
        const formatRupiah = (amount) => 'Rp ' + new Intl.NumberFormat('id-ID').format(amount);

        const updateWaState = () => {
            const maxQty = parseInt(waQtyInput.getAttribute('max') || '9999', 10);
            const rawQty = parseInt(waQtyInput.value || '1', 10);
            const qty = Math.min(Math.max(1, Number.isNaN(rawQty) ? 1 : rawQty), Math.max(1, maxQty));
            waQtyInput.value = String(qty);

            const unitPrice = parseInt(waQtyInput.dataset.unitPrice || '0', 10);
            if (waSubtotalEl && unitPrice > 0) {
                waSubtotalEl.textContent = formatRupiah(unitPrice * qty);
            }

            waOrderLinks.forEach((link) => {
                const phone = link.dataset.phone;
                const product = link.dataset.product;
                const price = link.dataset.price;
                const seller = link.dataset.seller;
                const text = `Halo ${seller}, saya ingin memesan produk *${product}* (${price}) sebanyak *${qty} unit* melalui Zahran Kopi. Apakah stok masih tersedia?`;
                link.href = `https://wa.me/${phone}?text=${encodeURIComponent(text)}`;
            });
        };

        waQtyInput.addEventListener('input', updateWaState);
        qtyMinusBtn?.addEventListener('click', () => {
            waQtyInput.value = String(Math.max(1, parseInt(waQtyInput.value || '1', 10) - 1));
            updateWaState();
        });
        qtyPlusBtn?.addEventListener('click', () => {
            const maxQty = parseInt(waQtyInput.getAttribute('max') || '9999', 10);
            waQtyInput.value = String(Math.min(maxQty, parseInt(waQtyInput.value || '1', 10) + 1));
            updateWaState();
        });
    }
});
