<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pemesanan Ambulans</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/create-style.css') }}">
</head>
<body>
    <!-- Header -->
    <div class="header">
        <h1>Pemesanan Ambulan</h1>
        <img src="{{ asset('images/logo1.png') }}" alt="Logo" class="header-logo">
    </div>
    <!-- Main Content -->
    <div class="main-container">
        <!-- Map and Form -->
        <div class="map-container">
            <img src="{{ asset('images/peta.png') }}" alt="Peta" class="peta">
            <div class="form-overlay">
                <form id="searchForm" action="{{ route('booking.search') }}" method="POST" class="d-flex align-items-center search-container">
                    @csrf
                    <input type="text" name="fake_address" id="address" class="form-control search-bar" placeholder="Masukkan alamat anda" required autocomplete="off" onfocus="this.removeAttribute('readonly');" readonly>
                    <input type="hidden" name="address" id="hiddenAddress">
                    <button type="submit" class="btn btn-search">
                        <i class="bi bi-search"></i>
                    </button>
                </form>
                <ul class="dropdown-menu mt-2" id="address-dropdown">
                    @if($addresses->isEmpty())
                        <li class="dropdown-item text-muted">Riwayat pemesanan tidak ada</li>
                    @else
                        @foreach ($addresses as $address)
                            <li class="dropdown-item d-flex justify-content-between align-items-center" onclick="selectAddress('{{ $address->address }}')">
                                <span>{{ $address->address }}</span>
                                <form action="{{ route('address.destroy', $address) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">x</button>
                                </form>
                            </li>
                        @endforeach
                    @endif
                </ul>
            </div>
            <button type="button"id="pesanButton"class="btn btn-success button-container" onclick="document.getElementById('searchForm').submit();">Pesan</button>
        </div>

    <!-- Script -->
    <script>
        const searchForm = document.getElementById('searchForm');
        const addressInput = document.getElementById('address');
        const hiddenAddressInput = document.getElementById('hiddenAddress');
        const dropdown = document.getElementById('address-dropdown');
        const pesanButton = document.getElementById('pesanButton');

        function handleFormSubmit(event) {
        event.preventDefault(); // Hentikan tindakan default tombol

        // Cek apakah input kosong
        if (!addressInput.value.trim()) {
            alert('Masukkan Alamat Terlebih Dahulu!'); // Tampilkan popup
        } else {
            searchForm.submit(); // Kirim formulir jika valid
        }
    }
    pesanButton.addEventListener('click', function (event) {
    event.preventDefault(); // Hentikan pengiriman default tombol
    
    // Periksa apakah input kosong
    if (!addressInput.value.trim()) {
        alert('Masukkan Alamat Terlebih Dahulu!'); // Tampilkan popup
    } else {
        searchForm.submit(); // Kirim form jika input valid
    }
});

    
    
        searchForm.addEventListener('submit', function (event) {
    // Cek apakah input alamat kosong
    if (!addressInput.value.trim()) {
        event.preventDefault(); // Hentikan pengiriman form
        alert('Masukkan Alamat Terlebih Dahulu!'); // Tampilkan popup
    }
    }); 
        // Tampilkan dropdown saat input difokuskan
        addressInput.addEventListener('focus', function () {
            if (dropdown.children.length > 0) {
                dropdown.style.display = 'block';
            }
        });

        // Sembunyikan dropdown saat klik di luar
        document.addEventListener('click', function (event) {
            if (!addressInput.contains(event.target) && !dropdown.contains(event.target)) {
                dropdown.style.display = 'none';
            }
        });

        // Sinkronisasi input dengan hidden field
        addressInput.addEventListener('input', function () {
            hiddenAddressInput.value = addressInput.value;

            const input = addressInput.value.toLowerCase();
            const items = dropdown.querySelectorAll('.dropdown-item');

            let hasVisibleItems = false;

            items.forEach(item => {
                const text = item.querySelector('span') ? item.querySelector('span').innerText.toLowerCase() : '';
                if (text.includes(input)) {
                    item.style.display = 'flex';
                    hasVisibleItems = true;
                } else {
                    item.style.display = 'none';
                }
            });

            // Tampilkan pesan jika tidak ada item yang cocok
            if (!hasVisibleItems && dropdown.querySelector('.text-muted') === null) {
                const noHistoryItem = document.createElement('li');
                noHistoryItem.className = 'dropdown-item text-muted';
                noHistoryItem.textContent = 'Riwayat pemesanan tidak ada';
                dropdown.appendChild(noHistoryItem);
            } else if (hasVisibleItems && dropdown.querySelector('.text-muted') !== null) {
                dropdown.querySelector('.text-muted').remove();
            }
        });

        // Pilih alamat dari dropdown
        function selectAddress(address) {
            addressInput.value = address;
            hiddenAddressInput.value = address;
            dropdown.style.display = 'none';
        }
    </script>
</body>
</html>
