@if(Session::has('message'))
<script>
    @if(Session::get('type') == "success")
    Swal.fire({
      type: "{{ Session::get('type') }}",
      title: "Success!",
      text: "{{ Session::get('message') }}",
      confirmButtonClass: 'btn btn-confirm mt-2'
    });
    @endif
    @if(Session::get('type') == "error")  
    Swal.fire({
      type: "{{ Session::get('type') }}",
      title: "Error!",
      text: "{{ Session::get('message') }}",
      confirmButtonClass: 'btn btn-confirm mt-2'
    });
    @endif
</script>
@endif