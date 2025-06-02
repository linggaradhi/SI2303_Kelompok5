<script>
    window.services = @json($services);
</script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // ----- Modal Buat Order -----
        const openBtn = document.getElementById('openOrderModal');
        const closeBtn = document.getElementById('closeOrderModal');
        const cancelBtn = document.getElementById('cancelOrderModal');
        const modal = document.getElementById('orderModal');
        openBtn.addEventListener('click', () => modal.classList.remove('hidden'));
        closeBtn.addEventListener('click', () => modal.classList.add('hidden'));
        cancelBtn.addEventListener('click', () => modal.classList.add('hidden'));
        modal.addEventListener('click', function(e) {
            if (e.target === modal) {
                modal.classList.add('hidden');
            }
        });
        let shoesList = document.getElementById('shoes-list');
        let addShoeBtn = document.getElementById('add-shoe');
        addShoeBtn.addEventListener('click', function() {
            let rows = shoesList.querySelectorAll('.shoe-row');
            let clone = rows[0].cloneNode(true);
            clone.querySelectorAll('input, select').forEach(input => input.value = '');
            clone.querySelector('.remove-shoe').classList.remove('hidden');
            clone.querySelector('.shoe-number').textContent = rows.length + 1;
            shoesList.appendChild(clone);
        });
        shoesList.addEventListener('click', function(e) {
            if (e.target.classList.contains('remove-shoe')) {
                let row = e.target.closest('.shoe-row');
                row.remove();
                shoesList.querySelectorAll('.shoe-number').forEach((el, idx) => el.textContent = idx +
                    1);
            }
        });

        // -------- Modal Detail --------
        const openDetailBtns = document.querySelectorAll('.open-detail-modal');
        const detailModal = document.getElementById('detailOrderModal');
        const detailContent = document.getElementById('detail-order-content');
        const closeDetailBtn = document.getElementById('closeDetailOrderModal');
        openDetailBtns.forEach(btn => {
            btn.addEventListener('click', function() {
                const order = JSON.parse(this.dataset.order);
                const shoes = JSON.parse(this.dataset.shoes);
                let html = `
                <div class="grid grid-cols-2 gap-2 text-sm mb-4">
                    <div><span class="font-medium text-gray-500">Tanggal Order:</span><br>${order.tanggal_order}</div>
                    <div><span class="font-medium text-gray-500">Status:</span><br>
                        <span class="px-2 py-1 rounded-xl text-xs font-medium ${statusClass(order.status)}">
                            ${capitalize(order.status)}
                        </span>
                    </div>
                    <div><span class="font-medium text-gray-500">Total Harga:</span><br>Rp${numberFormat(order.total_harga)}</div>
                    <div><span class="font-medium text-gray-500">Catatan:</span><br>${order.catatan ?? '-'}</div>
                </div>
                <h2 class="font-semibold mb-3 mt-6">Daftar Sepatu</h2>
            `;
                shoes.forEach((shoe, i) => {
                    let layanan = (shoe.service && shoe.service.nama) ? shoe.service
                        .nama : (shoe.layanan ? capitalize(shoe.layanan) : '-');
                    let harga = (shoe.service && shoe.service.harga) ? shoe.service
                        .harga : 0;
                    html += `
                    <div class="border rounded-xl p-4 mb-4">
                        <div class="flex items-center mb-2">
                            <span class="font-bold text-blue-600 mr-3">Sepatu ${i+1}</span>
                            ${shoe.foto ? `<img src="/storage/${shoe.foto}" alt="Sepatu" class="w-16 h-16 object-cover rounded shadow ml-auto cursor-pointer img-zoomable" data-group="order-${order.id}" data-index="${i}">` : ''}
                        </div>
                        <div class="grid grid-cols-2 gap-2 text-sm">
                            <div><span class="font-medium text-gray-500">Merk:</span> ${shoe.merk}</div>
                            <div><span class="font-medium text-gray-500">Warna:</span> ${shoe.warna}</div>
                            <div><span class="font-medium text-gray-500">Tipe:</span> ${shoe.tipe}</div>
                            <div><span class="font-medium text-gray-500">Layanan:</span> ${layanan}</div>
                            <div><span class="font-medium text-gray-500">Harga Layanan:</span> Rp${numberFormat(harga)}</div>
                        </div>
                    </div>
                `;
                });
                if (['antri', 'proses'].includes(order.status)) {
                    html += `
                    <div class="flex justify-end mt-2 gap-2">
                        <button class="bg-yellow-400 hover:bg-yellow-500 text-white rounded-xl px-5 py-2 text-sm font-semibold shadow open-edit-modal"
                            data-order-id="${order.id}"
                            data-order='${JSON.stringify(order)}'
                            data-shoes='${JSON.stringify(shoes)}'
                        >
                            Edit Order
                        </button>
                        <button type="button"
                            class="bg-red-500 hover:bg-red-600 text-white rounded-xl px-5 py-2 text-sm font-semibold shadow open-cancel-order"
                            data-order-id="${order.id}">
                            Batalkan Order
                        </button>
                    </div>
                `;
                }
                detailContent.innerHTML = html;
                detailModal.classList.remove('hidden');
                const editBtn = document.querySelector('.open-edit-modal');
                if (editBtn) {
                    editBtn.addEventListener('click', function() {
                        openEditOrderModal(this);
                    });
                }
            });
        });
        closeDetailBtn.addEventListener('click', () => detailModal.classList.add('hidden'));
        detailModal.addEventListener('click', function(e) {
            if (e.target === detailModal) {
                detailModal.classList.add('hidden');
            }
        });

        const editModal = document.getElementById('editOrderModal');
        const closeEditBtn = document.getElementById('closeEditOrderModal');
        const cancelEditBtn = document.getElementById('cancelEditOrderModal');
        let editShoesList = document.getElementById('edit-shoes-list');
        let addEditShoeBtn = document.getElementById('add-edit-shoe');
        let formEditOrder = document.getElementById('formEditOrder');

        function openEditOrderModal(editBtn) {
            let order = JSON.parse(editBtn.dataset.order);
            let shoes = JSON.parse(editBtn.dataset.shoes);
            formEditOrder.action = `/customer/orders/${order.id}`;
            editShoesList.innerHTML = '';
            document.getElementById('edit-order-catatan').value = order.catatan ?? '';
            shoes.forEach(function(shoe, idx) {
                let shoeDiv = makeEditShoeRow(idx + 1, shoe);
                editShoesList.appendChild(shoeDiv);
            });
            editModal.classList.remove('hidden');
        }
        closeEditBtn.addEventListener('click', () => editModal.classList.add('hidden'));
        cancelEditBtn.addEventListener('click', () => editModal.classList.add('hidden'));
        editModal.addEventListener('click', function(e) {
            if (e.target === editModal) {
                editModal.classList.add('hidden');
            }
        });
        addEditShoeBtn.addEventListener('click', function() {
            let rows = editShoesList.querySelectorAll('.shoe-row');
            let shoeDiv = makeEditShoeRow(rows.length + 1, null);
            editShoesList.appendChild(shoeDiv);
        });
        editShoesList.addEventListener('click', function(e) {
            if (e.target.classList.contains('remove-shoe')) {
                let row = e.target.closest('.shoe-row');
                row.remove();
                editShoesList.querySelectorAll('.shoe-number').forEach((el, idx) => el.textContent =
                    idx + 1);
            }
        });

        function makeEditShoeRow(no, shoe) {
            let div = document.createElement('div');
            div.className = 'shoe-row border-b pb-4 mb-4';

            let options = `<option value="">-- Pilih Layanan --</option>`;
            if (window.services && Array.isArray(window.services)) {
                window.services.forEach(service => {
                    let selected = shoe && shoe.service_id == service.id ? 'selected' : '';
                    options +=
                        `<option value="${service.id}" ${selected}>${service.nama} (Rp${numberFormat(service.harga)})</option>`;
                });
            }

            div.innerHTML = `
            <div class="font-medium mb-2">Sepatu <span class="shoe-number">${no}</span></div>
            <div class="mb-2">
                <label class="block mb-1">Merk Sepatu</label>
                <input type="text" name="merk[]" required class="w-full border rounded-lg px-3 py-2" value="${shoe ? shoe.merk : ''}" />
            </div>
            <div class="mb-2">
                <label class="block mb-1">Warna Sepatu</label>
                <input type="text" name="warna[]" required class="w-full border rounded-lg px-3 py-2" value="${shoe ? shoe.warna : ''}" />
            </div>
            <div class="mb-2">
                <label class="block mb-1">Tipe/Jenis Sepatu</label>
                <input type="text" name="tipe[]" required class="w-full border rounded-lg px-3 py-2" value="${shoe ? shoe.tipe : ''}" />
            </div>
            <div class="mb-2">
                <label class="block mb-1">Layanan Cuci</label>
                <select name="service_id[]" required class="w-full border rounded-lg px-3 py-2">
                    ${options}
                </select>
            </div>
            <div class="mb-2">
                <label class="block mb-1">Foto Sepatu</label>
                ${(shoe && shoe.foto) ? `<img src="/storage/${shoe.foto}" alt="Sepatu" class="w-12 h-12 object-cover rounded shadow mb-2 cursor-pointer img-zoomable" data-group="order-${shoe.order_id}" data-index="${no-1}">` : ''}
                <input type="file" name="foto[]" accept="image/*" class="w-full border rounded-lg px-3 py-2" />
                <span class="text-xs text-gray-400">${shoe && shoe.foto ? 'Biarkan kosong jika tidak ganti foto.' : ''}</span>
            </div>
            <button type="button" class="remove-shoe bg-red-100 text-red-700 rounded px-2 py-1 text-xs mt-2 ${no==1?'hidden':''}">Hapus Sepatu</button>
        `;
            return div;
        }

        function statusClass(status) {
            if (status == 'antri') return 'bg-yellow-100 text-yellow-700';
            if (status == 'proses') return 'bg-blue-100 text-blue-700';
            if (status == 'selesai') return 'bg-green-100 text-green-700';
            if (status == 'batal') return 'bg-red-100 text-red-700';
            return 'bg-gray-100 text-gray-600';
        }

        function capitalize(str) {
            return str ? str.charAt(0).toUpperCase() + str.slice(1) : '';
        }

        function numberFormat(n) {
            return parseInt(n).toLocaleString('id-ID');
        }

        const imgZoomModal = document.getElementById('imgZoomModal');
        const imgZoomBox = document.getElementById('imgZoomBox');
        const zoomedImg = document.getElementById('zoomedImg');
        const closeImgZoom = document.getElementById('closeImgZoom');
        const prevImgZoom = document.getElementById('prevImgZoom');
        const nextImgZoom = document.getElementById('nextImgZoom');
        let currentGroup = [];
        let currentIdx = 0;
        document.body.addEventListener('click', function(e) {
            if (e.target.classList.contains('img-zoomable')) {
                const groupName = e.target.dataset.group;
                const groupImgs = Array.from(document.querySelectorAll(
                    `img.img-zoomable[data-group="${groupName}"]`));
                currentGroup = groupImgs.map(img => img.src);
                currentIdx = parseInt(e.target.dataset.index) || 0;
                showZoomImg(currentIdx);
                imgZoomModal.classList.remove('hidden');
                setTimeout(() => {
                    imgZoomBox.classList.remove('animate-none');
                    imgZoomBox.classList.add('opacity-100', 'scale-100');
                    imgZoomBox.classList.remove('opacity-0', 'scale-95');
                }, 20);
            }
        });

        function showZoomImg(idx) {
            zoomedImg.src = currentGroup[idx];
            prevImgZoom.classList.toggle('hidden', idx <= 0);
            nextImgZoom.classList.toggle('hidden', idx >= currentGroup.length - 1);
        }
        prevImgZoom.addEventListener('click', function(e) {
            e.stopPropagation();
            if (currentIdx > 0) {
                currentIdx--;
                showZoomImg(currentIdx);
            }
        });
        nextImgZoom.addEventListener('click', function(e) {
            e.stopPropagation();
            if (currentIdx < currentGroup.length - 1) {
                currentIdx++;
                showZoomImg(currentIdx);
            }
        });
        closeImgZoom.addEventListener('click', closeGallery);
        imgZoomModal.addEventListener('click', function(e) {
            if (e.target === imgZoomModal) {
                closeGallery();
            }
        });

        function closeGallery() {
            imgZoomBox.classList.remove('opacity-100', 'scale-100');
            imgZoomBox.classList.add('opacity-0', 'scale-95');
            setTimeout(() => {
                imgZoomModal.classList.add('hidden');
                zoomedImg.src = '';
                imgZoomBox.classList.add('animate-none');
            }, 200);
        }

        document.body.addEventListener('click', function(e) {
            if (e.target.classList.contains('open-cancel-order')) {
                e.preventDefault();
                let orderId = e.target.dataset.orderId;
                Swal.fire({
                    title: 'Batalkan Order?',
                    text: 'Order yang sudah dibatalkan tidak dapat dipulihkan.',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#757575',
                    confirmButtonText: 'Ya, Batalkan!',
                    cancelButtonText: 'Ga jadi'
                }).then((result) => {
                    if (result.isConfirmed) {
                        let form = document.getElementById('formCancelOrder');
                        form.action = '/customer/orders/' + orderId + '/cancel';
                        form.submit();
                    }
                });
            }
        });
    });
</script>
