<form class="ms-5" action="{{ route('upload.images') }}" method="post" enctype="multipart/form-data" >
    @csrf
    <div>
        <input type="file" name="images[]" class="form-control" id="images" multiple onchange="this.form.submit()"> 
    </div>
</form>