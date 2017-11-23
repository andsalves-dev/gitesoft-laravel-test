@extends('layouts/master')

@section('content')

    <div class="row" id="vue-film" xmlns:v-bind="http://www.w3.org/1999/xhtml"
         xmlns:v-on="http://www.w3.org/1999/xhtml" style="display: none">
        <div v-if="!loading" class="row col-sm-8" style="margin: 60px auto 20px;">
            <div class="col-md-4">
                <img class="img-fluid" :src="film.photo" alt="Image" onerror="this.src='{{url("/img/no_image.png")}}'">
            </div>
            <div class="col-md-8">
                <div class="title">
                    <a v-bind:href="'/films/' + film.slug">
                        <h2>@{{film.name}}</h2>
                    </a>
                </div>
                <div class="desc">
                    <p>
                        @{{film.description}}
                    </p>
                </div>
                <hr class="hr">
                <div class="desc">
                    <span>
                        Release Date: @{{formatDate(new Date(film.release_date))}}
                    </span><br>
                    <span>
                        Genre(s): @{{film.genres_names.join(' / ')}}
                    </span><br>
                    <span>
                        Rating: @{{film.rating}} / 5
                    </span><br>
                    <span>
                        Ticket Price: $ @{{film.ticket_price}}
                    </span><br>
                    <span>
                        Country: @{{film.country}}
                    </span><br>
                </div>
            </div>

            <hr class="hr col-md-12">
        </div>
        <div class="row col-sm-12">
            <div class="col-sm-12 text-right">
                <a href="{{url('/films')}}" class="btn btn-primary">Back to List</a>
            </div>
        </div>
        <div v-if="error !== null" class="row col-sm-12">
            <div class="col-sm-12">
                <h4 class="text-center">@{{ error }}</h4>
            </div>
            <div class="col-sm-12 text-center">
                <button v-on:click="loadFilms" class="btn btn-primary">Reload</button>
            </div>
        </div>
        <div v-if="loading" class="row col-sm-12">
            <img src="/img/loading.gif" height="100" alt="Loading..." style="margin: 0 auto">
        </div>
    </div>

    <div class="row col-sm-12" id="vue-not-loaded">
        <img src="/img/loading.gif" height="100" alt="Loading..." style="margin: 0 auto">
    </div>

    <script>
        const elSelector = '#vue-film';

        var vueFilm = new Vue({
            el: elSelector,
            data: {
                loading: true,
                film: null,
                error: null
            },
            methods: {
                loadFilm: function () {
                    var self = this;
                    self.loading = true;
                    self.error = null;

                    this.$http.get('/api/films/{{$slug}}').then(function (response) {
                        if (response.status === 200 && typeof(response.body) !== 'undefined') {
                            this.film = response.body;
                        } else {
                            this.error = 'Error Loading film!';
                        }

                        self.loading = false;
                    }, function (response) {
                        this.error = 'Error Loading film!';
                        self.loading = false;
                        console.error(response);
                    });
                }
            },
            created: function () {
                var element = document.querySelector(elSelector);

                if (element) {
                    document.getElementById('vue-not-loaded').style.display = 'none';
                    element.style.display = 'block';
                }

                this.loadFilm();
            }
        });
    </script>

@endsection