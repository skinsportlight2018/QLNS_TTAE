</div>
<footer class="main-footer" style="text-align: center;">
    <div class="hidden-xs">
        <span>Copyright &copy; Trung Tâm Ngoại Ngữ AE</span>
    </div>
</footer>

<!-- End of Footer -->

</div>
<!-- End of Content Wrapper -->

</div>
<!-- End of Page Wrapper -->

<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
</a>

<link href="../inc/css/footer.css" rel="stylesheet">

<!-- Bootstrap core JavaScript-->
<script src="../vendor/jquery/jquery.min.js"></script>
<script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Core plugin JavaScript-->
<script src="../vendor/jquery-easing/jquery.easing.min.js"></script>

<!-- Custom scripts for all pages-->
<script src="../js/sb-admin-2.min.js"></script>

<!-- Page level plugins -->
<script src="../vendor/chart.js/Chart.min.js"></script>

<!-- DataTables -->
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>


<script>
    $(document).ready(function() {
        $('#myTable').DataTable({
            "language": {
                "emptyTable": "Không có dữ liệu trong bảng",
                "info": "Hiển thị _START_ đến _END_ của _TOTAL_ mục",
                "infoEmpty": "Không có dữ liệu khả dụng",
                "infoFiltered": "(được lọc từ tổng số _MAX_ bản ghi)",
                "lengthMenu": "Hiển thị _MENU_ bản ghi mỗi trang",
                "loadingRecords": "Đang tải dữ liệu...",
                "processing": "Đang xử lý...",
                "search": "Tìm kiếm:",
                "zeroRecords": "Không tìm thấy kết quả phù hợp",
                "paginate": {
                    "first": "Đầu",
                    "last": "Cuối",
                    "next": "Tiếp",
                    "previous": "Trước"
                },
            }
        });
    });

    function searchByMonth() {
        var searchMonth = document.getElementById("searchMonth").value;
        // Phân chia giá trị của searchMonth thành tháng và năm
        var parts = searchMonth.split("-");
        var thang = parts[1];
        var nam = parts[0];

        // Chuyển hướng trang đến URL với thông tin tháng và năm
        window.location.href = "index.php?action=timkiem&thang=" + thang + "&nam=" + nam;
    }
</script>

</body>

</html>