@extends('welcome')
@section('home')

    <!-- row -->
    <div class="container-fluid">
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="stat-widget-two card-body">
                        <div class="stat-content">
                            <div class="stat-text"> Số Lượng Giao Dịch</div>
                            <div class="stat-digit"></i>{{ $totalTransactions }}</div>
                        </div>
                        <div class="progress">
                            <div class="progress-bar progress-bar-success w-85" role="progressbar" aria-valuenow="85" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card">
                    <div class="stat-widget-two card-body">
                        <div class="stat-content">
                            <div class="stat-text">Tổng Nguồn Thu</div>
                            <div class="stat-digit"><i class="fa fa-usd"></i>{{ $totalIncome }}</div>
                        </div>
                        <div class="progress">
                            <div class="progress-bar progress-bar-primary w-75" role="progressbar" aria-valuenow="78" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card">
                    <div class="stat-widget-two card-body">
                        <div class="stat-content">
                            <div class="stat-text">Tổng Nguồn Chi</div>
                            <div class="stat-digit"><i class="fa fa-usd"></i>{{ $totalSpending }}</div>
                        </div>
                        <div class="progress">
                            <div class="progress-bar progress-bar-warning w-50" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>
                </div>
            </div>
            {{-- <div class="col-lg-3 col-sm-6">
                <div class="card">
                    <div class="stat-widget-two card-body">
                        <div class="stat-content">
                            <div class="stat-text">Task Completed</div>
                            <div class="stat-digit"> <i class="fa fa-usd"></i>650</div>
                        </div>
                        <div class="progress">
                            <div class="progress-bar progress-bar-danger w-65" role="progressbar" aria-valuenow="65" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>
                </div>
                <!-- /# card -->
            </div>
            <!-- /# column --> --}}
        </div>
        
        <div class="row">
            <div class="col-xl-8 col-lg-8 col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Biểu Đồ Thu- Chi Của Từng Tháng</h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-xl-12 col-lg-8">
                                <div id="morris-bar-chart"></div>
                            </div>
                        </div>
                        <div id="chart-legend"></div>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-lg-4 col-md-4">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Biểu Đồ Chi Của Tháng</h4>
                        <div id="pie-chart"></div>
                    </div>
                </div>
            </div>
            
        </div>
        
    </div>
    

    {{-- <script>
       
    
        // Assuming your transactions variable is an array of transactions with 'month' and 'total_amount' attributes
        var transactions = @json($transactions);

        console.log(transactions); // Check if transactions is populated

        // Prepare data for Morris.js
        var data = [];
        transactions.forEach(function(transaction) {
            data.push({ x: transaction.month, y: transaction.total_amount });
        });
        console.log(data); // Check if the data array is correct

        console.log('Before Morris Bar Chart Initialization');
        // Initialize Morris.js Bar Chart
        new Morris.Bar({
            element: 'morris-bar-chart',
            data: data,
            xkey: 'x',
            ykeys: ['y'],
            labels: ['Total Amount'],
            barColors: ['#1e88e5'], // Customize bar color
            hideHover: 'auto',
            resize: true
        });
        console.log('After Morris Bar Chart Initialization');
   
        
    </script> --}}
@endsection