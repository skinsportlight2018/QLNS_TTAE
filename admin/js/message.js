function showSuccessMessage(message) {
    Swal.fire({
        icon: 'success',
        title: 'Thành công!',
        text: message,
        showConfirmButton: false,
        timer: 1500
    });
}

function showErrorMessage(message) {
    Swal.fire({
        icon: 'error',
        title: 'Lỗi!',
        text: message,
        showConfirmButton: true,
    });
}

function showDeleteMessage(id) {
    Swal.fire({
        title: "Bạn có muốn xóa không?",
        text: "Bạn sẽ không thể trở lại!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Vâng, xóa đi!"
    }).then((result) => {
        if (result.isConfirmed) {
            // Truyền id cho hàm confirmDelete
            confirmDelete(id);
        }
    });
}

function confirmDelete(id) {
    var xhr = new XMLHttpRequest();
    xhr.open("GET", "index.php?action=confirm_delete&id=" + id, true);
    xhr.onreadystatechange = function() {
        if (xhr.readyState == 4 && xhr.status == 200) {
            var response = JSON.parse(xhr.responseText);
            if (response.success) {
                showSuccessMessage("Bạn đã xóa thành công.");
                window.location.reload(); // Tải lại trang sau khi xóa thành công
            } else {
                showErrorMessage("Failed to delete file."); // Show error message if deletion fails
            }
        }
    };
    xhr.send();
}
