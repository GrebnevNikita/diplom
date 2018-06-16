
            <?php
include_once "header.php"; 
?>


 <div id="myCarousel" class="carousel slide" data-ride="carousel">
  <ol class="carousel-indicators">
    <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
    <li data-target="#myCarousel" data-slide-to="1"></li>
    <li data-target="#myCarousel" data-slide-to="2"></li>
    <li data-target="#myCarousel" data-slide-to="3"></li>
  </ol>

  
  <div class="carousel-inner">
    <div class="item active">
      <img src="img/slider1.jpg" alt="">
    </div>

    <div class="item">
      <img src="img/slider2.jpg" alt="">
    </div>

    <div class="item">
      <img src="img/slider3.jpg" alt="">
    </div>
    <div class="item">
      <img src="img/slider4.jpg" alt="">
    </div>
  </div>

  
  <a class="left carousel-control" href="#myCarousel" data-slide="prev">
    <span class="glyphicon glyphicon-chevron-left"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="right carousel-control" href="#myCarousel" data-slide="next">
    <span class="glyphicon glyphicon-chevron-right"></span>
    <span class="sr-only">Next</span>
  </a>
</div> 



        <?php
include_once "footer.php"; 
?>
