@extends('layout.index',(['title'=> 'Events Card']))
@section('content')
    <div class="mt-3 p-2 row">
        <h2 class="col">Events</h2>
    </div>
    <div class="bg-light row justify-content-evenly">
        @forelse ($event as $item)
            <div class="card col-3 m-4 rounded-3">
                <img src="{{ url('storage/' . $item->image) }}" class="card-img-top img-fluid"
                    alt="{{ url('storage/' . $item->image) }}">
                <div class="card-body">
                    <h6><i class="bi bi-geo-alt-fill me-2"></i>{{ $item->location }}</h6>
                    <h3 class="card-title">{{ $item->title }}</h3>
                    <p class="text-secondary">{{ Carbon\Carbon::parse($item->date)->format('d-M-Y') }}</p>
                </div>
                <div class="border-top border-bottom p-2 mb-2 text-center">
                    @php
                        $participants = explode(',', $item->participant);
                    @endphp
                    @foreach ($participants as $participant)
                        <i class="bi bi-person-fill mx-2"></i>{{ $participant }},
                    @endforeach
                </div>
                <div class="bg-light p-2 mb-2 rounded-3">
                    <p class="card-text"><b>Noted: </b>{{ $item->note }}</p>
                </div>
            </div>
        @empty
            <div class="col-12 text-center">
                <h3>No Data</h3>
            </div>
        @endforelse
    </div>
    {{ $event->links() }}
@endsection
@push('css')
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css"
        integrity="sha512-mSYUmp1HYZDFaVKK//63EcZq4iFWFjxSL+Z3T/aCt4IO9Cejm03q3NKKYN6pFQzY0SBOr8h+eCIAZHPXcpZaNw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
@endpush
@push('js')
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"
        integrity="sha512-T/tUfKSV1bihCnd+MxKD0Hm1uBBroVYBOYSk1knyvQ9VyZJpc/ALb4P0r6ubwVPSGB2GvjeoMAJJImBG12TiaQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        $('.input-daterange input').each(function() {
            $(this).datepicker();
        });
    </script>
@endpush
