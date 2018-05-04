                        <div class="pull-right">
                            {{ $Enrollment ? $Enrollment->links() : '' }}
                        </div>
                        <table class="table no-margin">
                            <thead>
                                <tr>
                                    <th>Student Name</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($Enrollment)
                                    @foreach ($Enrollment as $data)
                                        <tr>
                                            <td>{{ $data->student_name }}</td>
                                        </tr>
                                    @endforeach
                                @endif
                            </tbody>
                        </table>