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
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					
                    <div class="accordion mb-4" id="accordionExample">
                        <div class="card">
                          <div class="card-header" id="headingOne">
                            <h2 class="mb-0">
                              <button class="btn btn-link btn-block text-left" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                What are the benefits of paying online?
                              </button>
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
                              <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                What forms of payment can I use?
                              </button>
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
                              <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                How should I enter my credit card information?
                              </button>
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
                                <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                                    How will I know that my payment has been accepted?
                                </button>
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
                                <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
                                    How long does it take for a credit card transaction to process if I pay online?
                                </button>
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
                                <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#collapseSix" aria-expanded="false" aria-controls="collapseSix">
                                    Can I use a debit card to pay?
                                </button>
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
                                <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#collapseSeven" aria-expanded="false" aria-controls="collapseSeven">
                                    Who do I contact with questions about my payment and fee?
                                </button>
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
                                <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#collapseEight" aria-expanded="false" aria-controls="collapseEight">
                                    What are transaction fees and why do I need to pay them?
                                </button>
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
                                <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#collapseNine" aria-expanded="false" aria-controls="collapseNine">
                                  
                                </button>
                              </h2>
                            </div>
                            <div id="collapseThree" class="collapse" aria-labelledby="headingNine" data-parent="#accordionExample">
                              <div class="card-body">
                                  
                              </div>
                            </div>
                        </div>
                    </div>	
				
				</div>
			</div>
		</div>
    </main>
@endsection