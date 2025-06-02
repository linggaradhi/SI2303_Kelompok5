<script>
    document.addEventListener('DOMContentLoaded', function() {
        // -------- Modal Detail ADMIN --------
        const openDetailBtns = document.querySelectorAll('.open-detail-modal');
        const detailModal = document.getElementById('detailOrderModal');
        const detailContent = document.getElementById('detail-order-content-admin');
        const closeDetailBtn = document.getElementById('closeDetailOrderModal');

        openDetailBtns.forEach(btn => {
            btn.addEventListener('click', function() {
                let order, shoes, customer;
                try {
                    order = JSON.parse(this.dataset.order);
                    shoes = JSON.parse(this.dataset.shoes);
                    customer = this.dataset.customer;
                } catch (e) {
                    console.error("RAW DATA:", this.dataset.order, this.dataset.shoes);
                    alert('Gagal mengambil data order!');
                    return;
                }
                let html = `
            <div class="grid grid-cols-2 gap-2 text-sm mb-4">
                <div><span class="font-medium text-gray-500">Tanggal Order:</span><br>${order.tanggal_order}</div>
                <div><span class="font-medium text-gray-500">Status:</span><br>
                    <span class="px-2 py-1 rounded-xl text-xs font-medium ${statusClass(order.status)}">
                        ${capitalize(order.status)}
                    </span>
                </div>
                <div><span class="font-medium text-gray-500">Customer:</span><br>${customer}</div>
                <div><span class="font-medium text-gray-500">Total Harga:</span><br>Rp${numberFormat(order.total_harga)}</div>
            </div>
            <div class="mb-4"><span class="font-medium text-gray-500">Catatan Customer:</span><br>${order.catatan ?? '-'}</div>
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
                        ${shoe.foto ? `<img src="/storage/${shoe.foto}" alt="Sepatu" class="w-16 h-16 object-cover rounded shadow ml-auto">` : ''}
                    </div>
                    <div class="grid grid-cols-2 gap-2 text-sm">
                        <div><span class="font-medium text-gray-500">Merk:</span> ${shoe.merk}</div>
                        <div><span class="font-medium text-gray-500">Warna:</span> ${shoe.warna}</div>
                        <div><span class="font-medium text-gray-500">Tipe:</span> ${shoe.tipe}</div>
                        <div><span class="font-medium text-gray-500">Layanan:</span> ${shoe.service.nama}</div>
                        <div><span class="font-medium text-gray-500">Harga Layanan:</span> Rp${numberFormat(shoe.service
                        .harga)}</div>
                    </div>
                </div>
                `;
                });

                if (!['selesai', 'batal'].includes(order.status)) {
                    html += `
                <div class="flex flex-col gap-2 mt-2">
                    <label class="font-medium mb-1 text-sm">Ubah Status Order:</label>
                    <div class="flex gap-2">
                        ${statusButton(order.id, 'antri', order.status)}
                        ${statusButton(order.id, 'proses', order.status)}
                        ${statusButton(order.id, 'selesai', order.status)}
                        ${statusButton(order.id, 'batal', order.status)}
                    </div>
                </div>
                `;
                }

                detailContent.innerHTML = html;
                detailModal.classList.remove('hidden');
            });
        });

        closeDetailBtn.addEventListener('click', () => detailModal.classList.add('hidden'));
        detailModal.addEventListener('click', function(e) {
            if (e.target === detailModal) {
                detailModal.classList.add('hidden');
            }
        });

        document.body.addEventListener('click', function(e) {
            if (e.target.id === 'btnPrintOrder' || (e.target.closest && e.target.closest(
                    '#btnPrintOrder'))) {
                e.preventDefault();
                let orderContent = document.getElementById('detail-order-content-admin').innerHTML;
                let printWindow = window.open('', '_blank');
                printWindow.document.write(`
                <html>
                <head>
                    <title>Print Order</title>
                    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
                    <style>
                        @media print {
                            body { background: white !important; }
                        }
                        .no-print { display: none !important; }
                    </style>
                </head>
                <body class="bg-white p-8">
                    <div class="mb-6">
                        <h1 class="text-2xl font-bold mb-1">Detail Order Cuci Sepatu</h1>
                        <p class="text-sm text-gray-600 mb-4">Dicetak: ${new Date().toLocaleString('id-ID')}</p>
                    </div>
                    <div>
                        ${orderContent}
                    </div>
                    <script>
                        window.onload = function(){ window.print(); window.onafterprint = function(){ window.close(); } }
                    <\/script>
                </body>
                </html>
            `);
                printWindow.document.close();
            }
        });

        // -------- Update Status Order (dengan SweetAlert konfirmasi) --------
        document.body.addEventListener('click', function(e) {
            if (e.target.classList.contains('btn-update-status-order')) {
                let orderId = e.target.dataset.orderId;
                let newStatus = e.target.dataset.status;

                let statusText = {
                    'antri': 'Antri',
                    'proses': 'Proses',
                    'selesai': 'Selesai',
                    'batal': 'Batal'
                };

                Swal.fire({
                    title: 'Ubah Status Order?',
                    text: 'Yakin ingin mengubah status menjadi "' + statusText[newStatus] +
                        '"?',
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#aaa',
                    confirmButtonText: 'Ya, Ubah!',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        let form = document.getElementById('formUpdateStatusOrder');
                        document.getElementById('inputStatusOrder').value = newStatus;
                        form.action = '/admin/orders/' + orderId + '/status';
                        form.submit();
                    }
                });
            }
        });

        // --- Helper JS ---
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

        function statusButton(orderId, status, current) {
            let colors = {
                antri: 'bg-yellow-100 text-yellow-700 hover:bg-yellow-200',
                proses: 'bg-blue-100 text-blue-700 hover:bg-blue-200',
                selesai: 'bg-green-100 text-green-700 hover:bg-green-200',
                batal: 'bg-red-100 text-red-700 hover:bg-red-200'
            };
            let isActive = current === status;
            return `<button type="button"
            class="btn-update-status-order px-3 py-1 rounded ${colors[status]} ${isActive?'font-bold ring-2 ring-black/30':''}"
            data-order-id="${orderId}" data-status="${status}"
            ${isActive ? 'disabled' : ''}>${capitalize(status)}</button>`;
        }

    });
</script>
