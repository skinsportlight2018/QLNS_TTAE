/// Hàm để lấy dữ liệu từ file PHP
function getChartData() {
    return $.ajax({
        url: '../model/sodo.php',
        type: 'GET',
        dataType: 'json'
    });
}

// Vẽ biểu đồ sau khi nhận được dữ liệu
getChartData().done(function(data) {
    var chartCanvas = document.getElementById('myChart');
    if (chartCanvas) {
        var ctx = chartCanvas.getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'pie',
            data: {
                labels: data.labels,
                datasets: [{
                    label: 'Số lượng nhân viên',
                    data: data.values,
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(255, 159, 64, 0.2)'
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 159, 64, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                // Cấu hình thêm nếu cần
            }
        });
    } else {
        console.error("Không tìm thấy phần tử 'myChart'");
    }
}).fail(function(jqXHR, textStatus, errorThrown) {
    console.error("Lỗi khi lấy dữ liệu:", textStatus, errorThrown);
});
