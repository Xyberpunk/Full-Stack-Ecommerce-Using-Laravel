@extends('layouts.storefront')

@section('body_attributes') class="bg-body" data-bs-spy="scroll" data-bs-target="#navbar" data-bs-root-margin="0px 0px -40%"
  data-bs-smooth-scroll="true" tabindex="0"@endsection

@section('page_title', 'Contact Us')

@section('storefront_content')
<section class="contact-us-wrap pt-5">
    <div class="container">
      <div class="row flex-row-reverse">
        <div class="inquiry-item col-lg-6 mb-5">
          <h2 class="fs-3 mb-4">Got any questions?</h2>
          <p>Use the form below to get in touch with us.</p>
          <form id="contactForm" action="#" method="post" class="form-group contact-form mt-4">
            <div class="form-input col-lg-12 d-flex justify-content-between mb-3">
              <div class="w-100 me-3">
                <label class="mb-2 fs-6 text-dark">Your Name*</label>
                <input type="text" name="name" placeholder="Write Your Name Here"
                  class="form-control shadow-none px-3 py-2" required>
              </div>
              <div class="w-100">
                <label class="mb-2 fs-6 text-dark">Your E-mail*</label>
                <input type="email" name="email" placeholder="Write Your Email Here"
                  class="form-control shadow-none px-3 py-2" required>
              </div>

            </div>
            <div class="col-lg-12 mb-3">
              <label class="mb-2 fs-6 text-dark">Phone Number</label>
              <input type="number" name="phone" placeholder="Phone Number" class="form-control shadow-none px-3 py-2">
            </div>
            <div class="col-lg-12 mb-3">
              <label class="mb-2 fs-6 text-dark">Subject</label>

              <input type="text" name="subject" placeholder="Write Your Subject Here"
                class="form-control shadow-none px-3 py-2">
            </div>
            <div class="col-lg-12 mb-3">
              <label class="mb-2 fs-6 text-dark">Your Message*</label>

              <textarea name="message" placeholder="Write Your Message Here" class="form-control shadow-none px-3 py-2"
                style="height:150px;" required></textarea>
            </div>
            <div class="d-grid">
              <button type="submit" name="submit" class="btn btn-primary btn-lg">Submit</button>
            </div>
          </form>
        </div>
        <div class="contact-info col-lg-6 mb-5">
          <h2 class="fs-3 mb-4">Contact information</h2>
          <p>Tortor dignissim convallis aenean et tortor at risus viverra adipiscing.</p>
          <div class="page-content">
            <div class="col-md-6">
              <div class="content-box my-5">
                <h5 class="element-title fw-bold ">Head Office</h5>
                <div class="contact-address">
                  <p>730 Glenstone Ave 65802, Springfield, US</p>
                </div>
                <div class="contact-number ">
                  <a href="#">+123 987 321 ,</a>
                  <a href="#">+123 123 654</a>
                </div>
                <div class="email-address">
                  <p>
                    <a href="#">info&#64;yourmail.com</a>
                  </p>
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="content-box my-5">
                <h5 class="element-title fw-bold ">Branch Office</h5>
                <div class="contact-address">
                  <p>730 Glenstone Ave 65802, Springfield, US</p>
                </div>
                <div class="contact-number ">
                  <a href="#">+123 987 321 ,</a>
                  <a href="#">+123 123 654</a>
                </div>
                <div class="email-address">
                  <p>
                    <a href="#">contact&#64;yourcompany.com</a>
                  </p>
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="content-box my-5">
                <h5 class="element-title fw-bold ">Social info</h5>
                <div class="social-links">
                  <ul class="social-links d-flex flex-wrap list-unstyled mt-3">
                    <li class="social me-4">
                      <a href="#">
                        <svg width="20" height="20">
                          <use xlink:href="#facebook"></use>
                        </svg></a>
                    </li>
                    <li class="social me-4">
                      <a href="#">
                        <svg width="20" height="20">
                          <use xlink:href="#twitter"></use>
                        </svg></a>
                    </li>
                    <li class="social me-4">
                      <a href="#">
                        <svg width="20" height="20">
                          <use xlink:href="#linkedin"></use>
                        </svg></a>
                    </li>
                    <li class="social me-4">
                      <a href="#">
                        <svg width="20" height="20">
                          <use xlink:href="#instagram"></use>
                        </svg></a>
                    </li>
                    <li class="social me-4">
                      <a href="#">
                        <svg width="20" height="20">
                          <use xlink:href="#youtube"></use>
                        </svg></a>
                    </li>
                  </ul>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
@endsection
