                        <div class="float-right">
                            {{ $Article ? $Article->links() : '' }}
                        </div>
                        <table class="table table-sm table-hover no-margin">
                            <thead>
                                <tr>
                                    <th>Posting Date</th>
                                    <th>Title</th>
                                    <th>Type</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($Article)
                                    @foreach ($Article as $data)
                                        <tr>
                                            <td>{{ Carbon\Carbon::parse($data->posting_date)->format('Y-m-d') }}</td>
                                            <td>{{ str_limit($data->title, 50) }}</td>
                                            <td>
                                                <span class="badge {{ App\Models\Article::ARTICLE_TYPE_DESIGN[$data->article_type] }}">{{ App\Models\Article::ARTICLE_TYPE[$data->article_type] }}</span>
                                            </td> 
                                            <td>
                                                <span class="badge {{ App\Models\Article::ARTICLE_STATUS_DESIGN[$data->status] }}">{{ App\Models\Article::ARTICLE_STATUS[$data->status] }}</span>
                                            </td>
                                            <td>
                                                <div class="btn-group">
                                                    <button type="button" class="btn btn-danger">Action</button>
                                                    <button type="button" class="btn btn-danger dropdown-toggle dropdown-icon" data-toggle="dropdown">
                                                        <span class="sr-only">Toggle Dropdown</span>
                                                    </button>
                                                    <div class="dropdown-menu">
                                                        <a href="#" class="dropdown-item js-btn_update_sy" data-id="{{ $data->id }}">Edit</a>
                                                        <a href="#" class="dropdown-item js-btn_deactivate" data-id="{{ $data->id }}">Deactivate</a>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
                            </tbody>
                        </table>