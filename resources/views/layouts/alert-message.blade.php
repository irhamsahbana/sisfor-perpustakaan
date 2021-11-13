@if (session('f_msg'))
  <div class="alert alert-{{ session('f_bg') }}">
    {{ session('f_msg') }}
  </div>
@endif

@if ($errors->any())
  <div class="alert alert-danger">
    <ul>
      @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
      @endforeach
    </ul>
  </div>
@endif
