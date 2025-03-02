// public/js/confirmSubmit.js

document.addEventListener('DOMContentLoaded', function() {
    // Tìm tất cả các form có class 'confirm-submit'
    document.querySelectorAll('.confirm-submit').forEach(form => {
        form.addEventListener('submit', function(e) {
            e.preventDefault(); // Ngăn submit form ngay lập tức

            Swal.fire({
                title: 'Bạn có chắc chắn?',
                text: "Bạn muốn cập nhật thông tin này?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Có, cập nhật!',
                cancelButtonText: 'Không, hủy'
            }).then((result) => {
                if (result.isConfirmed) {
                    this.submit(); // Submit form nếu xác nhận
                }
            });
        });
    });
});