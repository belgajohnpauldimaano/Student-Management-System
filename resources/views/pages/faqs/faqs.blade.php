@extends('layouts.main')

@section('title')
	FAQs
@endsection

@section('content')
	<div class="global-header" style="background-image: url('{{ asset('img/intro-banner/1.jpg') }}');">
		<div class="global-header__block">
			<div class="va-block">
				<div class="va-middle text-center">
					<h1>Frequently Asked Questions</h1>
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
                      <a class="btn btn-link btn-block btn-faq text-left" style="white-space: normal" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                        What are the benefits of paying online?
                      </a>
                    </h2>
                  </div>
              
                  <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
                    <div class="card-body">
                        Paying online with a credit card or debit card saves time, gives you the flexibility to pay how and when desired, saves money, saves time and long queue.
                    </div>
                  </div>
                </div>
                <div class="card">
                  <div class="card-header" id="headingTwo">
                    <h2 class="mb-0">
                      <a class="btn btn-link btn-block btn-faq text-left collapsed" style="white-space: normal" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                        What forms of payment can I use?
                      </a>
                    </h2>
                  </div>
                  <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
                    <div class="card-body">
                        You can pay by credit or debit card or you may use an electronic mobile (like money transfer, internet or mobile banking) or overseas remittance centers or over the counter banking for the banks that are accredited by St. John’s Academy Inc.
                    </div>
                  </div>
                </div>
                <div class="card">
                  <div class="card-header" id="headingThree">
                    <h2 class="mb-0">
                      <a class="btn btn-link btn-block btn-faq text-left collapsed" style="white-space: normal" type="button" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                        How should I enter my credit card information?
                      </a>
                    </h2>
                  </div>
                  <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordionExample">
                    <div class="card-body">
                        The information you enter on the Payment screen must be exactly the same as it appears on your credit card. This information collected will be used to authorize your payment.
                    </div>
                  </div>
                </div>

                <div class="card">
                    <div class="card-header" id="headingFour">
                      <h2 class="mb-0">
                        <a class="btn btn-link btn-block btn-faq text-left collapsed" style="white-space: normal" type="button" data-toggle="collapse" data-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                            How will I know that my payment has been accepted?
                        </a>
                      </h2>
                    </div>
                    <div id="collapseFour" class="collapse" aria-labelledby="headingFour" data-parent="#accordionExample">
                      <div class="card-body">
                        After you submit your payment, you will also receive a confirmation email after your transaction is submitted. The email will include your name, invoice number, amount paid, total balance and confirmation message.
                      </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header" id="headingFive">
                      <h2 class="mb-0">
                        <a class="btn btn-link btn-block btn-faq text-left collapsed" style="white-space: normal" type="button" data-toggle="collapse" data-target="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
                            How long does it take for a credit card transaction to process if I pay online?
                        </a>
                      </h2>
                    </div>
                    <div id="collapseFive" class="collapse" aria-labelledby="headingFive" data-parent="#accordionExample">
                      <div class="card-body">
                        Credit card transaction typically takes 48 hours to settle. An authorization is issued immediately; however, it takes 48 hours for the money to be moved. 
                      </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header" id="headingSix">
                      <h2 class="mb-0">
                        <a class="btn btn-link btn-block btn-faq text-left collapsed" style="white-space: normal" type="button" data-toggle="collapse" data-target="#collapseSix" aria-expanded="false" aria-controls="collapseSix">
                            Can I use a debit card to pay?
                        </a>
                      </h2>
                    </div>
                    <div id="collapseSix" class="collapse" aria-labelledby="headingSix" data-parent="#accordionExample">
                      <div class="card-body">
                        Yes, although technically your debit card will be processed like a credit card and you will not be asked to enter a pin number.
                      </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header" id="headingSeven">
                      <h2 class="mb-0">
                        <a class="btn btn-link btn-block btn-faq text-left collapsed" style="white-space: normal" type="button" data-toggle="collapse" data-target="#collapseSeven" aria-expanded="false" aria-controls="collapseSeven">
                            Who do I contact with questions about my payment and fee?
                        </a>
                      </h2>
                    </div>
                    <div id="collapseSeven" class="collapse" aria-labelledby="headingSeven" data-parent="#accordionExample">
                      <div class="card-body">
                        You may call St. John’s Academy Inc. (Finance office) at (047) 636 5560, 0961-1199299 for globe and 0995-6352801 for smart between 8 a.m. and 5 p.m.
                      </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header" id="headingEight">
                      <h2 class="mb-0">
                        <a class="btn btn-link btn-block btn-faq text-left collapsed" style="white-space: normal" type="button" data-toggle="collapse" data-target="#collapseEight" aria-expanded="false" aria-controls="collapseEight">
                            What are transaction fees and why do I need to pay them?
                        </a>
                      </h2>
                    </div>
                    <div id="collapseEight" class="collapse" aria-labelledby="headingEight" data-parent="#accordionExample">
                      <div class="card-body">
                        Transaction fees are minimal charges from our payment partners. For partners like PNB Dinalupihan and Chinabank Dinalupihan transaction fee is P10.00 for online banking (bank transfer).
                      </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header" id="headingNine">
                      <h2 class="mb-0">
                        <a class="btn btn-link btn-block btn-faq text-left collapsed" style="white-space: normal" type="button" data-toggle="collapse" data-target="#collapseNine" aria-expanded="false" aria-controls="collapseNine">
                          How do I register?
                        </a>
                      </h2>
                    </div>
                    <div id="collapseNine" class="collapse" aria-labelledby="headingNine" data-parent="#accordionExample">
                      <div class="card-body">
                          <p><b>For old students</b> (Grade 8 – Grade 11), login to our official website using your username and password. </p>
                          <div align="center">
                            <img class="img-responsive testimonial-img" src="{{ asset('/img/faqs/login.png')}}" alt="login" width="70%">
                            <p class="mt-2">Upon opening your account, click “Enrollment”</p>
                          </div>
                          
                          <div align="center">
                            <img class="img-responsive testimonial-img" src="{{ asset('/img/faqs/enrollment.png')}}" alt="login" width="70%">
                            <p class="mt-2">Fill up the necessary information and process your online enrollment.</p>
                          </div>
                          
                      </div>
                    </div>
                </div>

                <div class="card">
                  <div class="card-header" id="headingNine">
                    <h2 class="mb-0">
                      <a class="btn btn-link btn-block btn-faq text-left collapsed" style="white-space: normal" type="button" data-toggle="collapse" data-target="#collapseEleven" aria-expanded="false" aria-controls="collapseEleven">
                        For incoming students (Grade 7 and transferees)
                      </a>
                    </h2>
                  </div>
                  <div id="collapseEleven" class="collapse" aria-labelledby="headingNine" data-parent="#accordionExample">
                    <div class="card-body">
                        <p>Go to <a href="http://www.sja-bataan.com">www.sja-bataan.com</a>  and click “registration”</p>

                        <div align="center">
                          <img class="img-responsive testimonial-img" src="{{ asset('/img/faqs/registration.png')}}" alt="login" width="70%">
                          <p class="mt-2">Fill up the information needed. You will receive confirmation via email address that you have provided in the form indicating username, passwords and procedures to register accordingly.</p>
                        </div>
                        
                    </div>
                  </div>
                </div>

                <div class="card">
                  <div class="card-header" id="headingNine">
                    <h2 class="mb-0">
                      <a class="btn btn-link btn-block btn-faq text-left collapsed" style="white-space: normal" type="button" data-toggle="collapse" data-target="#collapseTen" aria-expanded="false" aria-controls="collapseTen">
                        How does the system work?
                      </a>
                    </h2>
                  </div>
                  <div id="collapseTen" class="collapse" aria-labelledby="headingNine" data-parent="#accordionExample">
                    <div class="card-body">
                        SJAI started embracing the digital technology and full automation of records and other processes last 2018. It has developed its own management information system (MIS) that allows administration, faculty, and students access their own portal online even at the comforts of their homes. This year, SJAI launches its own online registration and enrollment to facilitate digital registration.   
                    </div>
                  </div>
                </div>


                <div class="card">
                  <div class="card-header" id="headingNine">
                    <h2 class="mb-0">
                      <a class="btn btn-link btn-block btn-faq text-left collapsed" style="white-space: normal" type="button" data-toggle="collapse" data-target="#collapse13" aria-expanded="false" aria-controls="collapse13">
                        How do I change my account information?
                      </a>
                    </h2>
                  </div>
                  <div id="collapse13" class="collapse" aria-labelledby="headingNine" data-parent="#accordionExample">
                    <div class="card-body">
                        <p>Upon opening your account, personal information will appear. Browse on the details and make the necessary changes. If you wish to change information again, go to “My Profile” and proceed on editing your information.</p>
                    
                        <div align="center">
                          <img class="img-responsive testimonial-img" src="{{ asset('/img/faqs/profile.png')}}" alt="login" width="70%">
                          <p class="mt-2">
                            After opening “My Profile” proceed to the edit icon on the upper right portion
                          </p>
                        </div>

                        <div align="center">
                          <img class="img-responsive testimonial-img" src="{{ asset('/img/faqs/change_profile.png')}}" alt="login" width="70%">
                          {{-- <p class="mt-2">
                            After opening “My Profile” proceed to the edit icon on the upper right portion
                          </p> --}}
                        </div>
                    </div>
                  </div>
                </div>

                <div class="card">
                  <div class="card-header" id="headingNine">
                    <h2 class="mb-0">
                      <a class="btn btn-link btn-block btn-faq text-left collapsed" style="white-space: normal" type="button" data-toggle="collapse" data-target="#collapse14" aria-expanded="false" aria-controls="collapse14">
                        Is my credit card or debit card information safe when I pay online?
                      </a>
                    </h2>
                  </div>
                  <div id="collapse14" class="collapse" aria-labelledby="headingNine" data-parent="#accordionExample">
                    <div class="card-body">
                        <p>
                          Yes. Bank details are highly secured in the payment mode we have selected. This is the same payment service portal large companies and online banking are currently using.
                        </p>
                    </div>
                  </div>
                </div>

                <div class="card">
                  <div class="card-header" id="headingNine">
                    <h2 class="mb-0">
                      <a class="btn btn-link btn-block btn-faq text-left collapsed" style="white-space: normal" type="button" data-toggle="collapse" data-target="#collapse15" aria-expanded="false" aria-controls="collapse15">
                        Is my information secure?
                      </a>
                    </h2>
                  </div>
                  <div id="collapse15" class="collapse" aria-labelledby="headingNine" data-parent="#accordionExample">
                    <div class="card-body">
                        <p>
                          The bank of your choice or the third party handling your information are the channels responsible of the details you have provided. Secure giving details to authorized agents and websites only.
                        </p>
                    </div>
                  </div>
                </div>

                <div class="card">
                  <div class="card-header" id="headingNine">
                    <h2 class="mb-0">
                      <a class="btn btn-link btn-block btn-faq text-left collapsed" style="white-space: normal" type="button" data-toggle="collapse" data-target="#collapse16" aria-expanded="false" aria-controls="collapse16">
                        What will happen if I accidentally deleted my current email notification, what should I do?
                      </a>
                    </h2>
                  </div>
                  <div id="collapse16" class="collapse" aria-labelledby="headingNine" data-parent="#accordionExample">
                    <div class="card-body">
                        <p>
                          In your email account, deleted messages are not yet permanently deleted if accidentally committed to one. Go to “deleted email/messages” or “trash” on your account to retrieve the message. 
                          <br>
                          If the message is permanently deleted, email us at info@sja.com or message at 0956-928-3325 for retrieval.
                        </p>
                    </div>
                  </div>
                </div>

                <div class="card">
                  <div class="card-header" id="headingNine">
                    <h2 class="mb-0">
                      <a class="btn btn-link btn-block btn-faq text-left collapsed" style="white-space: normal" type="button" data-toggle="collapse" data-target="#collapse17" aria-expanded="false" aria-controls="collapse17">
                        Can I use more than one payment method per transaction?
                      </a>
                    </h2>
                  </div>
                  <div id="collapse17" class="collapse" aria-labelledby="headingNine" data-parent="#accordionExample">
                    <div class="card-body">
                      Yes. You can use multiple payment mode on your online registration.
                    </div>
                  </div>
                </div>

                <div class="card">
                  <div class="card-header" id="headingNine">
                    <h2 class="mb-0">
                      <a class="btn btn-link btn-block btn-faq text-left collapsed" style="white-space: normal" type="button" data-toggle="collapse" data-target="#collapse18" aria-expanded="false" aria-controls="collapse18">
                        It is possible for more  than one person to enrol online for the same account?
                      </a>
                    </h2>
                  </div>
                  <div id="collapse18" class="collapse" aria-labelledby="headingNine" data-parent="#accordionExample">
                    <div class="card-body">
                      Only one person is entitled for username and password. 
                    </div>
                  </div>
                </div>

                <div class="card">
                  <div class="card-header" id="headingNine">
                    <h2 class="mb-0">
                      <a class="btn btn-link btn-block btn-faq text-left collapsed" style="white-space: normal" type="button" data-toggle="collapse" data-target="#collapse19" aria-expanded="false" aria-controls="collapse19">
                        What if  I forgot my password, how do I retrieve it?
                      </a>
                    </h2>
                  </div>
                  <div id="collapse19" class="collapse" aria-labelledby="headingNine" data-parent="#accordionExample">
                    <div class="card-body">
                      Retrieval of password must be duly endorsed by the adviser to the MIS Department.
                    </div>
                  </div>
                </div>

                <div class="card">
                  <div class="card-header" id="headingNine">
                    <h2 class="mb-0">
                      <a class="btn btn-link btn-block btn-faq text-left collapsed" style="white-space: normal" type="button" data-toggle="collapse" data-target="#collapse20" aria-expanded="false" aria-controls="collapse20">
                        Will other persons have online access to my own account?
                      </a>
                    </h2>
                  </div>
                  <div id="collapse20" class="collapse" aria-labelledby="headingNine" data-parent="#accordionExample">
                    <div class="card-body">
                      None. You are the only one given the username and password. Please ensure security of it.
                    </div>
                  </div>
                </div>
                
                <div class="card">
                  <div class="card-header" id="headingNine">
                    <h2 class="mb-0">
                      <a class="btn btn-link btn-block btn-faq text-left collapsed" style="white-space: normal" type="button" data-toggle="collapse" data-target="#collapse21" aria-expanded="false" aria-controls="collapse21">
                        How long my payment history would be maintained?
                      </a>
                    </h2>
                  </div>
                  <div id="collapse21" class="collapse" aria-labelledby="headingNine" data-parent="#accordionExample">
                    <div class="card-body">
                      Payment details and history are maintained in the duration of the semester that you have processed the online payment.
                    </div>
                  </div>
                </div>

                <div class="card">
                  <div class="card-header" id="headingNine">
                    <h2 class="mb-0">
                      <a class="btn btn-link btn-block btn-faq text-left collapsed" style="white-space: normal" type="button" data-toggle="collapse" data-target="#collapse22" aria-expanded="false" aria-controls="collapse22">
                        	When is the schedule of entrance test for incoming grade 7 (3rd batch), and transferees?
                      </a>
                    </h2>
                  </div>
                  <div id="collapse22" class="collapse" aria-labelledby="headingNine" data-parent="#accordionExample">
                    <div class="card-body">
                      For your safety and health purposes, SJAI will no longer administer the 3rd batch of entrance test for Grade 7 applicants, and transferees. Instead, a new process of application and assessment method for admission will be implemented. 
                      <br/>
                      <br/>
                      For new students, assessment for your admission will be based on your school performance last SY 2019-2020. This also applies to those who were in the Waiting List, and those who are applying for Reconsideration from the 1st and 2nd batch.

                    </div>
                  </div>
                </div>

                <div class="card">
                  <div class="card-header" id="headingNine">
                    <h2 class="mb-0">
                      <a class="btn btn-link btn-block btn-faq text-left collapsed" style="white-space: normal" type="button" data-toggle="collapse" data-target="#collapse23" aria-expanded="false" aria-controls="collapse23">
                        	What are the requirements for the new application procedures?
                      </a>
                    </h2>
                  </div>
                  <div id="collapse23" class="collapse" aria-labelledby="headingNine" data-parent="#accordionExample">
                    <div class="card-body">
                      <p>There are four easy steps: </p>

                      <ol>
                        <li>Using your smart/android phone, take a clear picture of your report card front and back. Your name, LRN, and grades must be readable. </li>
                        <li>Send these pictures via Facebook messenger to:
                          SJAI Guidance and Admissions Office official Facebook Page. 
                          Submission will be from June 08 to 19, 2020.
                          </li>
                        <li>Wait for the result to be released on June 23, 2020 at St. John’s Academy Inc. official FB page and SJAI Guidance and Admissions Office FB page.</li>
                        <li>Qualified applicants will proceed to enrollment. Kindly click this link https://sja-bataan.com/ to register online.</li>
                      </ol>

                    </div>
                  </div>
                </div>
            </div>	
				
				</div>
			</div>
		</div>
    </main>
@endsection