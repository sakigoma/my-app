@extends('app')

@section('title', '記事一覧')

@section('content')
  @include('nav')
  <div>
      @foreach($articles as $article)
        <div>
          {{ $article->user->name }}
        </div>
        <div>
          {{ $article->created_at->format('Y/m/d H:i') }}
        </div>
        <div>
          <h3>
            {{ $article->title }}
          </h3>
          <div>
            {!! nl2br(e( $article->body )) !!}
          </div>
        </div>
      @endforeach
  </div>
@endsection
