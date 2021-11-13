
@if (session('f_msg')) 
    <input type="hidden" name="f_bg"  value="{{ session('f_bg') }}" disabled>
    <input type="hidden" name="f_title"  value="{{ session('f_title') }}" disabled>
    <input type="hidden" name="f_msg"  value="{{ session('f_msg') }}" disabled>

    <script>
        $(document).ready(function() { // catatan: $(document).ready(function(){ }) itu artinya document akan selesai loading/meload setelah document selesai loading (DOM Ready) 
            let bg = $("input[name=f_bg]").val(); // catatan: $("input[name=f_bg]").val() itu artinya akan mengambil value dari input name=f_bg
            let title = $("input[name=f_title]").val(); // catatan: $("input[name=f_title]").val() itu artinya akan mengambil value dari input name=f_title yang berisi title
            let msg = $("input[name=f_msg]").val();
    
            $(document).Toasts('create', { // catatan: $(document).Toasts('create', { }) itu artinya akan membuat toast dengan parameter create yang berisi title dan msg yang telah di input tadi
                class: "bg-"+bg, // catatan: class: "bg-"+bg itu artinya akan mengambil class dari bg yang telah di input tadi dan akan ditambahkan bg- pada classnya
                title: title,
                body: msg // catatan: body: msg itu artinya akan mengambil msg yang telah di input tadi dan akan ditampilkan pada body toast
            })
        });
    </script>
@endif

@if ($errors->any()) <!-- catatan: $errors->any() itu artinya akan mengecek apakah ada error atau tidak  dan akan menampilkan pesan error jika ada -->

    <div class="error_msgs">
        <ul>
            @foreach ($errors->all() as $error) {{-- <!-- catatan: @foreach ($errors->all() as $error) itu artinya akan mengecek semua error yang ada dan akan di tampilkan pada ul --> --}}
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>

    <script>
        $(document).ready(function() { // catatan: $(document).ready(function(){ }) itu artinya document akan selesai loading/meload setelah document selesai loading (DOM Ready) 
            let msg = $('.error_msgs').clone(); //  catatan: let msg = $('.error_msgs').clone(); itu artinya akan mengambil class error_msgs dan akan di clone ke msg 
            $('.error_msgs').hide(); // catatan: $('.error_msgs').hide(); itu artinya akan menghilangkan class error_msgs yang telah di clone
    
            $(document).Toasts('create', {
                class: 'bg-danger',
                title: 'Oops, There is something wrong!',
                body: msg
            })
        });
    </script>
@endif