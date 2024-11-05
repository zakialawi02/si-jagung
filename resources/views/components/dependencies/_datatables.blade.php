@push("css")
    <link href="https://cdnjs.cloudflare.com/ajax/libs/MaterialDesign-Webfont/7.4.47/css/materialdesignicons.css" rel="stylesheet"
        integrity="sha512-/bZeHtNhCNHsuODhywlz53PIfvrJbAmm7MUXWle/f8ro40mVNkPLz0I5VdiYyV030zepbBdMIty0Z3PRwjnfmg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href={{ asset("assets/vendors/datatables.net-bs5/dataTables.bootstrap5.css") }} rel="stylesheet">
@endpush

@push("javascript")
    <script src={{ asset("assets/vendors/datatables.net/jquery.dataTables.js") }}></script>
    <script src={{ asset("assets/vendors/datatables.net-bs5/dataTables.bootstrap5.js") }}></script>
@endpush
