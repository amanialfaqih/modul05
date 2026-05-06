@extends('layouts.app')

@section('content')

<div class="container">

    <h3 class="fw-bold mb-4">⚙️ Pengaturan Akun</h3>

    @if(session('success'))
        <div class="alert alert-success shadow-sm">
            {{ session('success') }}
        </div>
    @endif

    <div class="card border-0 shadow-lg rounded-4">
        <div class="card-body text-center p-4">

            {{-- FOTO PROFIL --}}
            <div class="mb-4 position-relative d-inline-block">

                <img id="preview"
                     src="{{ $user->photo ? asset('images/profile/'.$user->photo) : 'https://ui-avatars.com/api/?name='.$user->name }}"
                     class="rounded-circle shadow"
                     width="120" height="120"
                     style="object-fit:cover; border:4px solid #fff;">

                <label class="upload-btn">
                    📸
                    <input type="file" name="photo" form="formSettings" hidden onchange="previewImage(event)">
                </label>

            </div>

            <form id="formSettings" action="{{ route('settings.update') }}" method="POST" enctype="multipart/form-data">
                @csrf

                {{-- NAMA --}}
                <div class="mb-3 text-start">
                    <label class="fw-semibold">Nama</label>
                    <input type="text" name="name" class="form-control"
                           value="{{ $user->name }}">
                </div>

                {{-- EMAIL --}}
                <div class="mb-3 text-start">
                    <label class="fw-semibold">Email</label>
                    <input type="email" name="email" class="form-control"
                           value="{{ $user->email }}">
                </div>

                {{-- PASSWORD --}}
                <div class="mb-3 text-start">
                    <label class="fw-semibold">Password Baru</label>
                    <input type="password" name="password" class="form-control"
                           placeholder="Kosongkan jika tidak diganti">
                </div>

                <button class="btn btn-primary w-100 rounded-pill mt-3">
                    💾 Simpan Perubahan
                </button>

            </form>

        </div>
    </div>

</div>

{{-- 🔥 STYLE --}}
<style>

.upload-btn {
    position: absolute;
    bottom: 5px;
    right: 5px;
    background: #6366f1;
    color: white;
    border-radius: 50%;
    padding: 8px;
    cursor: pointer;
    font-size: 14px;
    box-shadow: 0 4px 10px rgba(0,0,0,0.2);
    transition: 0.3s;
}

.upload-btn:hover {
    transform: scale(1.2);
}

.form-control {
    border-radius: 12px;
}

.card {
    background: rgba(255,255,255,0.95);
}

</style>

{{-- 🔥 SCRIPT PREVIEW FOTO --}}
<script>
function previewImage(event){
    const reader = new FileReader();
    reader.onload = function(){
        document.getElementById('preview').src = reader.result;
    }
    reader.readAsDataURL(event.target.files[0]);
}
</script>

@endsection