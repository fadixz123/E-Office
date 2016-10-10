<?php
include 'konfig.php';

$admintitle = "Home";

include 'header.php';
?>
<div data-title="<?php echo $admintitle; ?>">
    <div class="row">
        <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box">
                <span class="info-box-icon bg-aqua"><i class="fa fa-envelope-o"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Surat Masuk</span>
                    <span class="info-box-number inbox">0</span>
                    <span class="info-box-number inbox-pending"><small>Pending:</small> 0</span>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box">
                <span class="info-box-icon bg-red"><i class="fa fa-send-o"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Surat Keluar</span>
                    <span class="info-box-number outbox">0</span>
                    <span class="info-box-number outbox-pending"><small>Pending:</small> 0</span>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box">
                <span class="info-box-icon bg-green"><i class="fa fa-legal"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Perijinan</span>
                    <span class="info-box-number ijin">0</span>
                    <span class="info-box-number ijin-pending"><small>Pending:</small> 0</span>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box">
                <span class="info-box-icon bg-yellow"><i class="fa fa-institution"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Penggunaan Gedung</span>
                    <span class="info-box-number gedung">0</span>
                    <span class="info-box-number gedung-pending"><small>Pending:</small> 0</span>
                </div>
            </div>
        </div>

        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Diagram Surat Masuk & Keluar</h3>
                    <div class="pull-right box-tools">
                        <button type="button" class="btn btn-info btn-sm" data-widget="collapse" data-toggle="tooltip"><i class="fa fa-minus"></i></button>
                    </div>
                </div>
                <div class="box-body">
                    <div class="chart">
                        <canvas width="510" height="230" id="barChart" style="height: 230px; width: 510px;"></canvas>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Jumlah Satuan Pendidikan</h3>
                    <div class="pull-right box-tools">
                        <button type="button" class="btn btn-info btn-sm" data-widget="collapse" data-toggle="tooltip"><i class="fa fa-minus"></i></button>
                    </div>
                </div>
                <div class="box-body">
                    <canvas width="510" height="255" id="pieChart" style="height: 255px; width: 510px;"></canvas>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Diagram Akreditasi</h3>
                    <div class="pull-right box-tools">
                        <button type="button" class="btn btn-info btn-sm" data-widget="collapse" data-toggle="tooltip"><i class="fa fa-minus"></i></button>
                    </div>
                </div>
                <div class="box-body">
                    <div class="chart">
                        <canvas width="510" height="230" id="akreditasi" style="height: 230px; width: 510px;"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(function () {
        $.ajax({
            url: "data/index/data.php?diagram-surat",
            method: "GET",
            dataType: 'json',
            success: function (tgl) {
                var areaChartData = {
                    labels: ["Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"],
                    datasets: [
                        {
                            label: "Surat Masuk",
                            fillColor: "rgba(60,141,188,0.9)",
                            strokeColor: "rgba(60,141,188,0.8)",
                            pointColor: "#3b8bba",
                            pointStrokeColor: "rgba(60,141,188,1)",
                            pointHighlightFill: "#fff",
                            pointHighlightStroke: "rgba(60,141,188,1)",
                            data: [tgl[0][0], tgl[0][1], tgl[0][2], tgl[0][3], tgl[0][4], tgl[0][5], tgl[0][6], tgl[0][7], tgl[0][8], tgl[0][9], tgl[0][10], tgl[0][11]]
                        },
                        {
                            label: "Surat Keluar",
                            fillColor: "rgba(60,141,188,0.9)",
                            strokeColor: "rgba(60,141,188,0.8)",
                            pointColor: "#3b8bba",
                            pointStrokeColor: "rgba(60,141,188,1)",
                            pointHighlightFill: "#fff",
                            pointHighlightStroke: "rgba(60,141,188,1)",
                            data: [tgl[0][12], tgl[0][13], tgl[0][14], tgl[0][15], tgl[0][16], tgl[0][17], tgl[0][18], tgl[0][19], tgl[0][20], tgl[0][21], tgl[0][22], tgl[0][23]]
                        }
                    ]
                };
                var barChartCanvas = $("#barChart").get(0).getContext("2d");
                var barChart = new Chart(barChartCanvas);
                var barChartData = areaChartData;
                barChartData.datasets[1].fillColor = "#00a65a";
                barChartData.datasets[1].strokeColor = "#00a65a";
                barChartData.datasets[1].pointColor = "#00a65a";
                var barChartOptions = {
                    //Boolean - Whether the scale should start at zero, or an order of magnitude down from the lowest value
                    scaleBeginAtZero: true,
                    //Boolean - Whether grid lines are shown across the chart
                    scaleShowGridLines: true,
                    //String - Colour of the grid lines
                    scaleGridLineColor: "rgba(0,0,0,.05)",
                    //Number - Width of the grid lines
                    scaleGridLineWidth: 1,
                    //Boolean - Whether to show horizontal lines (except X axis)
                    scaleShowHorizontalLines: true,
                    //Boolean - Whether to show vertical lines (except Y axis)
                    scaleShowVerticalLines: true,
                    //Boolean - If there is a stroke on each bar
                    barShowStroke: true,
                    //Number - Pixel width of the bar stroke
                    barStrokeWidth: 2,
                    //Number - Spacing between each of the X value sets
                    barValueSpacing: 5,
                    //Number - Spacing between data sets within X values
                    barDatasetSpacing: 1,
                    //String - A legend template
                    legendTemplate: "<ul class=\"<%=name.toLowerCase()%>-legend\"><% for (var i=0; i<datasets.length; i++){%><li><span style=\"background-color:<%=datasets[i].fillColor%>\"></span><%if(datasets[i].label){%><%=datasets[i].label%><%}%></li><%}%></ul>",
                    //Boolean - whether to make the chart responsive
                    responsive: true,
                    maintainAspectRatio: true,
                    multiTooltipTemplate: "<%= datasetLabel %> - <%= value %>"
                };

                barChartOptions.datasetFill = false;
                barChart.Bar(barChartData, barChartOptions);
            }
        });
        $.ajax({
            url: "data/index/data.php?akreditasi",
            method: "GET",
            dataType: 'json',
            success: function (tgl) {
                var areaChartData = {
                    labels: ["Akreditasi A", "Akreditasi B", "Akreditasi C", "Belum Terakreditasi", "Tidak Terakreditasi"],
                    datasets: [
                        {
                            label: "Jenjang SD",
                            fillColor: "#f56954",
                            strokeColor: "#f56954",
                            pointColor: "#3b8bba",
                            pointStrokeColor: "rgba(60,141,188,1)",
                            pointHighlightFill: "#fff",
                            pointHighlightStroke: "rgba(60,141,188,1)",
                            data: [tgl[0][0], tgl[0][1], tgl[0][2], tgl[0][3], tgl[0][4]]
                        },
                        {
                            label: "Jenjang SDLB",
                            fillColor: "#00a65a",
                            strokeColor: "#00a65a",
                            pointColor: "#3b8bba",
                            pointStrokeColor: "rgba(60,141,188,1)",
                            pointHighlightFill: "#fff",
                            pointHighlightStroke: "rgba(60,141,188,1)",
                            data: [tgl[0][5], tgl[0][6], tgl[0][7], tgl[0][8], tgl[0][9]]
                        },
                        {
                            label: "Jenjang SLB",
                            fillColor: "#f39c12",
                            strokeColor: "#f39c12",
                            pointColor: "#3b8bba",
                            pointStrokeColor: "rgba(60,141,188,1)",
                            pointHighlightFill: "#fff",
                            pointHighlightStroke: "rgba(60,141,188,1)",
                            data: [tgl[0][10], tgl[0][11], tgl[0][12], tgl[0][13], tgl[0][14]]
                        },
                        {
                            label: "Jenjang SMP",
                            fillColor: "#00c0ef",
                            strokeColor: "#00c0ef",
                            pointColor: "#3b8bba",
                            pointStrokeColor: "rgba(60,141,188,1)",
                            pointHighlightFill: "#fff",
                            pointHighlightStroke: "rgba(60,141,188,1)",
                            data: [tgl[0][15], tgl[0][16], tgl[0][17], tgl[0][18], tgl[0][19]]
                        },
                        {
                            label: "Jenjang SMA",
                            fillColor: "#00ddef",
                            strokeColor: "#00ddef",
                            pointColor: "#3b8bba",
                            pointStrokeColor: "rgba(60,141,188,1)",
                            pointHighlightFill: "#fff",
                            pointHighlightStroke: "rgba(60,141,188,1)",
                            data: [tgl[0][20], tgl[0][21], tgl[0][22], tgl[0][23], tgl[0][24]]
                        },
                        {
                            label: "Jenjang SMK",
                            fillColor: "#3c8dbc",
                            strokeColor: "#3c8dbc",
                            pointColor: "#3b8bba",
                            pointStrokeColor: "rgba(60,141,188,1)",
                            pointHighlightFill: "#fff",
                            pointHighlightStroke: "rgba(60,141,188,1)",
                            data: [tgl[0][25], tgl[0][26], tgl[0][27], tgl[0][28], tgl[0][29]]
                        }
                    ]
                };
                var barChartCanvas = $("#akreditasi").get(0).getContext("2d");
                var barChart = new Chart(barChartCanvas);
                var barChartData = areaChartData;
                barChartData.datasets[1].fillColor = "#00a65a";
                barChartData.datasets[1].strokeColor = "#00a65a";
                barChartData.datasets[1].pointColor = "#00a65a";
                var barChartOptions = {
                    //Boolean - Whether the scale should start at zero, or an order of magnitude down from the lowest value
                    scaleBeginAtZero: true,
                    //Boolean - Whether grid lines are shown across the chart
                    scaleShowGridLines: true,
                    //String - Colour of the grid lines
                    scaleGridLineColor: "rgba(0,0,0,.05)",
                    //Number - Width of the grid lines
                    scaleGridLineWidth: 1,
                    //Boolean - Whether to show horizontal lines (except X axis)
                    scaleShowHorizontalLines: true,
                    //Boolean - Whether to show vertical lines (except Y axis)
                    scaleShowVerticalLines: true,
                    //Boolean - If there is a stroke on each bar
                    barShowStroke: true,
                    //Number - Pixel width of the bar stroke
                    barStrokeWidth: 2,
                    //Number - Spacing between each of the X value sets
                    barValueSpacing: 5,
                    //Number - Spacing between data sets within X values
                    barDatasetSpacing: 1,
                    //String - A legend template
                    legendTemplate: "<ul class=\"<%=name.toLowerCase()%>-legend\"><% for (var i=0; i<datasets.length; i++){%><li><span style=\"background-color:<%=datasets[i].fillColor%>\"></span><%if(datasets[i].label){%><%=datasets[i].label%><%}%></li><%}%></ul>",
                    //Boolean - whether to make the chart responsive
                    responsive: true,
                    maintainAspectRatio: true,
                    multiTooltipTemplate: "<%= datasetLabel %> - <%= value %>"
                };

                barChartOptions.datasetFill = false;
                barChart.Bar(barChartData, barChartOptions);
            }
        });
        $.ajax({
            url: "data/index/data.php?info-box",
            method: "GET",
            dataType: 'json',
            success: function (info) {
                $(".inbox").html("<small>Total: " + info[0][0] + "</small>");
                $(".inbox-pending").html("<small>Pending: " + info[0][1] + "</small>");
                $(".outbox").html("<small>Total: " + info[0][2] + "</small>");
                $(".outbox-pending").html("<small>Pending " + info[0][3] + "</small>");
                $(".ijin").html("<small>Total: " + info[0][4] + "</small>");
                $(".ijin-pending").html("<small>Pending " + info[0][5] + "</small>");
                $(".gedung").html("<small>Total: " + info[0][6] + "</small>");
                $(".gedung-pending").html("<small>Pending " + info[0][7] + "</small>");
            }
        });
        $.ajax({
            url: "data/index/data.php?jumlah-sekolah",
            method: "GET",
            dataType: 'json',
            success: function (jml) {
                var pieChartCanvas = $("#pieChart").get(0).getContext("2d");
                var pieChart = new Chart(pieChartCanvas);
                var PieData = [
                    {
                        value: jml[0][0],
                        color: "#f56954",
                        highlight: "#f56954",
                        label: "SD"
                    },
                    {
                        value: jml[0][1],
                        color: "#00a65a",
                        highlight: "#00a65a",
                        label: "SDLB"
                    },
                    {
                        value: jml[0][2],
                        color: "#f39c12",
                        highlight: "#f39c12",
                        label: "SLB"
                    },
                    {
                        value: jml[0][3],
                        color: "#00c0ef",
                        highlight: "#00c0ef",
                        label: "SMP"
                    },
                    {
                        value: jml[0][4],
                        color: "#00ddef",
                        highlight: "#00ddef",
                        label: "SMA"
                    },
                    {
                        value: jml[0][5],
                        color: "#3c8dbc",
                        highlight: "#3c8dbc",
                        label: "SMK"
                    }
                ];
                var pieOptions = {
                    //Boolean - Whether we should show a stroke on each segment
                    segmentShowStroke: true,
                    //String - The colour of each segment stroke
                    segmentStrokeColor: "#fff",
                    //Number - The width of each segment stroke
                    segmentStrokeWidth: 2,
                    //Number - The percentage of the chart that we cut out of the middle
                    percentageInnerCutout: 50, // This is 0 for Pie charts
                    //Number - Amount of animation steps
                    animationSteps: 100,
                    //String - Animation easing effect
                    animationEasing: "easeOutBounce",
                    //Boolean - Whether we animate the rotation of the Doughnut
                    animateRotate: true,
                    //Boolean - Whether we animate scaling the Doughnut from the centre
                    animateScale: false,
                    //Boolean - whether to make the chart responsive to window resizing
                    responsive: true,
                    // Boolean - whether to maintain the starting aspect ratio or not when responsive, if set to false, will take up entire container
                    maintainAspectRatio: true,
                    //String - A legend template
                    legendTemplate: "<ul class=\"<%=name.toLowerCase()%>-legend\"><% for (var i=0; i<segments.length; i++){%><li><span style=\"background-color:<%=segments[i].fillColor%>\"></span><%if(segments[i].label){%><%=segments[i].label%><%}%></li><%}%></ul>"
                };
                //Create pie or douhnut chart
                // You can switch between pie and douhnut using the method below.
                pieChart.Doughnut(PieData, pieOptions);
            }
        });

    });
</script>
<?php include 'footer.php'; ?>