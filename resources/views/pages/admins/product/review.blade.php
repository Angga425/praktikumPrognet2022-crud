@extends('layouts.admin')

@section('content')
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <div class="table">
                            <h2>List Review</h2>
                            <br>
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>User</th>
                                        <th>Rate</th>
                                        <th>Content</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($reviews as $review)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $review->user->name }}</td>
                                            <td>{{ $review->rate }} ⭐</td>
                                            <td>{{ $review->content }}</td>
                                            <td>
                                                {{-- buttom for trigger modal --}}
                                                <button type="button" data-bs-toggle="modal"
                                                    data-bs-target="#modal-review-{{ $review->id }}"
                                                    class="btn btn-success"><i class="fa fa-comments"></i></button>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    @foreach ($reviews as $review)
        {{-- modal for response on review --}}
        <div class="modal fade" id="modal-review-{{ $review->id }}" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Response
                            Review</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ url('admins/products/' . $review->id . '/review-response') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="content">Content</label>
                                <textarea name="content" id="content" class="form-control"
                                    rows="3">{{ $review->response->content ?? '' }}</textarea>
                                </textarea>
                            </div>
                            @if (!$review->response()->exists())
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary">Submit
                                        Response</button>
                                </div>
                            @endif
                        </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endforeach
@endsection