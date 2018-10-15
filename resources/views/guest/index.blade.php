@extends('guest.layouts.app')

@section('content')
<style type="text/css">body{
  background-color: #f3f3f3;
}</style>
  <img src= "/storage/images/banner.jpg"
  width="1500" height="700"> 
<div class="container marketing">
  <!-- START THE FEATURETTES -->
  <hr class="featurette-divider">
  <div class="row featurette">
    <div class="col-md-7">
      <div class= "clearfix">
      <h2 class="featurette-heading">Secure your researches, thesis, etc. <span class="text-muted">Copyright.</span></h2>
      <p class="lead"> Copyright is a legal right created by the law of a country that grants the creator of an original work exclusive rights for its use and distribution. It is a form of intellectual property, applicable to certain forms of creative work. This means that the original creator of the product and anyone he gives authorization to are the only ones with the exclusive right to reproduce the work. Copyright law gives creators the original material, to further develop them for a given time, at which point the copyrighted item becomes the public domain.</p>

      <button onclick="location.href='{{ route('copyrightables') }}'" type="button" class="btn btn-outline-danger">List of Copyrightable Works
      </button>
      </div>
    </div>
    <div class="col-md-5">
      <div class= "clearfix">
      <div class="card">
        <div class="card-body">
      <img class="featurette-image img-fluid mx-auto" src="/storage/images/idea.jpg" alt="Generic placeholder image">
        </div>
      </div>
    </div>
  </div>
</div>
  <hr class="featurette-divider">
 
  <div class="row featurette">
    <div class="col-md-7 order-md-2">
      <h2 class="featurette-heading">As for products and inventions, <span class="text-muted">Patent.</span></h2>
      <p class="lead">Patenting is an exclusive right granted for a product, process or an improvement of a product or process which is new, inventive, and useful. This exclusive right gives the inventor the right to exclude others from making, using, or selling the product of his invention during the life of the patent. </p>
       <button onclick="location.href='{{ route('patentables') }}'" class="btn btn-outline-danger">List of Patentable Works
      </button>
    </div>

    <div class="col-md-5 order-md-1">
      <div class="card">
        <div class="card-body">
          <img class="featurette-image img-fluid mx-auto" src="/storage/images/invent.jpg" alt="Generic placeholder image">
        </div>
      </div>
    </div>
  </div>

  <hr class="featurette-divider">

  <div class="row featurette">
    <div class="col-md-7">
      <h2 class="featurette-heading">And lastly, <span class="text-muted"><br>About the developers</span></h2>
      <p class="lead">PIPMS Developers took up Bachelor of Science in Information Technology in Polytechnic University  of the Philippines Sta. Mesa, Manila. This system is part of the requirements for their Capstone Project, Senior Year, First Semester. The requirements analysis and design was conceptualized with the help of the client, technical expert, Sir Buhn Alay Colorado and the whole staff of the Intellectual Properties Management Office. Developers are looking forward for the innovations and suggestions for the improvement of the system. </p>

    <h3 class="text-muted">Email Accounts:</h3>
    <p class="lead">
      edgardo.cubian@yahoo.com <br>
      ninomarlonvilla@gmail.com <br>
      karl.causaren@gmail.com<br>
      lyssamortel@gmail.com</p>
    </div>
    <div class="col-md-5">
      <div class="card">
        <div class="card-body">
      <img class="featurette-image img-fluid mx-auto" src="/storage/images/featurette3.jpg" alt="Generic placeholder image">
        </div>
      </div>
    </div>
  </div>

  <hr class="featurette-divider">

  <!-- /END THE FEATURETTES -->

</div><!-- /.container -->
@endsection

@section('pg-specific-js')
<script>
  $(document).ready(function(){
    $('a[href="/"]').addClass('active');
  });
</script>
@endsection