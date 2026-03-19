@extends('layouts.storefront')

@section('body_attributes') class="bg-body" data-bs-spy="scroll" data-bs-target="#navbar" data-bs-root-margin="0px 0px -40%"
  data-bs-smooth-scroll="true" tabindex="0"@endsection

@section('page_title', 'FAQs')

@section('storefront_content')
<section class="faqs-wrap py-5">
    <div class="container-fluid">
      <div class="row">
        <main class="col-lg-8 col-md-12 mb-5">
          <h2 class="fs-3 text-uppercase mb-3">Frequently Asked Questions</h2>

          <p>Malesuada nunc vel risus commodo viverra. Viverra accumsan in nisl nisi. Pretium nibh ipsum consequat nisl
            vel pretium. Tortor dignissim convallis aenean et tortor at risus viverra adipiscing.</p>
          <div class="page-content">

            <div class="accordion" id="accordion-box">
              <div class="accordion-item mb-3">
                <div class="accordion-header" id="heading-one">
                  <button class="accordion-button bg-transparent border-bottom" type="button" data-bs-toggle="collapse"
                    data-bs-target="#collapse-one" aria-expanded="true" aria-controls="collapse-one">
                    <h3 class="accordion-title text-uppercase fs-5 text-dark">How to order products?</h3>
                  </button>
                </div>
                <div id="collapse-one" class="accordion-collapse collapse show" aria-labelledby="heading-one">
                  <div class="accordion-body">
                    <div class="faqs-box">
                      <div class="element-box margin-xsmall d-flex align-items-center">
                        <div class="item-title">Quisque volutpat mattis eros. Nullam malesuada erat ut turpis.
                          Suspendisse urna viverra non, semper suscipit, posuere a, pede. Donec nec justo eget felis
                          facilisis fermentum. Aliquam porttitor mauris sit amet orci. Aenean dignissim pellentesque
                          felis. Phasellus ultrices nulla quis nibh. Quisque a lectus. Donec consectetuer ligula
                          vulputate sem tristique cursus. </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="accordion-item mb-3">
                <div class="accordion-header" id="heading-two">
                  <button class="accordion-button bg-transparent border-bottom collapsed" type="button"
                    data-bs-toggle="collapse" data-bs-target="#collapse-two" aria-expanded="true"
                    aria-controls="collapse-two">
                    <h3 class="accordion-title text-uppercase fs-5 text-dark">Should buy online compulsory?</h3>
                  </button>
                </div>
                <div id="collapse-two" class="accordion-collapse collapse" aria-labelledby="heading-two">
                  <div class="accordion-body">
                    <div class="faqs-box">
                      <div class="element-box margin-xsmall d-flex align-items-center">
                        <div class="item-title">Quisque volutpat mattis eros. Nullam malesuada erat ut turpis.
                          Suspendisse urna viverra non, semper suscipit, posuere a, pede. Donec nec justo eget felis
                          facilisis fermentum. Aliquam porttitor mauris sit amet orci. Aenean dignissim pellentesque
                          felis. Phasellus ultrices nulla quis nibh. Quisque a lectus. Donec consectetuer ligula
                          vulputate sem tristique cursus. </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="accordion-item mb-3">
                <div class="accordion-header" id="heading-three">
                  <button class="accordion-button bg-transparent border-bottom collapsed" type="button"
                    data-bs-toggle="collapse" data-bs-target="#collapse-three" aria-expanded="true"
                    aria-controls="collapse-three">
                    <h3 class="accordion-title text-uppercase fs-5 text-dark">Can i get discounts in products?</h3>
                  </button>
                </div>
                <div id="collapse-three" class="accordion-collapse collapse" aria-labelledby="heading-three">
                  <div class="accordion-body">
                    <div class="faqs-box">
                      <div class="element-box margin-xsmall d-flex align-items-center">
                        <div class="item-title">Quisque volutpat mattis eros. Nullam malesuada erat ut turpis.
                          Suspendisse urna viverra non, semper suscipit, posuere a, pede. Donec nec justo eget felis
                          facilisis fermentum. Aliquam porttitor mauris sit amet orci. Aenean dignissim pellentesque
                          felis. Phasellus ultrices nulla quis nibh. Quisque a lectus. Donec consectetuer ligula
                          vulputate sem tristique cursus. </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="accordion-item mb-3">
                <div class="accordion-header" id="heading-four">
                  <button class="accordion-button bg-transparent border-bottom collapsed" type="button"
                    data-bs-toggle="collapse" data-bs-target="#collapse-four" aria-expanded="true"
                    aria-controls="collapse-four">
                    <h3 class="accordion-title text-uppercase fs-5 text-dark">What informations should i need to provide
                      when ordering?</h3>
                  </button>
                </div>
                <div id="collapse-four" class="accordion-collapse collapse" aria-labelledby="heading-four">
                  <div class="accordion-body">
                    <div class="faqs-box">
                      <div class="element-box margin-xsmall d-flex align-items-center">
                        <div class="item-title">Quisque volutpat mattis eros. Nullam malesuada erat ut turpis.
                          Suspendisse urna viverra non, semper suscipit, posuere a, pede. Donec nec justo eget felis
                          facilisis fermentum. Aliquam porttitor mauris sit amet orci. Aenean dignissim pellentesque
                          felis. Phasellus ultrices nulla quis nibh. Quisque a lectus. Donec consectetuer ligula
                          vulputate sem tristique cursus. </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="accordion-item mb-3">
                <div class="accordion-header" id="heading-five">
                  <button class="accordion-button bg-transparent border-bottom collapsed" type="button"
                    data-bs-toggle="collapse" data-bs-target="#collapse-five" aria-expanded="true"
                    aria-controls="collapse-five">
                    <h3 class="accordion-title text-uppercase fs-5 text-dark">Can i cancel my order?</h3>
                  </button>
                </div>
                <div id="collapse-five" class="accordion-collapse collapse" aria-labelledby="heading-five">
                  <div class="accordion-body">
                    <div class="faqs-box">
                      <div class="element-box margin-xsmall d-flex align-items-center">
                        <div class="item-title">Quisque volutpat mattis eros. Nullam malesuada erat ut turpis.
                          Suspendisse urna viverra non, semper suscipit, posuere a, pede. Donec nec justo eget felis
                          facilisis fermentum. Aliquam porttitor mauris sit amet orci. Aenean dignissim pellentesque
                          felis. Phasellus ultrices nulla quis nibh. Quisque a lectus. Donec consectetuer ligula
                          vulputate sem tristique cursus. </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="accordion-item mb-3">
                <div class="accordion-header" id="heading-six">
                  <button class="accordion-button bg-transparent border-bottom collapsed" type="button"
                    data-bs-toggle="collapse" data-bs-target="#collapse-six" aria-expanded="true"
                    aria-controls="collapse-six">
                    <h3 class="accordion-title text-uppercase fs-5 text-dark">What’s your return policy</h3>
                  </button>
                </div>
                <div id="collapse-six" class="accordion-collapse collapse" aria-labelledby="heading-six">
                  <div class="accordion-body">
                    <div class="faqs-box">
                      <div class="element-box margin-xsmall d-flex align-items-center">
                        <div class="item-title">Quisque volutpat mattis eros. Nullam malesuada erat ut turpis.
                          Suspendisse urna viverra non, semper suscipit, posuere a, pede. Donec nec justo eget felis
                          facilisis fermentum. Aliquam porttitor mauris sit amet orci. Aenean dignissim pellentesque
                          felis. Phasellus ultrices nulla quis nibh. Quisque a lectus. Donec consectetuer ligula
                          vulputate sem tristique cursus. </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="accordion-item mb-3">
                <div class="accordion-header" id="heading-seven">
                  <button class="accordion-button bg-transparent border-bottom collapsed" type="button"
                    data-bs-toggle="collapse" data-bs-target="#collapse-seven" aria-expanded="true"
                    aria-controls="collapse-seven">
                    <h3 class="accordion-title text-uppercase fs-5 text-dark">I haven’t received my order</h3>
                  </button>
                </div>
                <div id="collapse-seven" class="accordion-collapse collapse" aria-labelledby="heading-seven">
                  <div class="accordion-body">
                    <div class="faqs-box">
                      <div class="element-box margin-xsmall d-flex align-items-center">
                        <div class="item-title">Quisque volutpat mattis eros. Nullam malesuada erat ut turpis.
                          Suspendisse urna viverra non, semper suscipit, posuere a, pede. Donec nec justo eget felis
                          facilisis fermentum. Aliquam porttitor mauris sit amet orci. Aenean dignissim pellentesque
                          felis. Phasellus ultrices nulla quis nibh. Quisque a lectus. Donec consectetuer ligula
                          vulputate sem tristique cursus. </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="accordion-item mb-3">
                <div class="accordion-header" id="heading-eight">
                  <button class="accordion-button bg-transparent border-bottom collapsed" type="button"
                    data-bs-toggle="collapse" data-bs-target="#collapse-eight" aria-expanded="true"
                    aria-controls="collapse-eight">
                    <h3 class="accordion-title text-uppercase fs-5 text-dark">How is shipping charge determined?</h3>
                  </button>
                </div>
                <div id="collapse-eight" class="accordion-collapse collapse" aria-labelledby="heading-eight">
                  <div class="accordion-body">
                    <div class="faqs-box">
                      <div class="element-box margin-xsmall d-flex align-items-center">
                        <div class="item-title">Quisque volutpat mattis eros. Nullam malesuada erat ut turpis.
                          Suspendisse urna viverra non, semper suscipit, posuere a, pede. Donec nec justo eget felis
                          facilisis fermentum. Aliquam porttitor mauris sit amet orci. Aenean dignissim pellentesque
                          felis. Phasellus ultrices nulla quis nibh. Quisque a lectus. Donec consectetuer ligula
                          vulputate sem tristique cursus. </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="accordion-item">
                <div class="accordion-header" id="heading-nine">
                  <button class="accordion-button bg-transparent border-bottom collapsed" type="button"
                    data-bs-toggle="collapse" data-bs-target="#collapse-nine" aria-expanded="true"
                    aria-controls="collapse-nine">
                    <h3 class="accordion-title text-uppercase fs-5 text-dark">Where is your shop located?</h3>
                  </button>
                </div>
                <div id="collapse-nine" class="accordion-collapse collapse" aria-labelledby="heading-nine">
                  <div class="accordion-body">
                    <div class="faqs-box">
                      <div class="element-box margin-xsmall d-flex align-items-center">
                        <div class="item-title">Quisque volutpat mattis eros. Nullam malesuada erat ut turpis.
                          Suspendisse urna viverra non, semper suscipit, posuere a, pede. Donec nec justo eget felis
                          facilisis fermentum. Aliquam porttitor mauris sit amet orci. Aenean dignissim pellentesque
                          felis. Phasellus ultrices nulla quis nibh. Quisque a lectus. Donec consectetuer ligula
                          vulputate sem tristique cursus. </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </main>

        <div class="col-lg-4 col-md-12">
          <div class="inquiry-item">
            <h3 class="section-title">Ask us anything</h3>
            <p>Call Us +123 987 456 or just drop us your message at <a
                href="mailto:contact&#64;yourcompany.com">contact&#64;yourcompany.com</a>. You can directly message us. </p>
            <form id="form" class="form-group flex-wrap">
              <div class="form-input col-lg-12 d-flex mb-3">
                <input type="text" name="email" placeholder="Write Your Name Here" class="form-control">
              </div>
              <div class="form-input col-lg-12 d-flex mb-3">
                <input type="text" name="email" placeholder="Write Your Email Here" class="form-control">
              </div>
              <div class="col-lg-12 mb-3">
                <input type="text" name="email" placeholder="Phone Number" class="form-control ps-3">
              </div>
              <div class="col-lg-12 mb-3">
                <input type="text" name="email" placeholder="Write Your Subject Here" class="form-control ps-3">
              </div>
              <div class="col-lg-12 mb-3">
                <textarea placeholder="Write Your Message Here" class="form-control ps-3" rows="8"></textarea>
              </div>
              <div class="d-grid">
                <button class="btn btn-primary btn-lg text-uppercase btn-rounded-none">Submit</button>
              </div>
            </form>
          </div>
        </div>

      </div>
    </div>
  </section>
@endsection
