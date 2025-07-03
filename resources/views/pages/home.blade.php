@extends('layouts.app')

@section('title', 'Homepage')

@section('content')
<main class="homepage-layout">
  <section class="left-panel">
    <h1>
      <span>Cemilin</span>
      <span>by</span>
      <span>FDRIX</span>
    </h1>
    <p>Butuh teman ngemil yang nggak bikin bosan? Cemilan ini siap jadi andalanmu! Dibuat dari bahan premium dan diproses dengan cara yang terjaga, rasa dan kualitasnya tetap maksimal...</p>
    <a href="{{ route('store') }}" class="order-now-link" tabindex="0">Order Now</a>
  </section>
<section class="right-panel">
    @foreach ($snacks as $snack)
        <article aria-label="{{ $snack->name }} snack" class="snack-card" tabindex="0">
          {{-- Menggunakan ->name, ->image, ->alt --}}
          <img src="{{ $snack->image }}" alt="{{ $snack->alt }}" width="300" height="300" />
          <div aria-hidden="true" class="plus-icon">+</div>
          <div class="snack-label">{{ $snack->name }}</div>
        </article>
    @endforeach
</section>
</main>
@endsection