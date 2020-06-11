<?php $__env->startSection('content'); ?>
    <section id="intro">
        <div class="intro-container">
          <div id="introCarousel" class="carousel  slide carousel-fade" data-ride="carousel">
            <ol class="carousel-indicators"></ol>
            <div class="carousel-inner" role="listbox">

              <div class="carousel-item active" style="background-image: url('<?php echo e(asset('img/intro-banner/1.jpg')); ?>');">
                <div class="carousel-container">
                  <div class="carousel-content">
                    <h2>St. John's Academy Inc.</h2>
                    <p>Striving for Academic Excellence, Innovation and Christian Formation</p>
                    
                    <a href="#" class="btn-get-started scrollto">About SJAI</a>
                  </div>
                </div>
              </div>

              <div class="carousel-item" style="background-image: url('<?php echo e(asset('img/intro-banner/2.jpg')); ?>');">
                <div class="carousel-container">
                  <div class="carousel-content">
                    <h2>Academic Excellence</h2>
                    <p>life-long learners able to think critically</p>
                    
                  </div>
                </div>
              </div>

              <div class="carousel-item" style="background-image: url('<?php echo e(asset('img/intro-banner/3.jpg')); ?>');">
                <div class="carousel-container">
                  <div class="carousel-content">
                    <h2>Well-rounded Leaders</h2>
                    <p>with Catholic values</p>
                    
                  </div>
                </div>
              </div>

              <div class="carousel-item" style="background-image: url('<?php echo e(asset('img/intro-banner/4.jpg')); ?>');">
                <div class="carousel-container">
                  <div class="carousel-content">
                    <h2>Personalized Attention</h2>
                    <p>to maximize learning</p>
                    
                  </div>
                </div>
              </div>

            </div>

            <a class="carousel-control-prev" href="#introCarousel" role="button" data-slide="prev">
              <span class="carousel-control-prev-icon ion-chevron-left" aria-hidden="true"></span>
              <span class="sr-only">Previous</span>
            </a>

            <a class="carousel-control-next" href="#introCarousel" role="button" data-slide="next">
              <span class="carousel-control-next-icon ion-chevron-right" aria-hidden="true"></span>
              <span class="sr-only">Next</span>
            </a>

          </div>
        </div>
    </section>
    <main id="main">
       

        <section id="about">
            <div class="container">
                
                <div class="row about-cols">
                    <div class="col-md-4 wow fadeInUp">
                        <div class="about-col" style="height: 26.5em !important">
                            <div class="img">
                                <img src="<?php echo e(asset('img/mission.jpg')); ?>" alt="" class="img-fluid">
                                <div class="icon"><i class="ion-ios-speedometer-outline"></i></div>
                            </div>
                            <h2 class="title"><a href="#">Strategic Thrust</a></h2>
                            <ol style="font-size: 14px">
                                <li>Academic Excellence</li>
                                <li>Character Development</li>
                                <li>Organization and System Excellence</li>
                            </ol>
                            <p style="text-align: right"><a href="<?php echo e(route('vision_mission')); ?>">readmore</a></p>                            
                        </div>
                    </div>
                    <div class="col-md-4 wow fadeInUp" data-wow-delay="0.1s">
                        <div class="about-col" style="height: 26.5em !important">
                            <div class="img">
                                <img src="<?php echo e(asset('img/history.jpg')); ?>" alt="" class="img-fluid">
                                <div class="icon"><i class="ion-ios-list-outline"></i></div>
                            </div>
                            <h2 class="title"><a href="#">Our History</a></h2>
                            <p>
                                SAINT JOHN ACADEMY was born out of a clamor for a Catholic educational institution which will provide a deeply-rooted Christian formation to the young and which can supply the volunteers... <a href="<?php echo e(route('history')); ?>">readmore</a>
                            </p>
                        </div>
                    </div>
                    <div class="col-md-4 wow fadeInUp" data-wow-delay="0.2s">
                        <div class="about-col" style="height: 26.5em !important">
                            <div class="img">
                                <img src="<?php echo e(asset('img/vision.jpg')); ?>" alt="" class="img-fluid">
                                <div class="icon"><i class="ion-ios-eye-outline"></i></div>
                            </div>
                            <h2 class="title"><a href="#">Our Vision</a></h2>
                            <p>
                                By 2025, St. John's Academy Inc. is the leading innovative Catholic School in Dinalupihan, Bataan... <a href="<?php echo e(route('vision_mission')); ?>">readmore</a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <?php if($Article->count()): ?>
            <section class="articles">
                <div class="container">
                    <header class="section-header">
                        <h3>News and Events</h3>
                        <p class="mb-0">&nbsp;</p>
                    </header>
                    
                    <div class="row articles-cols">
                        <?php $__currentLoopData = $Article; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="col-lg-4 wow fadeInUp">
                                <div class="card-background mb-3" style="background-image: url(<?php echo e(asset('content/articles/featured_image') . '/' . $item->featured_image); ?>); height: 240px;"></div>
                                <h4 class="title"><a href="#"><?php echo e(str_limit($item->title, 50)); ?></a></h4>
                                <p><?php echo str_limit(html_entity_decode(strip_tags($item->content)), 170); ?></p>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </div>
            </section>
        <?php endif; ?>

        

        

        

        

        <section id="contact" class="section-bg wow fadeInUp">
            <div class="container">
                <div class="section-header">
                    <h3>Contact Us</h3>
                    <p>Please contact us if you have any questions</p>
                </div>
                <div class="row contact-info">
                    <div class="col-md-4">
                        <div class="contact-address">
                            <i class="ion-ios-location-outline"></i>
                            <h3>Address</h3>
                            <address>Rizal Street, Dinalupihan Bataan, 2110 </address>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="contact-phone">
                            <i class="ion-ios-telephone-outline"></i>
                            <h3>Phone Number</h3>
                            <p><a href="tel:0474811762">(047) 636 5560<br/>(047) 636 0088</a></p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="contact-email">
                            <i class="ion-ios-email-outline"></i>
                            <h3>Email</h3>
                            <p><a href="mailto:info@sja-bataan.com">info@sja-bataan.com</a></p>
                        </div>
                    </div>
                </div>
                <div class="form">
                    <div id="sendmessage">Your message has been sent. Thank you!</div>
                    <div id="errormessage"></div>
                    <form action="" method="post" role="form" class="contactForm">
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <input type="text" name="name" class="form-control" id="name" placeholder="Your Name" data-rule="minlen:4" data-msg="Please enter at least 4 chars" />
                                <div class="validation"></div>
                            </div>
                            <div class="form-group col-md-6">
                                <input type="email" class="form-control" name="email" id="email" placeholder="Your Email" data-rule="email" data-msg="Please enter a valid email" />
                                <div class="validation"></div>
                            </div>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" name="subject" id="subject" placeholder="Subject" data-rule="minlen:4" data-msg="Please enter at least 8 chars of subject" />
                            <div class="validation"></div>
                        </div>
                        <div class="form-group">
                            <textarea class="form-control" name="message" rows="5" data-rule="required" data-msg="Please write something for us" placeholder="Message"></textarea>
                            <div class="validation"></div>
                        </div>
                        <div class="text-center">
                            <button type="submit">Send Message</button>
                        </div>
                    </form>
                </div>
            </div>
        </section>
    </main>
    <?php echo $__env->make('pages.reservation', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.main', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>