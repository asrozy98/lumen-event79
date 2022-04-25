@extends('layout.index',(['title'=> 'Add Event']))
@section('content')
    <div class="mt-3 mb-4 p-2 row">
        <h2 class="col">Add Event</h2>
    </div>
    <div class="p-2 bg-light row">
        <div class="col-5">
            <div class="mb-3">
                <label for="title" class="form-label">Title:</label>
                <input type="text" class="form-control" id="title" placeholder="Event name">
            </div>
            <div class="mb-3">
                <label for="location" class="form-label">Location:</label>
                <input type="text" class="form-control" id="location" placeholder="location event">
            </div>
            <div class="mb-3">
                <label for="participant" class="form-label">Participant:</label>
                <input type="text" class="form-control" id="participant" placeholder="Dani, Hendra">
            </div>
            <label for="date">Date:</label>
            <div class="input-group input-daterange">
                <input type="text" class="form-control" id="date"
                    placeholder="{{ Carbon\Carbon::now()->format('m/d/Y') }}" autocomplete="off" data-provide="datepicker"
                    data-date-autoclose="true" data-date-format="mm/dd/yyyy" data-date-today-highlight="true">
            </div>
            <div class="mb-3">
                <label for="note" class="form-label">Note:</label>
                <textarea type="text" class="form-control" id="note" placeholder="Notes event"></textarea>
            </div>
            <div class="mb-3">
                <label for="image" class="form-label">Image:</label>
                <input class="form-control" type="file" id="image" onchange="preview(this);">
            </div>
            <div class="mb-3">
                <img src="" class="img-fluid" id='imagePreview' alt="" />
            </div>
            <div class="d-flex align-items-end flex-column">
                <button onclick="eventSave()" class="btn btn-primary my-1" data-bs-dismiss="modal">Simpan</button>
            </div>
        </div>
        <div class="col-7">
            <img src="{{ url('/assets/event.png') }}" class="card-img-top img-fluid" alt="">
        </div>
    </div>
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

        function preview(foto) {
            if (foto.files && foto.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    $('#imagePreview').attr('src', e.target.result);
                };
                reader.readAsDataURL(foto.files[0]);
            }
        };

        function eventSave() {
            var form = new FormData();

            form.append('title', $('#title').val());
            form.append('note', $('#note').val());
            form.append('participant', $('#participant').val());
            form.append('location', $('#location').val());
            form.append('date', $('#date').val());
            form.append('image', document.getElementById('image').files[0]);

            $.ajax({
                url: "{{ url('event') }}",
                processData: false,
                contentType: false,
                type: "post",
                data: form,
                success: function(res) {
                    Swal.fire({
                        icon: res.type,
                        title: res.message,
                        html: res.type == 'error' ? res.error : '',
                    });
                },
                error: function(res) {
                    Swal.fire({
                        icon: res.type,
                        title: res.message,
                        html: res.error
                    });
                }
            })
        };
    </script>
@endpush
