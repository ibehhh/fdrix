{{-- Lokasi: resources/views/pages/faq.blade.php --}}

@extends('layouts.app')

@section('title', 'FAQ')

@section('content')
<div class="faq-container">
    <h1 class="faq-title">FAQ</h1>

    <div class="faq-list">
        @foreach($faqs as $faq)
        <div class="faq-item">
            <h2>{{ $loop->iteration }}. {{ $faq['question'] }}</h2>
            <p>{{ $faq['answer'] }}</p>
        </div>
        @endforeach
    </div>
</div>
@endsection