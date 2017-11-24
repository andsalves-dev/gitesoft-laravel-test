@extends('layouts/master')

@section('content')

    <div class="row" xmlns:v-bind="http://symfony.com/schema/routing" xmlns:v-on="http://www.w3.org/1999/xhtml">
        <div class="col-sm-6" style="margin: 20px auto" id="vue-insert-film">
            <h3> Insert New Film </h3>
            <hr class="col-sm-12 hr">

            <div v-for="error in errors" class="alert alert-warning">
                @{{ error }}
            </div>

            <form id="register-form" enctype="multipart/form-data" action="{{route('register.save')}}" method="post">
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Name</label>
                    <div class="col-sm-10">
                        <input required class="form-control" type="text" placeholder="Film Name"
                               v-model="film.name">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Description</label>
                    <div class="col-sm-10">
                        <textarea title="" name="description" required class="form-control"
                                  v-model="film.description"></textarea>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Release Date</label>
                    <div class="col-sm-3">
                        <input required class="form-control" type="text" placeholder="yyyy-mm-dd"
                               v-model="film.release_date">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Rating</label>
                    <div class="col-sm-3">
                        <input title="" required class="form-control" type="text" v-model="film.rating"
                               placeholder="from 1 to 5">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Ticket Price</label>
                    <div class="col-sm-3">
                        <input title="" required class="form-control" type="text" v-model="film.ticket_price"
                               placeholder="$">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Country</label>
                    <div class="col-sm-10">
                        <select title="" required class="form-control" v-model="film.country">
                            <option v-for="country in countryList" v-bind:value="country"> @{{ country }} </option>
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Country</label>
                    <div class="col-sm-10">
                        <select multiple title="" required class="form-control" v-model="film.genres">
                            @foreach($genres as $key => $genre)
                                <option {{!$key ? 'selected': ''}} value="{{$genre['slug']}}"> {{ $genre['name'] }} </option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Photo</label>
                    <div class="col-sm-10">
                        <input title="" required class="form-control" type="text" v-model="film.photo"
                               placeholder="Photo URL">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="input-password" class="col-sm-2 col-form-label">&nbsp;</label>
                    <div class="col-sm-10">
                        <button type="button" v-on:click="save" class="btn btn-primary"> Save</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script>
        $('#register-form').validate();

        var elSelector = '#vue-insert-film';
        var countryList = [
            'United States', 'Brazil', 'Bahamas', 'Italy', 'Russia', 'Turkey', 'Portugal', 'Germany',
            'Mexico', 'Canada', 'Peru', 'Colombia', 'Argentina', 'China', 'Japan', 'Netherlands',
            'Finland', 'India', 'Australia', 'New Zealand', 'Equator', 'Other'
        ];

        new Vue({
            el: elSelector,
            data: {
                countryList: countryList,
                loading: false,
                film: {
                    name: '',
                    description: '',
                    release_date: '',
                    rating: '',
                    ticket_price: '',
                    country: countryList[0],
                    genres: [],
                    photo: ''
                },
                errors: []
            },
            methods: {
                save: function () {
                    var self = this;
                    self.loading = true;
                    self.errors = [];

                    this.$http.post('/api/films', self.film).then(function (response) {
                        if (response.status === 201 && typeof(response.body) !== 'undefined') {
                            alert('Inserted successfully');
                            location.href = '/films';
                        } else {
                            this.errors = ['Error on Insert Film!'];
                        }

                        self.loading = false;
                        $("html, body").animate({ scrollTop: 0 }, "slow");
                    }, function (response) {
                        if (typeof(response.body) === 'object' && typeof(response.body['validation_messages']) !== 'undefined') {
                            var vmessages = response.body['validation_messages'];

                            for (var field in vmessages) {
                                if (vmessages.hasOwnProperty(field)) {
                                    this.errors.push(vmessages[field][0]);
                                }
                            }
                        } else {
                            this.errors = ['Error while Inserting Film!'];
                        }

                        self.loading = false;
                        console.error(response);
                        $("html, body").animate({ scrollTop: 0 }, "slow");
                    });
                }
            },
            created: function () {
                var element = document.querySelector(elSelector);

                if (element) {
                    var notLoadedPlaceholders = document.querySelectorAll('.vue-not-loaded');
                    for (var i = 0; i < notLoadedPlaceholders.length; i++) {
                        notLoadedPlaceholders[i].style.display = 'none';
                    }

                    element.style.display = 'block';
                }
            }
        });
    </script>

@endsection