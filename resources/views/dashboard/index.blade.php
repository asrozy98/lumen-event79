@extends('layout.index',(['title'=> 'Dashboard Events']))
@section('content')
    <div class="mt-3 p-2 row">
        <h2 class="col">Dashboard</h2>
    </div>
    <div class="p-2 bg-light">
        <div class="d-print-none">
            <div class="row align-items-end">
                <h4>Filter</h4>
                <div class="col-3">
                    <label for="filter">Searching:</label>
                    <input type="text" class="form-control" id="searching" onkeyup="onSearch()">
                </div>
                <div class="col-6">
                    <label for="dateRange">Date:</label>
                    <div class="input-group input-daterange">
                        <input type="text" class="form-control" id="dateStart" autocomplete="off" data-provide="datepicker"
                            placeholder="{{ $dateStart }}" data-date-autoclose="true" data-date-format="mm/dd/yyyy"
                            data-date-today-highlight="true" onchange="onChange()">
                        <div class="input-group-addon m-2">to</div>
                        <input type="text" class="form-control" id="dateEnd" autocomplete="off" data-provide="datepicker"
                            placeholder="{{ $dateEnd }}" data-date-autoclose="true" data-date-format="mm/dd/yyyy"
                            data-date-today-highlight="true" onchange="onChange()">
                    </div>
                </div>
                <div class="col-2">
                    <button class="btn btn-secondary" onclick="reset()">Reset</button>
                    <button class="btn btn-warning" onclick="window.print()">Print</button>
                </div>
            </div>
            <hr>
        </div>
        <table class="table table-striped" id="dataTable">
            <thead>
                <tr>
                    <th scope="col">No</th>
                    <th scope="col">Title</th>
                    <th scope="col">Location</th>
                    <th scope="col">Date</th>
                    <th scope="col">Participant</th>
                    <th scope="col">Note</th>
                </tr>
            </thead>
        </table>
    </div>
@endsection
@push('css')
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css"
        integrity="sha512-mSYUmp1HYZDFaVKK//63EcZq4iFWFjxSL+Z3T/aCt4IO9Cejm03q3NKKYN6pFQzY0SBOr8h+eCIAZHPXcpZaNw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-print-css/css/bootstrap-print.min.css"
        media="print">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css">
@endpush
@push('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.js"
        integrity="sha512-n/4gHW3atM3QqRcbCn6ewmpxcLAHGaDjpEBu4xZd47N0W2oQ+6q7oc3PXstrJYXcbNU1OHdQ1T7pAP+gi5Yu8g=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"
        integrity="sha512-T/tUfKSV1bihCnd+MxKD0Hm1uBBroVYBOYSk1knyvQ9VyZJpc/ALb4P0r6ubwVPSGB2GvjeoMAJJImBG12TiaQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js" type="text/javascript"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js" type="text/javascript"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.8.4/moment.min.js"></script>
    <script>
        let dataTable;

        function onChange() {
            dataTable.draw();
        }

        function onSearch() {
            value = $('#searching').val();
            dataTable.search(value).draw();
        }

        function reset() {
            $('#searching').val('');
            $('#dateStart').val('');
            $('#dateEnd').val('');
            dataTable.search('').draw();
        }

        $(document).ready(function() {
            dataTable = $('#dataTable').DataTable({
                processing: false,
                serverSide: true,
                dom: 'Brltip',
                lengthMenu: [
                    [5, 25, 50, 100],
                    [5, 25, 50, 100]
                ],
                ajax: function(data, callback) {
                    $.ajax({
                        url: "{{ url('dashboard') }}",
                        'data': {
                            ...data,
                            dateStart: $('#dateStart').val(),
                            dateEnd: $('#dateEnd').val(),
                        },
                        dataType: 'json',
                        success: function(res) {
                            callback(res);
                        }
                    })
                },
                columns: [{
                        data: 'id',
                        name: 'id'
                    },
                    {
                        data: 'title',
                        name: 'title'
                    },
                    {
                        data: 'location',
                        name: 'location'
                    },
                    {
                        data: null,
                        name: 'date',
                        render: function(data) {
                            return moment(data['date']).format('DD - MMM - YYYY');
                        }
                    },
                    {
                        data: 'participant',
                        name: 'participant'
                    },
                    {
                        data: 'note',
                        name: 'note'
                    }
                ]
            });
        });
        $('.input-daterange input').each(function() {
            $(this).datepicker();
        });
    </script>
@endpush
