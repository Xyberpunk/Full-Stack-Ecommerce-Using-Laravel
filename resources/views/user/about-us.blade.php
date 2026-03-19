@extends('layouts.storefront')

@section('body_attributes') class="bg-body" data-bs-spy="scroll" data-bs-target="#navbar" data-bs-root-margin="0px 0px -40%"
  data-bs-smooth-scroll="true" tabindex="0"@endsection

@section('page_title', 'About Us')

@section('storefront_content')
<section id="about-us" class="padding-large pt-5">
    <div class="container-fluid">
      <div class="row">
        <img src="{{ asset('assets/images/hero-image1.jpg') }}" alt="Jewellery" class="img-fluid">
        <div class="col-lg-10 mx-auto text-center pt-5">
          <blockquote class="fs-4">Volutpat velit nulla eu iaculis risus in urna. Eu morbi vel purus velit dui vel
            egestas purus sed. Eget turpis tincidunt faucibus montes arcu in nullam tortor orci. Nulla tellus sed purus
            vestibulum sagittis pretium donec nec mattis ollis porta sit ut.Facilisi ut vulputate volutpat a aliquet.
          </blockquote>
        </div>
        <div class="col-lg-10 mx-auto pt-5">
          <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Qui consectetur possimus repellat natus
            molestias. Laboriosam totam veritatis aspernatur nostrum quam illum voluptatibus quae. Dolor repellat sint
            similique illum accusamus tempore. Lorem ipsum, dolor sit amet consectetur adipisicing elit. Impedit
            temporibus ipsam esse quis incidunt enim quae dolor voluptate reprehenderit, accusantium adipisci optio
            tempora vel, earum libero! Nobis perferendis ex expedita. Lorem ipsum dolor sit amet consectetur adipisicing
            elit. Corporis maxime quia quaerat delectus! Neque incidunt, accusantium nihil quia sit sed non laborum
            amet. Cum ullam, doloremque incidunt illum earum hic!</p>
          <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Eveniet et unde blanditiis veritatis, esse neque
            quis excepturi amet illo laudantium maiores ratione praesentium. Facere cumque magni, voluptatem dolores
            totam tempora. Lorem ipsum dolor sit amet consectetur, adipisicing elit. Repellendus at alias neque nulla,
            ad delectus laborum obcaecati amet quos quod ducimus itaque nam possimus aliquam corrupti hic eos nemo
            voluptatibus. Lorem, ipsum dolor sit amet consectetur adipisicing elit. Necessitatibus aut hic inventore
            minima modi laboriosam? Quidem aliquam sed vitae quisquam, sequi hic unde a maiores, quia inventore impedit!
            Animi, saepe. Lorem ipsum dolor, sit amet consectetur adipisicing elit. Inventore eveniet ex nemo illum
            exercitationem quasi minima eos voluptatum tempore quaerat, repudiandae ipsam odio a voluptates officia.
            Culpa asperiores eveniet vel?</p>
        </div>
      </div>
    </div>
  </section>

  <section id="interiors-features">
    <div class="container-fluid">
      <div class="row">
        <div class="col-lg-3 col-md-6">
          <div class="features-item text-center mb-5">
            <svg class="expert" width="50" height="50">
              <use xlink:href="#expert"></use>
            </svg>
            <div class="features-content mt-3">
              <h3>Curated by our experts</h3>
              <p>Suspendisse tempus rhoncus enim pellentesque est vehicula vitae eget.</p>
            </div>
          </div>
        </div>
        <div class="col-lg-3 col-md-6">
          <div class="features-item text-center mb-5">
            <svg class="creative" width="50" height="50">
              <use xlink:href="#creative"></use>
            </svg>
            <div class="features-content mt-3">
              <h3>Creative</h3>
              <p>Suspendisse tempus rhoncus enim pellentesque est vehicula vitae eget.</p>
            </div>
          </div>
        </div>
        <div class="col-lg-3 col-md-6">
          <div class="features-item text-center mb-5">
            <svg class="dedicated" width="50" height="50">
              <use xlink:href="#dedicated"></use>
            </svg>
            <div class="features-content mt-3">
              <h3>Dedicated</h3>
              <p>Suspendisse tempus rhoncus enim pellentesque est vehicula vitae eget.</p>
            </div>
          </div>
        </div>
        <div class="col-lg-3 col-md-6">
          <div class="features-item text-center">
            <svg class="shopping-cart" width="50" height="50">
              <use xlink:href="#shopping-cart"></use>
            </svg>
            <div class="features-content mt-3">
              <h3>One cart shopping</h3>
              <p>Suspendisse tempus rhoncus enim pellentesque est vehicula vitae eget.</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
@endsection
