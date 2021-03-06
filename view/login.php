<!DOCTYPE html>
<html lang="en">

<head>

     <title>Ứng dụng chat</title>

     <meta charset="UTF-8">
     <meta http-equiv="X-UA-Compatible" content="IE=Edge">


     <link rel="stylesheet" href="/assets/bootstrap/dist/css/bootstrap.min.css">


     <!-- MAIN CSS -->
     <link rel="stylesheet" href="/assets/css/type.css">
</head>

<body>

     <!-- PRE LOADER -->
     <section class="preloader">
          <div class="spinner">
               <span class="spinner-rotate"></span>
          </div>
     </section>


     <!-- MENU -->
     <section class="navbar custom-navbar navbar-fixed-top" role="navigation">
          <div class="container">





               <ul class="nav navbar-nav float-right" style="margin-left: auto;">

                    <li class="section-btn"><a href="#" data-toggle="modal" data-target="#modal-form">Sign in </a></li>
               </ul>
          </div>

          </div>
     </section>
     <img src="/assets/img/LG.png">
     <br>
     <p align="center"><img src="/assets/img/wc.png"></p>
     <img src="/assets/img/chat.gif">
     <img src="/assets/img/a.jpg">



     <!-- MODAL -->
     <section class="modal fade" id="modal-form" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-lg">
               <div class="modal-content modal-popup">

                    <div class="modal-header">
                         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                         </button>
                    </div>

                    <div class="modal-body">
                         <div class="container-fluid">
                              <div class="row">

                                   <div class="col-md-12 col-sm-12">
                                        <div class="modal-title">
                                             <h2>Chat</h2>
                                             <img src="/assets/img/LG.png" width="100px">
                                        </div>


                                        <ul class="nav nav-tabs" role="tablist">

                                             <li><a href="#sign_in" aria-controls="sign_in" role="tab" data-toggle="tab">Sign In</a></li>
                                        </ul>



                                        <div role="tabpanel" class="tab-pane fade in" id="sign_in">
                                             <form action="#" method="post">
                                                  <input type="email" class="form-control" name="email" placeholder="Email" required>
                                                  <input type="password" class="form-control" name="password" placeholder="Password" required>
                                                  <input type="submit" class="form-control" name="submit" value="Submit Button">
                                                  <a href="#">Forgot your password?</a>
                                             </form>
                                        </div>
                                   </div>
                              </div>

                         </div>
                    </div>
               </div>

          </div>
          </div>
     </section>

     <!-- SCRIPTS -->
     <script src="/assets/jquery/jquery.js"></script>
     <script src="/assets/bootstrap/dist/js/bootstrap.min.js"></script>

     <script src="/assets/js/custom.js"></script>
     <script type='text/javascript'>
          var pictureSrc = "/assets/img/br.png";
          var pictureWidth = 25; //
          var pictureHeight = 25;
          var numFlakes = 15; //số lượng bông tuyết
          var downSpeed = 0.01; //tốc độ rơi của bông tuyết (phần màn hình trên 100 mili giây)
          var lrFlakes = 15; // tốc độ bông tuyết bay từ bên này sang bên kia


          if (typeof(numFlakes) != 'number' || Math.round(numFlakes) != numFlakes || numFlakes < 1) {
               numFlakes = 10;
          }
          //vẽ bông tuyết
          for (var x = 0; x < numFlakes; x++) {
               if (document.layers) {
                    document.write('<layer id="snFlkDiv' + x + '"><imgsrc="' + pictureSrc + '" height="' + pictureHeight + '"width="' + pictureWidth + '" alt="*" border="0"></layer>');
               } else {
                    document.write('<div style="position:absolute; z-index:9999;"id="snFlkDiv' + x + '"><img src="' + pictureSrc + '"height="' + pictureHeight + '" width="' + pictureWidth + '" alt="*"border="0"></div>');
               }
          }
          // tính toán các vị trí ban đầu (trong các phần của kích thước cửa sổ trình duyệt)
          var xcoords = new Array(),
               ycoords = new Array(),
               snFlkTemp;
          for (var x = 0; x < numFlakes; x++) {
               xcoords[x] = (x + 1) / (numFlakes + 1);
               do {
                    snFlkTemp = Math.round((numFlakes - 1) * Math.random());
               } while (typeof(ycoords[snFlkTemp]) == 'number');
               ycoords[snFlkTemp] = x / numFlakes;
          }

          //now animate
          function flakeFall() {
               if (!getRefToDivNest('snFlkDiv0')) {
                    return;
               }
               var scrWidth = 0,
                    scrHeight = 0,
                    scrollHeight = 0,
                    scrollWidth = 0;
               // tìm cài đặt màn hình cho tất cả các biến thể. làm điều này mọi lúc cho phép thay đổi kích thước và cuộn
               if (typeof(window.innerWidth) == 'number') {
                    scrWidth = window.innerWidth;
                    scrHeight = window.innerHeight;
               } else {
                    if (document.documentElement && (document.documentElement.clientWidth || document.documentElement.clientHeight)) {
                         scrWidth = document.documentElement.clientWidth;
                         scrHeight = document.documentElement.clientHeight;
                    } else {
                         if (document.body && (document.body.clientWidth || document.body.clientHeight)) {
                              scrWidth = document.body.clientWidth;
                              scrHeight = document.body.clientHeight;
                         }
                    }
               }
               if (typeof(window.pageYOffset) == 'number') {
                    scrollHeight = pageYOffset;
                    scrollWidth = pageXOffset;
               } else {
                    if (document.body && (document.body.scrollLeft || document.body.scrollTop)) {
                         scrollHeight = document.body.scrollTop;
                         scrollWidth = document.body.scrollLeft;
                    } else {
                         if (document.documentElement && (document.documentElement.scrollLeft || document.documentElement.scrollTop)) {
                              scrollHeight = document.documentElement.scrollTop;
                              scrollWidth = document.documentElement.scrollLeft;
                         }
                    }
               }
               //Di chuyển bông tuyết đến vị trí mới
               for (var x = 0; x < numFlakes; x++) {
                    if (ycoords[x] * scrHeight > scrHeight - pictureHeight) {
                         ycoords[x] = 0;
                    }
                    var divRef = getRefToDivNest('snFlkDiv' + x);
                    if (!divRef) {
                         return;
                    }
                    if (divRef.style) {
                         divRef = divRef.style;
                    }
                    var oPix = document.childNodes ? 'px' : 0;
                    divRef.top = (Math.round(ycoords[x] * scrHeight) + scrollHeight) + oPix;
                    divRef.left = (Math.round(((xcoords[x] * scrWidth) - (pictureWidth / 2)) + ((scrWidth / ((numFlakes + 1) * 4)) * (Math.sin(lrFlakes * ycoords[x]) - Math.sin(3 * lrFlakes * ycoords[x])))) + scrollWidth) + oPix;
                    ycoords[x] += downSpeed;
               }
          }


          function getRefToDivNest(divName) {
               if (document.layers) {
                    return document.layers[divName];
               }
               if (document[divName]) {
                    return document[divName];
               }
               if (document.getElementById) {
                    return document.getElementById(divName);
               }
               if (document.all) {
                    return document.all[divName];
               }
               return false;
          }

          window.setInterval('flakeFall();', 100);
          //]]>
     </script>
     <br>
     <br>
     <br>
     <br>

</body>

</html>