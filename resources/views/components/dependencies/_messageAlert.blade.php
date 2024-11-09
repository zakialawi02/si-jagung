@push("css")
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css" rel="stylesheet"
        integrity="sha512-3pIirOrwegjM6erE5gPSwkUzO+3cTjpnV9lexlNZqvupR64iZBnOOTiiLPb9M36zpMScbmUNIcHUqKD47M719g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
@endpush

@push("javascript")
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script>
        const optionsTostr = {
            "closeButton": true,
            "debug": false,
            "newestOnTop": true,
            "progressBar": true,
            "positionClass": "toast-top-right",
            "preventDuplicates": false,
            "onclick": null,
            "timeOut": 4000,
        }
        // toastr["success"]("Test tes", "Success", optionsTostr)
    </script>

    @if (session("success"))
        <script>
            toastr["success"]("{{ session("success") }}", "Success", optionsTostr)
        </script>
    @endif
    @if (session("error"))
        <script>
            toastr["error"]("{{ session("error") }}", "Failed", optionsTostr)
        </script>
    @endif
    @if (session("info"))
        <script>
            toastr["info"]("{{ session("info") }}", "Info", optionsTostr)
        </script>
    @endif
    @if (session("status"))
        <script>
            toastr["info"]("{{ session("status") }}", "Info", optionsTostr)
        </script>
    @endif

@endpush
