@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Pengaturan</h1>

    <div class="mb-3">
        <label class="form-label">Mode Gelap</label>
        <div class="form-check form-switch">
            <input class="form-check-input" type="checkbox" id="darkModeCheckbox">
            <label class="form-check-label" for="darkModeCheckbox" id="darkModeLabel">Aktifkan Mode Gelap</label>
        </div>
    </div>
</div>
@endsection
