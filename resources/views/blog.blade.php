<!doctype html>
<html lang="en">
<head>

    <meta charset="utf-8">

    <title>Laravel AJAX Pagination with JQuery</title>

</head>
<body>

    <h1>Posts</h1>

    <div class="posts">
       @foreach ($posts as $post)

    <article>
        <h2>{{ $post->id }}</h2>
        {{ $post->product_name }}
    </article>

@endforeach

{{ $posts->links() }}
    </div>

    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"></script>
    // <script>
    // $(window).on('hashchange', function() {
    //     if (window.location.hash) {
    //         var page = window.location.hash.replace('#', '');
    //         if (page == Number.NaN || page <= 0) {
    //             return false;
    //         } else {
    //             getPosts(page);
    //         }
    //     }
    // });
    // $(document).ready(function() {
    //     $(document).on('click', '.pagination a', function (e) {
    //         getPosts($(this).attr('href').split('page=')[1]);
    //         e.preventDefault();
    //     });
    // });
    // function getPosts(page) {
    //     $.ajax({
    //         url : '?page=' + page,
    //         dataType: 'json',
    //     }).done(function (data) {
    //         $('.posts').html(data);
    //         location.hash = page;
    //     }).fail(function () {
    //         alert('Posts could not be loaded.');
    //     });
    // }
    // </script>

    <div id="content" class="col-md-10">
  @foreach (array_chunk($posts->all(), 3) as $row)
    <div class="post row">
        @foreach($row as $post)
            <div class="item col-md-4">
                <!-- SHOW POST -->
                 {{ $post->product_name }}
            </div>
        @endforeach
    </div>
  @endforeach
  {!! $posts->render() !!}
</div>

<!-- Holds your page information!! -->
<input type="hidden" id="page" value="1" />
<input type="hidden" id="max_page" value="3" />

<!-- Your End of page message. Hidden by default -->
<div id="end_of_page" class="center">
    <hr/>
    <span>You've reached the end of the feed.</span>
</div>
<script type="">
    
    var outerPane = $('#content'),
didScroll = false;

$(window).scroll(function() { //watches scroll of the window
    didScroll = true;
});

//Sets an interval so your window.scroll event doesn't fire constantly. This waits for the user to stop scrolling for not even a second and then fires the pageCountUpdate function (and then the getPost function)
setInterval(function() {
    if (didScroll){
       didScroll = false;
       if(($(document).height()-$(window).height())-$(window).scrollTop() < 10){
        pageCountUpdate(); 
    }
   }
}, 250);

//This function runs when user scrolls. It will call the new posts if the max_page isn't met and will fade in/fade out the end of page message
function pageCountUpdate(){
    var page = parseInt($('#page').val());
    var max_page = parseInt($('#max_page').val());

    if(page < max_page){
       $('#page').val(page+1);
       getPosts();
       $('#end_of_page').hide();
    } else {
      $('#end_of_page').fadeIn();
    }
}


//Ajax call to get your new posts
function getPosts(){
    $.ajax({
        type: "POST",
        url: "/load", // whatever your URL is
        data: { page: page },
        beforeSend: function(){ //This is your loading message ADD AN ID
            $('#content').append("<div id='loading' class='center'>Loading news items...</div>");
        },
        complete: function(){ //remove the loading message
          $('#loading').remove
        },
        success: function(html) { // success! YAY!! Add HTML to content container
            $('#content').append(html);
        }
     });

} //end of getPosts function
</script>
</body>
</html>