@extends('layouts.user')

@section('body_attributes') class="bg-body"@endsection

@section('content')
<div class="error-page d-flex align-items-center justify-content-center"
    style="background-image: url(assets/images/error-image.jpg); width: 100%; height: 980px; background-repeat: no-repeat;">
    <div class="container">
      <div class="col-lg-6 mx-auto">
        <div class="page-content bg-light p-5 text-center">
          <h1 class="display-1">Error 404</h1>
          <p>Sorry, the page that you’re looking for doesn’t exist.</p>
          <a href="/" class="btn btn-outline-dark btn-medium text-capitalize mt-3">Go back to home</a>
        </div>
      </div>
    </div>
  </div>
@endsection
