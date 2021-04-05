
<div class="table-responsive">

    <table class="table table-condensed table-hover">
        <tbody>
            {{-- <ol> --}}
                @forelse ($instructions as $key => $data)
                    <tr>
                        <td style="width: 7%"><b>Part {{ $key+1 }}:</b></td>
                        <td colspan="2">{!! $data->instructions !!}</td>
                        
                        @foreach ($data->questions as $key => $item)
                            <tr>
                                <td></td>
                                <td style="width: 5%">{{ $key+1 }}.)</td>
                                <td> 
                                    {!! $item->question_title !!} 
                                    
                                    @if($data->question_type == 3)
                                        <div class="row">
                                            <div class="col-md-12">
                                                <hr>
                                                <p><b>List of option: <i class="text-red">(drag it to List of your answer)</i></b></p>
                                                <div class="row">
                                                    @foreach ($item->answerMatching as $key => $match)
                                                        <section class="connectedSortable">
                                                            <div class="col-md-12">
                                                                <div class="card">
                                                                    <div class="card-header">
                                                                        <h3 class="card-title">
                                                                            {{ $match->correct_option_answer }}
                                                                        </h3>
                                                                        <input type="hidden" name="match_options[{{ $item->id }}]" value="{{ $data->correct_option_answer }}">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </section>
                                                    @endforeach
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <p><b>List of question:</b></p>
                                                <ol>
                                                @foreach ($item->options as $key => $option)
                                                    <div class="form-group clearfix mt-3">
                                                        <li>
                                                            {{ $option->option_title }}<br/>
                                                            <i class="text-red">
                                                                <small>({{ $item->answerMultipleChoice->points_per_question }} point {{ $item->answerMultipleChoice->points_per_question > 1 ? 's' : '' }} )</small>
                                                            </i>
                                                        </li>
                                                    </div>
                                                @endforeach
                                                </ol>
                                            </div>
                                            <div class="col-md-6 ui-sortable-placeholder sort-highlight">
                                                <p><b>List of your answer:</b></p>
                                                
                                                <section class="connectedSortable">
                                                    @foreach ($item->answerMatching as $key => $match)
                                                        <div class=""></div>
                                                    @endforeach
                                                </section>
                                                
                                            </div>
                                        </div>
                                    @elseif($data->question_type == 4)
                                        <div class="row">
                                            <hr>
                                            <p><b>List of option: <i class="text-red">(drag it to List of your answer)</i></b></p>
                                            <div class="col-md-12 connectedSortable">
                                                @foreach ($item->answerMatching as $key => $match)
                                                        <section class="">
                                                            <div class="card">
                                                                <div class="card-header">
                                                                    <h3 class="card-title">
                                                                        {{ $match->correct_option_answer }}
                                                                    </h3>
                                                                    <input type="hidden" name="match_options[{{ $item->id }}]" value="{{ $data->correct_option_answer }}">
                                                                </div>
                                                            </div>
                                                        </section>
                                                @endforeach
                                            </div>
                                        </div>
                                    @else
                                        <i class="text-red">
                                            <small>({{ $item->answerMultipleChoice->points_per_question }} point {{ $item->answerMultipleChoice->points_per_question > 1 ? 's' : '' }} )</small>
                                        </i>
                                        <div class="row">
                                            @foreach ($item->options as $key => $option)
                                                <div class="col-md-6">
                                                    <div class="form-group clearfix mt-3">
                                                        <div class="icheck-danger d-inline">
                                                            <input type="radio" {{ $item->answerMultipleChoice->correct_option_answer == $key+1 ? 'checked' : '' }} 
                                                            name="options_answer[{{ $item->id }}]" id="option-{{ $option->id }}" value="{{ $option->order_number }}">
                                                            <label for="option-{{ $option->id }}">
                                                                {{ $option->option_title }}
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    @endif
                                </td>
                                
                            </tr>
                        @endforeach
                    </tr>
                @empty
                    <tr>
                        <th class="text-center">Record Not Found</th>
                    </tr>
                @endforelse
            {{-- </ol> --}}
        </tbody>
    </table>
</div>