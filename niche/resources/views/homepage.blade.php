@extends('layouts.layout')
@section('loadAssets')
<link rel="stylesheet" href="{{asset('css/homepage.css')}}" type="text/css">
@endsection

@section('title', 'Niche')

@section('content')
        <div class="d-flex bg-dark flex-column align-items-center main-content">
            <div class="card">
                <div class="d-flex align-items-center">
                    <img src="https://via.placeholder.com/50" class="rounded-circle mr-3" alt="Niche">
                    <div class="m-4">
                        <strong>Niche Title</strong> <small>idk</small>
                    </div>
                </div>

                <p class="mt-3">My Experience at the mall</p>
                <div class="d-flex justify-content-start">
                    <span>503 posts</span>
                    <span>30 active</span>
                    <span>25K visits</span>
                    <span>371 Community Members</span>
            </div>

            <div class="messages-section col-4 border pr-2">
                <div class="search-draft p-3 rounded border">
                    <h5 class="fw-bold mb-3">Suggested</h5>

                    <div class="trending mb-3">
                        <p class="small text-light mb-1">because you are in Gardening</p>
                        <p class="fw-bold mb-1">seed growing</p>
                        <p class="small">120 members</p>
                    </div>
                    <div class="trending mb-3">
                        <p class="small text-light mb-1">Trending</p>
                        <p class="fw-bold mb-1">Vinyl Collection</p>
                        <p class="small">1000 visits</p>
                    </div>
                    <div class="trending mb-3">
                        <p class="small text-light mb-1">Popular in Cebu</p>
                        <p class="fw-bold mb-1">Drake</p>
                    </div>
                    <div class="trending mb-3">
                        <p class="small text-light mb-1">Trending</p>
                        <p class="fw-bold mb-1">Wicked</p>
                        <p class="small ">236K posts</p>
                    </div>
                    <a href="#" class="text-primary text-decoration-none">Show more</a>
                </div>
                <!-- start of live chat -->
                <div class="messages rounded border p-3">
                    <div class="text-warning px-2 py-1 mb-2">
                        <strong>Live Chat</strong>
                    </div>
                    <div class="messages-content overflow-auto px-2 py-2" style="max-height: 500px;">
                        <div class="message d-flex align-items-start mb-2">
                            <img src="https://via.placeholder.com/30" class="rounded-circle me-2" alt="User">
                            <div>
                                <span class="fw-bold text-primary">jatpuan:</span>
                                <span>eww</span>
                            </div>
                        </div>
                        <div class="message d-flex align-items-start mb-2">
                            <img src="https://via.placeholder.com/30" class="rounded-circle me-2" alt="User">
                            <div>
                                <span class="fw-bold text-success">alinaxdino:</span>
                                <span>BETTER</span>
                            </div>
                        </div>
                        <div class="message d-flex align-items-start mb-2">
                            <img src="https://via.placeholder.com/30" class="rounded-circle me-2" alt="User">
                            <div>
                                <span class="fw-bold text-warning">YukiMare_:</span>
                                <span>eeewwww</span>
                            </div>
                        </div>
                        <div class="message d-flex align-items-start mb-2">
                            <img src="https://via.placeholder.com/30" class="rounded-circle me-2" alt="User">
                            <div>
                                <span class="fw-bold text-danger">wynlouv:</span>
                                <span>EWWWWW</span>
                            </div>
                        </div>
                    </div>
                    <div class="message-input border-top mt-2 pt-2 d-flex align-items-center">
                        <input type="text" class="form-control me-2" placeholder="Type your message..." />
                        <button class="btn btn-primary bg-info">Send</button>
                    </div>
                </div>
            </div>
        </div>
@endsection