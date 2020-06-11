
<div class="modal fade" id="js_reservation" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog  modal-xl" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle"><i class="fas fa-thumbtack"></i> Announcement</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">

              <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item">
                    <a style="font-size: 13px" class="nav-link active" id="list_reservation-tab" data-toggle="tab" href="#list_reservation" role="tab" aria-controls="home" aria-selected="true">
                      List of SJAI Entrance<br/>  Exam Passers Reserved<br>
                    </a>
                </li>
                <li class="nav-item">
                    <a style="font-size: 13px" class="nav-link" id="Test_passerjan182020-tab" data-toggle="tab" href="#Test_passerjan182020" role="tab" aria-controls="profile" aria-selected="false">
                      Grade 7 <br/>(Entrance Test Passer - JAN 18, 2020)
                    </a>
                </li>
                <li class="nav-item">
                    <a style="font-size: 13px" class="nav-link" id="waitlist_jan182020-tab" data-toggle="tab" href="#waitlist_jan182020" role="tab" aria-controls="contact" aria-selected="false">
                      Grade 7 <br/>(Waiting list - JAN 18, 2020)
                    </a>
                </li>
                <li class="nav-item">
                    <a style="font-size: 13px" class="nav-link" id="list_feb2020-tab" data-toggle="tab" href="#list_feb2020" role="tab" aria-controls="profile" aria-selected="false">
                      Grade 7 <br/>(Entrance Test Passer - FEB 22, 2020)
                    </a>
                </li>
                <li class="nav-item">
                    <a style="font-size: 13px" class="nav-link" id="waitlist_feb182020-tab" data-toggle="tab" href="#waitlist_feb182020" role="tab" aria-controls="contact" aria-selected="false">
                      Grade 7 <br/>(Waiting list - FEB 22, 2020)
                    </a>
                </li>
              </ul>
              <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="list_reservation" role="tabpanel" aria-labelledby="list_reservation-tab">

                    <h5 class="text-center mt-5">
                        List of SJAI Entrance Exam Passers Reserved
                    </h5>

                    <nav>
                        <div class="nav nav-tabs" id="nav-tab" role="tablist">
                          <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">Grade 7</a>
                          <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false">Grade 11</a>
                        </div>
                      </nav>
                      <div class="tab-content" id="nav-tabContent">
                        <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                            <div class=" py-3">                         
                                <table class="table table-bordered table-hover" id="reservation_grade7" style="font-size: 13px">
                                    <thead align="center">
                                        <tr>
                                            <th width="7%">No.</th>
                                            <th>Student Name</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                            <div class="row py-3 pl-3 pr-3">                        
                                <table class="table table-bordered table-hover" id="reservation" style="font-size: 13px">
                                    <thead align="center">
                                        <tr>
                                            <th>Reserved- STEM</th>
                                            <th>Reserved- ABM</th>
                                            <th>Reserved- HUMSS</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    
                </div>
                <div class="tab-pane fade" id="Test_passerjan182020" role="tabpanel" aria-labelledby="Test_passerjan182020-tab">
                    <h5 class="text-center mt-5">
                        LIST OF INCOMING GRADE 7 WHO PASSED THE ENTRANCE TEST <br/>HELD ON JAN 18, 2020
                    </h5>

                    <div class="row" align="center">      
                        <div class="col-md-12">             
                            <table class="table table-bordered table-hover" id="passer" style="font-size: 13px;">
                                <thead align="center">
                                    <tr>
                                        <th width="7%">No.</th>
                                        <th>Student Name</th>
                                    </tr>
                                </thead>
                                <tbody>                                
                                </tbody>
                            </table>
                        </div>     
                    </div>
                </div>
                <div class="tab-pane fade" id="waitlist_jan182020" role="tabpanel" aria-labelledby="waitlist_jan182020-tab">
                    <h5 class="text-center mt-5">
                        LIST OF GRADE 7 APPLICANTS WHO ARE IN WAITING LIST <br/>HELD ON JAN 18, 2020
                    </h5>

                    <div class="row " align="center">      
                        <div class="col-md-12">             
                            <table class="table table-bordered table-hover" id="waiting_jan_2020" style="font-size: 13px;">
                                <thead align="center">
                                    <tr>
                                        <th>No.</th>
                                        <th>Student Name</th>
                                    </tr>
                                </thead>
                                <tbody>                                
                                </tbody>
                            </table>
                        </div>     
                    </div>
                </div>
                <div class="tab-pane fade" id="list_feb2020" role="tabpanel" aria-labelledby="list_feb2020-tab">
                    <h5 class="text-center mt-5">
                        LIST OF GRADE 7 APPLICANTS WHO PASSED THE ENTRANCE TEST <br/>HELD ON  February 22, 2020
                    </h5>

                    <div class="row " align="center">      
                        <div class="col-md-12">             
                            <table class="table table-bordered table-hover" id="list_feb2020" style="font-size: 13px;">
                                <thead align="center">
                                    <tr>
                                        <th>No.</th>
                                        <th>Student Name</th>
                                    </tr>
                                </thead>
                                <tbody>                                
                                </tbody>
                            </table>
                        </div>     
                    </div>
                </div>
                <div class="tab-pane fade" id="waitlist_feb182020" role="tabpanel" aria-labelledby="waitlist_feb182020-tab">
                    <h5 class="text-center mt-5">
                        LIST OF GRADE 7 APPLICANTS WHO ARE IN WAITING LIST <br/>HELD ON JAN 18, 2020
                    </h5>

                    <div class="row " align="center">      
                        <div class="col-md-12">             
                            <table class="table table-bordered table-hover" id="waiting_feb2020" style="font-size: 13px;">
                                <thead align="center">
                                    <tr>
                                        <th>No.</th>
                                        <th>Student Name</th>
                                    </tr>
                                </thead>
                                <tbody>                                
                                </tbody>
                            </table>
                        </div>     
                    </div>
                </div>
              </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          
        </div>
      </div>
    </div>
  </div>