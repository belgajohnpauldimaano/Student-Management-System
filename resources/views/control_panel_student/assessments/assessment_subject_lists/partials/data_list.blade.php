<div class="row" id="js-assessment-subject-container">
    
    @forelse ($subject->classDetail->classSubjects as $item)
        <div class="col-md-3">
            <a href="{{ route('student.assessment.subject.details', [encrypt($item->id)] ) }}" class="small-box bg-info">
                <div class="inner" style="height: 200px;">
                    <h4>{{ $item->subject->subject }}</h4>
                        <p>{{ $item->faculty['full_name'] }}</p>
                </div>
                <div class="icon">
                    <i class="fas fa-book"></i>
                </div>
            </a>
        </div>
    @empty
    <div class="col-md-12 text-center">
        <div class="box-body">
            <div class="row">
                <table class="table">
                    <tbody>
                        <tr>
                            <th style="text-align:center">
                                <img src="https://cdn.iconscout.com/icon/free/png-256/data-not-found-1965034-1662569.png" alt="no data"/>
                                <br/>Sorry, there is no enrolled subject found.
                            </th>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    @endforelse 
</div>