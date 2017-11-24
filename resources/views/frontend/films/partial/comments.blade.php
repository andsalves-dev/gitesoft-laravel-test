<div class="card col-sm-12" xmlns:v-on="http://www.w3.org/1999/xhtml" v-if="film.data !== null">
    <div class="card-block">
        <h3 class="card-title">
            Comments
        </h3>
        <hr class="hr row">
    </div>

    <div class="card-block" v-if="!comments.loading">
        @if (Auth::check())
            <h6 class="card-title">
                Add comment
            </h6>

            <div class="card border-0">
                <textarea  class="form-control" v-model="comments.comment_text" title="" rows="3"></textarea>
                <div class="text-left" style="margin-top: 10px">
                    <button v-on:click="addComment" class="btn btn-primary">Comment</button>
                </div>
            </div>
        @else
            You must be logged-in to post comments
        @endif
    </div>

    <div class="card-block" v-if="!comments.loading">
        <div class="card mb-3" v-for="comment in comments.items">
            <div class="card-block">
                <h5 class="card-title">
                    <img src="/img/user.png" alt="..." class="rounded-circle border" style="margin-top: -7px">&nbsp;
                    @{{ comment.name }}
                </h5>
                <p class="card-text col-sm-12">
                    @{{ comment.comment }}
                </p>
                <p class="card-text col-sm-12">
                    <small class="text-muted">
                        <small>
                            @{{ formatDate(new Date(comment.created_at), true) }}
                        </small>
                    </small>
                </p>
            </div>
        </div>
    </div>

    <div class="card-block mb-3" v-if="comments.error !== null">
        <div class="alert alert-danger">
            <span>
                @{{ comments.error }}
            </span>&nbsp;&nbsp;
            <button v-on:click="loadComments" class="btn btn-primary">Reload</button>
        </div>
    </div>

    <div v-if="comments.loading" class="card mb-3">
        <img src="/img/loading.gif" height="40" alt="Loading..." style="margin: 10px auto">
    </div>

    <div class="card-block mb-3" v-if="comments.items.length === 0 && comments.error === null">
        <p class="col-sm-12">No comments to show</p>
    </div>

    <div class="card col-sm-12 vue-not-loaded">
        <img src="/img/loading.gif" height="40" alt="Loading..." style="margin: 10px auto">
    </div>
</div>