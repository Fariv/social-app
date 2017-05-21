var postId = 0;
var postBodyElement = null;

$('.post').find('.interaction').find('.editpost-dialog-link').on('click', function (event) {
  event.preventDefault();

  postBodyElement = event.target.parentNode.parentNode.childNodes[1];
  var prev_post_body = postBodyElement.textContent;

  postId = event.target.dataset['postid'];
  // console.log(prev_post_body);

  $('#post-body').val(prev_post_body);

  $('.modal').modal();
});

$('#save-changes').on('click', function () {
  $.ajax({
    method: 'POST',
    url: url,
    data: { body: $('#post-body').val(), postId: postId, _token: token }
  }).done(function (msg) {
      // console.log(msg['message']);
      $(postBodyElement).fadeOut(100, function(){
        $(postBodyElement).fadeIn(3400).text(msg['new_body']);
      });
      // $(postBodyElement).fadeOut(200).fadeIn(200).text(msg['new_body']);
      $('.modal').modal('hide');
  });
});

$('a.likeAct').on('click', function (event) {
  event.preventDefault();
  var isLiked = event.target.previousElementSibling == null ? true: false;
  // console.log(isLiked);
  var postId = event.target.parentNode.parentNode.dataset['postid'];
  $.ajax({
    method: 'POST',
    url: urlLike,
    data: {isLike: isLiked, postId: postId, _token: token}
  }).done(function () {
    event.target.innerText = isLiked ? event.target.innerText == 'Like' ? 'LIKED': 'Like': event.target.innerText == 'Dislike' ? 'DISLIKED': 'Dislike'
    if (isLiked) {
      event.target.nextElementSibling.innerText = 'Dislike';
    } else {
      event.target.previousElementSibling.innerText = 'Like';
    }
  });
});
