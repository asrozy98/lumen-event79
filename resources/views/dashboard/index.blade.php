@extends('layout.index',(['title'=> 'Dashboard Events']))
@section('content')
    <div class="mt-3 p-2 row">
        <h2 class="col">Dashboard</h2>
    </div>
    <div class="p-2 bg-light">
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
        $(document).ready(function() {
            $('#dataTable').DataTable({
                processing: false,
                serverSide: true,
                ajax: function(data, callback) {
                    $.ajax({
                        url: "{{ url('dashboard') }}",
                        'data': {
                            ...data
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
                            // return data['date'];
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
