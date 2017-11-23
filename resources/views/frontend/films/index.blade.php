@extends('layouts/films')

@section('content')

    <div class="row" id="vue-films" xmlns:v-bind="http://www.w3.org/1999/xhtml"
         xmlns:v-on="http://www.w3.org/1999/xhtml">
        <div v-if="!loading" v-for="film in films" class="row col-sm-8" style="margin: 60px auto 20px">
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
                        Release Date: @{{film.release_date}}
                    </span><br>
                    <span>
                        Genre: @{{film.genre}}
                    </span><br>
                    <span>
                        Rating: @{{film.rating}}
                    </span><br>
                    <span>
                        Ticket Price: $ @{{film.ticket_price}}
                    </span><br>
                </div>
            </div>

            <hr class="hr col-md-12">
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

    <script>
        var vueFilms = new Vue({
            el: '#vue-films',
            data: {
                loading: true,
                films: [],
                error: null
            },
            methods: {
                loadFilms: function () {
                    var self = this;
                    self.loading = true;
                    self.error = null;

                    this.$http.get('/api/films').then(function (response) {
                        if (response.status === 200 && typeof(response.body) !== 'undefined') {
                            this.films = response.body;
                        } else {
                            this.error = 'Error Loading films!';
                        }

                        self.loading = false;
                    }, function (response) {
                        this.error = 'Error Loading films!';
                        self.loading = false;
                        console.error(response);
                    });
                }
            },
            created: function () {
                this.loadFilms();
            }
        });
    </script>

@endsection