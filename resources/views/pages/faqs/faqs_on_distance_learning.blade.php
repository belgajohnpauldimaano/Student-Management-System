@extends('layouts.main')

@section('title')
	FAQs
@endsection

@section('content')
	<div class="global-header" style="background-image: url('{{ asset('img/intro-banner/1.jpg') }}');">
		<div class="global-header__block">
			<div class="va-block">
				<div class="va-middle text-center">
					<h1>Frequently Asked Questions on Distance Learning</h1>
				</div>
			</div>
		</div>
	</div>
    <main id="main">
		<div class="container" style="overflow: hidden">
			<div class="row">		
        <div class="col-md-12">
                    <div class="accordion mb-4" id="accordionExample">
                        <div class="card">
                          <div class="card-header" id="headingOne">
                            <h2 class="mb-0">
                              <button class="btn btn-link btn-block text-left" style="white-space: normal" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                1. What is Distance Learning or home-based learning?
                              </button>
                            </h2>
                          </div>
                      
                          <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
                            <div class="card-body">
                              It is a combination of on-line synchronous and asynchronous learning methods.
                            </div>
                          </div>
                        </div>
                        <div class="card">
                          <div class="card-header" id="headingTwo">
                            <h2 class="mb-0">
                              <button class="btn btn-link btn-block text-left collapsed" style="white-space: normal" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                2. What is blended learning? 
                              </button>
                            </h2>
                          </div>
                          <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
                            <div class="card-body">
                              It is a mix of on-line learning tools and classroom pedagogy.
                            </div>
                          </div>
                        </div>
                        <div class="card">
                          <div class="card-header" id="headingThree">
                            <h2 class="mb-0">
                              <button class="btn btn-link btn-block text-left collapsed" style="white-space: normal" type="button" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                3. What is synchronous learning?
                              </button>
                            </h2>
                          </div>
                          <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordionExample">
                            <div class="card-body">
                              These are learning activities that are done in real time with teacher either online or face to face.
                            </div>
                          </div>
                        </div>

                        <div class="card">
                            <div class="card-header" id="headingFour">
                              <h2 class="mb-0">
                                <button class="btn btn-link btn-block text-left collapsed" style="white-space: normal" type="button" data-toggle="collapse" data-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                                  4. What is asynchronous learning?
                                </button>
                              </h2>
                            </div>
                            <div id="collapseFour" class="collapse" aria-labelledby="headingFour" data-parent="#accordionExample">
                              <div class="card-body">
                                These are learning activities that are done at one’s pace outside school.
                              </div>
                            </div>
                        </div>

                        <div class="card">
                            <div class="card-header" id="headingFive">
                              <h2 class="mb-0">
                                <button class="btn btn-link btn-block text-left collapsed" style="white-space: normal" type="button" data-toggle="collapse" data-target="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
                                  5. What are needed in distance learning/home-based learning?
                                </button>
                              </h2>
                            </div>
                            <div id="collapseFive" class="collapse" aria-labelledby="headingFive" data-parent="#accordionExample">
                              <div class="card-body">
                                A conducive learning space, good connectivity, gadget preferably laptop, desktop or smart phone.
                              </div>
                            </div>
                        </div>

                        <div class="card">
                            <div class="card-header" id="headingSix">
                              <h2 class="mb-0">
                                <button class="btn btn-link btn-block text-left collapsed" style="white-space: normal" type="button" data-toggle="collapse" data-target="#collapseSix" aria-expanded="false" aria-controls="collapseSix">
                                  6. Why is laptop or desktop more convenient to use than smartphone?
                                </button>
                              </h2>
                            </div>
                            <div id="collapseSix" class="collapse" aria-labelledby="headingSix" data-parent="#accordionExample">
                              <div class="card-body">
                                Laptop/Desktop have better features and with bigger screen compared to smart phone.
                              </div>
                            </div>
                        </div>

                        <div class="card">
                            <div class="card-header" id="headingSeven">
                              <h2 class="mb-0">
                                <button class="btn btn-link btn-block text-left collapsed" style="white-space: normal" type="button" data-toggle="collapse" data-target="#collapseSeven" aria-expanded="false" aria-controls="collapseSeven">
                                  7. How many gadgets do students need at home if everyone is in online learning?
                                </button>
                              </h2>
                            </div>
                            <div id="collapseSeven" class="collapse" aria-labelledby="headingSeven" data-parent="#accordionExample">
                              <div class="card-body">
                                The rule is one gadget per student.
                              </div>
                            </div>
                        </div>

                        <div class="card">
                            <div class="card-header" id="headingEight">
                              <h2 class="mb-0">
                                <button class="btn btn-link btn-block text-left collapsed" style="white-space: normal" type="button" data-toggle="collapse" data-target="#collapseEight" aria-expanded="false" aria-controls="collapseEight">
                                  8. Are textbooks still needed in home-based learning?
                                </button>
                              </h2>
                            </div>
                            <div id="collapseEight" class="collapse" aria-labelledby="headingEight" data-parent="#accordionExample">
                              <div class="card-body">
                                Yes, they are very essential for activities, advance reading and assignments.
                              </div>
                            </div>
                        </div>

                        <div class="card">
                            <div class="card-header" id="headingNine">
                              <h2 class="mb-0">
                                <button class="btn btn-link btn-block text-left collapsed" style="white-space: normal" type="button" data-toggle="collapse" data-target="#collapseNine" aria-expanded="false" aria-controls="collapseNine">
                                  9. What if our location has weak signal?
                                </button>
                              </h2>
                            </div>
                            <div id="collapseNine" class="collapse" aria-labelledby="headingNine" data-parent="#accordionExample">
                              <div class="card-body">
                                Subject teachers would provide learning modules to the students that is why textbooks are very important. The learning modules are self-directed. Teachers would also provide pre-recorded videos of the lesson. These are to be picked up by parents in SJAI Office on scheduled dates.
                              </div>
                            </div>
                        </div>

                        <div class="card">
                          <div class="card-header" id="headingNine">
                            <h2 class="mb-0">
                              <button class="btn btn-link btn-block text-left collapsed" style="white-space: normal" type="button" data-toggle="collapse" data-target="#collapseEleven" aria-expanded="false" aria-controls="collapseEleven">
                                10. What would be the role of the parents in home-based learning?
                              </button>
                            </h2>
                          </div>
                          <div id="collapseEleven" class="collapse" aria-labelledby="headingNine" data-parent="#accordionExample">
                            <div class="card-body">
                                They will serve as the school partners in supervising the schooling of their child at home. 
                            </div>
                          </div>
                        </div>

                        <div class="card">
                          <div class="card-header" id="headingNine">
                            <h2 class="mb-0">
                              <button class="btn btn-link btn-block text-left collapsed" style="white-space: normal" type="button" data-toggle="collapse" data-target="#collapseTen" aria-expanded="false" aria-controls="collapseTen">
                                11. In case of power interruption, will there be classes?
                              </button>
                            </h2>
                          </div>
                          <div id="collapseTen" class="collapse" aria-labelledby="headingNine" data-parent="#accordionExample">
                            <div class="card-body">
                              Yes, basically power interruption is announced, therefore the teacher may give asynchronous activities. 
                            </div>
                          </div>
                        </div>


                        <div class="card">
                          <div class="card-header" id="headingNine">
                            <h2 class="mb-0">
                              <button class="btn btn-link btn-block text-left collapsed" style="white-space: normal" type="button" data-toggle="collapse" data-target="#collapse13" aria-expanded="false" aria-controls="collapse13">
                                12. What if only in our location there is power interruption, will I be excused from the on-line classes?
                              </button>
                            </h2>
                          </div>
                          <div id="collapse13" class="collapse" aria-labelledby="headingNine" data-parent="#accordionExample">
                            <div class="card-body">
                              Yes, inform your adviser/ subject teacher ahead of time through social media, so he/she could provide you asynchronous activities.
                            </div>
                          </div>
                        </div>

                        <div class="card">
                          <div class="card-header" id="headingNine">
                            <h2 class="mb-0">
                              <button class="btn btn-link btn-block text-left collapsed" style="white-space: normal" type="button" data-toggle="collapse" data-target="#collapse14" aria-expanded="false" aria-controls="collapse14">
                                13. What if the LGU announces suspension of classes due to inclement weather, are we included?
                              </button>
                            </h2>
                          </div>
                          <div id="collapse14" class="collapse" aria-labelledby="headingNine" data-parent="#accordionExample">
                            <div class="card-body">
                                <p>
                                  No, because we are adapting home-based learning.
                                </p>
                            </div>
                          </div>
                        </div>

                        <div class="card">
                          <div class="card-header" id="headingNine">
                            <h2 class="mb-0">
                              <button class="btn btn-link btn-block text-left collapsed" style="white-space: normal" type="button" data-toggle="collapse" data-target="#collapse15" aria-expanded="false" aria-controls="collapse15">
                                14. Will there be collaboration in doing our performance tasks in home-based learning?
                              </button>
                            </h2>
                          </div>
                          <div id="collapse15" class="collapse" aria-labelledby="headingNine" data-parent="#accordionExample">
                            <div class="card-body">
                                <p>
                                  Definitely. But teacher would still observe minimal number of students per group.
                                </p>
                            </div>
                          </div>
                        </div>

                        <div class="card">
                          <div class="card-header" id="headingNine">
                            <h2 class="mb-0">
                              <button class="btn btn-link btn-block text-left collapsed" style="white-space: normal" type="button" data-toggle="collapse" data-target="#collapse16" aria-expanded="false" aria-controls="collapse16">
                                15. How would the teacher protect the integrity of summative assessments?
                              </button>
                            </h2>
                          </div>
                          <div id="collapse16" class="collapse" aria-labelledby="headingNine" data-parent="#accordionExample">
                            <div class="card-body">
                              Assessments would be given in real time. Further explanation of this procedure will be explained before the quarterly assessments
                            </div>
                          </div>
                        </div>

                        <div class="card">
                          <div class="card-header" id="headingNine">
                            <h2 class="mb-0">
                              <button class="btn btn-link btn-block text-left collapsed" style="white-space: normal" type="button" data-toggle="collapse" data-target="#collapse17" aria-expanded="false" aria-controls="collapse17">
                                16. What time will the class start?
                              </button>
                            </h2>
                          </div>
                          <div id="collapse17" class="collapse" aria-labelledby="headingNine" data-parent="#accordionExample">
                            <div class="card-body">
                              SJAI will still follow the usual class schedules. Classes start at 7 AM ends at 11:30 AM, resume at 1PM end at most at 4:30 PM. But every Friday, classes all end at 3PM for the Professional Learning Community of Teachers.
                            </div>
                          </div>
                        </div>

                        
                        
                    </div>	
                  </div>
				</div>
			</div>
		</div>
    </main>
@endsection