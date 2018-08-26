@extends('guest.layouts.app')

@section('content')
  <div id="myCarousel" class="carousel slide" data-ride="carousel">
    <ol class="carousel-indicators">
      <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
      <li data-target="#myCarousel" data-slide-to="1"></li>
      <li data-target="#myCarousel" data-slide-to="2"></li>
    </ol>
    <div class="carousel-inner">
      <div class="carousel-item active">
        <img class="first-slide" src="storage/images/carousel1.jpg" alt="First slide">
        <div class="container">
          <div class="carousel-caption text-right">
            <p><a class="btn btn-lg btn-primary" href="/copyright/create" role="button">Request for copyright now</a></p>
          </div>
        </div>
      </div>
      <div class="carousel-item">
        <img class="second-slide" src="storage/images/carousel2.jpg" alt="Second slide">
        <div class="container">
          <div class="carousel-caption text-right">
            <p><a class="btn btn-lg btn-primary" href="#" role="button">Learn more</a></p>
          </div>
        </div>
      </div>
      <div class="carousel-item">
        <img class="third-slide" src="storage/images/carousel3.jpg" alt="Third slide">
        <div class="container">
          <div class="carousel-caption text-left">
            <p><a class="btn btn-lg btn-primary" href="/register" role="button">Request faculty account</a></p>
          </div>
        </div>
      </div>
    </div>
    <a class="carousel-control-prev" href="#myCarousel" role="button" data-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#myCarousel" role="button" data-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="sr-only">Next</span>
    </a>
  </div>


  <!-- Marketing messaging and featurettes
  ================================================== -->
  <!-- Wrap the rest of the page in another container to center all the content. -->

  <div class="container marketing">

    <!-- START THE FEATURETTES -->

    <hr class="featurette-divider">

    <div class="row featurette">
      <div class="col-md-7">
        <h2 class="featurette-heading">Secure your researches, thesis, etc. <span class="text-muted">Copyright</span></h2>
        <p class="lead">
Copyright is a legal right created by the law of a country that grants the creator of an original work exclusive rights for its use and distribution. It is a form of intellectual property, applicable to certain forms of creative work. This means that the original creator of the product and anyone he gives authorization to are the only ones with the exclusive right to reproduce the work. Copyright law gives creators the original material, to further develop them for a given time, at which point the copyrighted item becomes the public domain.</p>
      </div>
      <div class="col-md-5">
        <img class="featurette-image img-fluid mx-auto" src="storage/images/featurette1.jpg" alt="Generic placeholder image">
      </div>
    </div>

    <hr class="featurette-divider">

    <div class="row featurette">
      <div class="col-md-7 order-md-2">
        <h2 class="featurette-heading">As for products and inventions, <span class="text-muted">Patent.</span></h2>
        <p class="lead">Patenting is an exclusive right granted for a product, process or an improvement of a product or process which is new, inventive, and useful. This exclusive right gives the inventor the right to exclude others from making, using, or selling the product of his invention during the life of the patent. </p>
      </div>
      <div class="col-md-5 order-md-1">
        <img class="featurette-image img-fluid mx-auto" src="storage/images/featurette2.jpg" alt="Generic placeholder image">
      </div>
    </div>

    <hr class="featurette-divider">

    <div class="row featurette">
      <div class="col-md-7">
        <h2 class="featurette-heading">And lastly, <span class="text-muted">About the developers</span></h2>
        <p class="lead">PIPMS Developers took up Bachelor of Science in Information Technology in Polytechnic University  of the Philippines Sta. Mesa, Manila. This system is part of the requirements for their Capstone Project, Senior Year, First Semester. The requirements analysis and design was conceptualized with the help of the client, technical expert, Sir Buhn Alay Colorado and the whole staff of the Intellectual Properties Management Office. Developers are looking forward for the innovations and suggestions for the improvement of the system. </p>

      <h3 class="text-muted">Email Accounts:</h3>
      <p class="lead">
        edgardo.cubian@yahoo.com <br>
        ninomarlonvilla@gmail.com <br>
        karl.causaren@gmail.com<br>
        lyssamortel@gmail.com</p>
      </div>
      <div class="col-md-5">
        <img class="featurette-image img-fluid mx-auto" src="storage/images/featurette3.jpg" alt="Generic placeholder image" style="margin-top: 100px;">
      </div>
    </div>

    <hr class="featurette-divider">

    <!-- /END THE FEATURETTES -->

  </div><!-- /.container -->
<script>
  $(document).ready(function(){
    $('a[href="/"]').addClass('active');
  });
</script>
@endsection