const posts = document.getElementById('posts');

if (posts) {
  posts.addEventListener('click', e => {
    if (e.target.className === 'btn btn-danger delete-post') {
      if (confirm('Are you sure you want to delete this post?')) {
        const id = e.target.getAttribute('data-id');

        // $.ajax(`/post/delete/${id}`, {
        //   method: 'DELETE'
        // }).success(res => window.location.reload());

        $.ajax({
          url: `post/delete/${id}`,
          method: "DELETE",
          success: function(){
            console.log("Request scceeded");
            window.location.reload();
          },
          fail: function(err){
            console.log("Request Failed. Error message is below...");
            console.log(err);
          }

        });
      }
    }
  });
}
