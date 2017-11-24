@extends('layouts/master')

@section('content')

    <div class="row" id="vue-film" xmlns:v-bind="http://www.w3.org/1999/xhtml"
         xmlns:v-on="http://www.w3.org/1999/xhtml" style="display: none">
        <div v-if="!film.loading && film.data !== null" class="row col-sm-8" style="margin: 60px auto 20px;">
            <div class="col-md-4">
                <img class="img-fluid" :src="film.data.photo" alt="Image"
                     onerror="this.src='{{url("/img/no_image.png")}}'">
            </div>
            <div class="col-md-8">
                <div class="title">
                    <h2>@{{film.data.name}}</h2>
                </div>
                <div class="desc">
                    <p>
                        @{{film.data.description}}
                    </p>
                </div>
                <hr class="hr">
                <div class="desc">
                    <span>
                        Release Date: @{{formatDate(new Date(film.data.release_date))}}
                    </span><br>
                    <span>
                        Genre(s): @{{film.data.genres_names.join(' / ')}}
                    </span><br>
                    <span>
                        Rating: @{{film.data.rating}} / 5
                    </span><br>
                    <span>
                        Ticket Price: $ @{{film.data.ticket_price}}
                    </span><br>
                    <span>
                        Country: @{{film.data.country}}
                    </span><br>
                </div>
            </div>

            <hr class="hr col-md-12">
        </div>
        <div class="col-sm-8 text-right" style="margin: 20px auto 20px;">
            <a href="{{route('films.list')}}" class="btn btn-primary">Back to List</a>
        </div>

        <div class="row col-sm-8" style="margin: 20px auto 20px;">
            @include('frontend/films/partial/comments')
        </div>

        <div v-if="film.error !== null" class="row col-sm-12">
            <div class="col-sm-12">
                <h4 class="text-center">@{{ film.error }}</h4>
            </div>
            <div class="col-sm-12 text-center">
                <button v-on:click="loadFilm" class="btn btn-primary">Reload</button>
            </div>
        </div>
        <div v-if="film.loading" class="row col-sm-12">
            <img src="/img/loading.gif" height="100" alt="Loading..." style="margin: 0 auto">
        </div>
    </div>

    <div class="row col-sm-12 vue-not-loaded">
        <img src="/img/loading.gif" height="100" alt="Loading..." style="margin: 0 auto">
    </div>

    <script>
        var elSelector = '#vue-film';

        new Vue({
            el: elSelector,
            data: {
                film: {
                    loading: true,
                    data: null,
                    error: null
                },
                comments: {
                    loading: true,
                    items: [],
                    error: null,
                    comment_text: ''
                }
            },
            methods: {
                loadFilm: function () {
                    var self = this;
                    self.film.loading = true;
                    self.film.error = null;

                    this.$http.get('/api/films/{{$slug}}').then(function (response) {
                        if (response.status === 200 && typeof(response.body) !== 'undefined') {
                            self.film.data = response.body;
                            self.loadComments(self.film.data.id);
                        } else {
                            self.film.error = 'Error Loading film!';
                        }

                        self.film.loading = false;
                    }, function (response) {
                        if (response.status === 404) {
                            self.film.error = 'Film Not Found.';
                        } else {
                            self.film.error = 'Error Loading film!';
                        }

                        self.film.loading = false;
                        console.error(response);
                    });
                },
                loadComments: function (film_id) {
                    var self = this;
                    self.comments.loading = true;
                    self.comments.error = null;

                    if (!film_id) {
                        film_id = self.film.data.id;
                    }

                    this.$http.get('/api/comments?film_id=' + film_id).then(function (response) {
                        if (response.status === 200 && typeof(response.body) !== 'undefined') {
                            self.comments.items = response.body;
                        } else {
                            self.comments.error = 'Error Loading comments!';
                        }

                        self.comments.loading = false;
                    }, function (response) {
                        self.comments.error = 'Error Loading comments!';
                        self.comments.loading = false;
                        console.error(response);
                    });
                },
                @if (Auth::check())
                addComment: function () {
                    var self = this;
                    self.comments.loading = true;

                    this.$http.post('/api/comments', {
                        'comment': self.comments.comment_text,
                        'film_id': self.film.data.id,
                        'name': '{{Auth::user()->name}}',
                        'user_id': '{{Auth::user()->id}}'
                    }).then(function (response) {
                        if (response.status === 201 && typeof(response.body) !== 'undefined') {
                            self.comments.comment_text = '';
                            self.loadComments(self.film.data.id);
                        } else {
                            alert('Error posting your comment! ');
                        }

                        self.comments.loading = false;
                    }, function (response) {
                        alert('Error posting your comment! ');
                        self.comments.loading = false;

                        console.error(response);
                    });
                }
                @endif
            },
            created: function () {
                var vueElement = document.querySelector(elSelector);

                if (vueElement) {
                    var notLoadedPlaceholders = document.querySelectorAll('.vue-not-loaded');
                    for (var i = 0; i < notLoadedPlaceholders.length; i++) {
                        notLoadedPlaceholders[i].style.display = 'none';
                    }

                    vueElement.style.display = 'block';
                }

                this.loadFilm();
            }
        });
    </script>

@endsection