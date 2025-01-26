
//delete
const confirmDeleteModal = document.getElementById('confirmDeleteModal');
    confirmDeleteModal.addEventListener('show.bs.modal', function (event) {
        const button = event.relatedTarget; // Button yang memicu modal
        const productId = button.getAttribute('data-id');
        const productName = button.getAttribute('data-nama');
        const confirmDeleteBtn = document.getElementById('confirmDeleteBtn');

        // Set nama produk di modal
        document.getElementById('productName').textContent = productName;

        // Set link untuk konfirmasi hapus
        confirmDeleteBtn.href = `delete_produk.php?id=${productId}`;
    });

